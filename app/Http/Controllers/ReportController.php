<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\JawabanExport;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $data['model'] = User::with('jawaban')->where('level', 'guest')->get();
        return view('report.index', $data);
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
        return Excel::download(new ReportExport(), 'Report Jawaban.xlsx');
    }
}
