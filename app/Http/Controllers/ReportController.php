<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\JawabanExport;
use App\Exports\ReportExport;
use App\Models\Jawaban;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use ZipArchive;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    public function index()
    {
        $data['groups'] = collect(User::kelompokGroups())->map(function ($label, $key) {
            return [
                'key' => $key,
                'label' => $label,
                'total' => User::where('level', 'guest')->inKelompok($key)->count(),
            ];
        });

        return view('report.index', $data);
    }

    public function kelompok($kelompok)
    {
        abort_unless(isset(User::kelompokGroups()[$kelompok]), 404);

        $data['key'] = $kelompok;
        $data['label'] = User::kelompokGroups()[$kelompok];
        $data['users'] = User::with('jawaban')
            ->where('level', 'guest')
            ->inKelompok($kelompok)
            ->orderBy('name')
            ->get();

        return view('report.kelompok', $data);
    }

    public function detail(Request $request)
    {
        $user_id = $request->id;
        $data['pertanyaan'] = \DB::table('pertanyaan as p')
            ->leftJoin('jawaban as j', function ($join) use ($user_id) {
                $join->on('j.pertanyaan_id', '=', 'p.id')
                    ->where('j.user_id', '=', $user_id);
            })
            ->select('p.pertanyaan', 'j.jawaban', 'j.user_id')
            ->get();

        $data['user_id'] = $request->id;
        return view('report._detail', $data);
    }

    public function excel(Request $request) 
    {
        $user_id =  $request->user_id;
        $user = User::where('id', $user_id)->first();
        return Excel::download(new JawabanExport($user_id), 'Report '.$user->name.'.xlsx');
    }

    public function export(Request $request) 
    {
        $kelompok = $request->kelompok;
        abort_unless(isset(User::kelompokGroups()[$kelompok]), 404);

        $label = User::kelompokGroups()[$kelompok];

        return Excel::download(new ReportExport($kelompok), 'Report '.$label.'.xlsx');
    }

    public function cetak(Request $request)
    {
        $data['user'] = User::where('id', $request->user_id)->first();
        $data['skor'] = \DB::table('pertanyaan as p')
        ->select(
            'p.jenis',
            \DB::raw('COUNT(p.id) AS total_pertanyaan'),
            \DB::raw('SUM(j.jawaban) AS total_jawaban')
        )
        ->leftJoin('jawaban as j', 'j.pertanyaan_id', '=', 'p.id')
        ->where('j.user_id', $request->user_id)
        ->groupBy('p.jenis')
        ->orderByRaw("FIELD(p.jenis, 'Penghindaran', 'Perenungan') ASC")
        ->get();

        $data['tanggal_submit'] = Jawaban::where('user_id', $request->user_id)->first();

        $pdf = PDF::loadView('report.cetak', $data);
        return $pdf->stream('keluhan_umum.pdf');
    }

    public function cetakBulk(Request $request)
    {
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        $kelompok = $request->kelompok;
        abort_unless(isset(User::kelompokGroups()[$kelompok]), 404);

        $users = User::where('level', 'guest')->inKelompok($kelompok)->get();
        if ($users->isEmpty()) {
            alert()->warning('Tidak ada peserta pada kelompok ini', 'Kosong');
            return redirect()->route('report.kelompok', $kelompok);
        }

        $zipFileName = 'REPORT-BULK-'.$kelompok.'.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);
        $pdfFiles = [];

        $tempFolder = storage_path('app/public/temp-pdf/');
        if (!File::exists($tempFolder)) {
            File::makeDirectory($tempFolder, 0777, true, true);
        }

        foreach ($users as $user) {
            $data['user'] = $user;
            $data['skor'] = \DB::table('pertanyaan as p')
                ->select(
                    'p.jenis',
                    \DB::raw('COUNT(p.id) AS total_pertanyaan'),
                    \DB::raw('SUM(j.jawaban) AS total_jawaban')
                )
                ->leftJoin('jawaban as j', 'j.pertanyaan_id', '=', 'p.id')
                ->where('j.user_id', $user->id)
                ->groupBy('p.jenis')
                ->orderByRaw("FIELD(p.jenis, 'Penghindaran', 'Perenungan') ASC")
                ->get();

            $data['tanggal_submit'] = Jawaban::where('user_id', $user->id)->first();

            // Mencegah error jika nama mengandung karakter tidak valid untuk file
            $safeFileName = preg_replace('/[^\w\-\.]/', '_', $user->name);
            $fileName = 'Report_' . $safeFileName . '.pdf';
            $filePath = $tempFolder . $fileName;

            // Generate PDF
            $pdf = PDF::loadView('report.cetak', $data);
            $pdf->save($filePath);
            $pdfFiles[] = $filePath;
        }

        // Membuat file ZIP
        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($pdfFiles as $file) {
                if (File::exists($file)) {
                    $zip->addFile($file, basename($file));
                }
            }
            $zip->close();
        } else {
            return response()->json(['message' => 'Gagal membuat file ZIP'], 500);
        }

        // Hapus file PDF setelah dimasukkan ke dalam ZIP
        foreach ($pdfFiles as $file) {
            if (File::exists($file)) {
                File::delete($file);
            }
        }

        // Kirim file ZIP ke pengguna dan hapus setelah dikirim
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
