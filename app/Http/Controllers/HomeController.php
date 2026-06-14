<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {
        if(\Auth::user()->level == 'super'){
            return redirect('report');
        }
        $data['questions'] = Pertanyaan::with('jawaban')->get();
        $data['cek_jawaban'] = Jawaban::where('user_id', \Auth::user()->id)->count();
        return view('welcome', $data);
    }

    public function store(Request $request)
    {
        $user = \Auth::user();

        if ($user->tokens <= 0) {
            return redirect()->route('token.index')->with('warning', 'Saldo token Anda tidak cukup. Silakan beli token terlebih dahulu.');
        }

        $data = $request->all();
        // Loop melalui semua jawaban dari input
        foreach ($data as $key => $value) {
            // Periksa apakah key dimulai dengan 'jawaban_id_'
            if (strpos($key, 'jawaban_id_') === 0) {
                // Ekstrak `pertanyaan_id` dari key (misalnya, 'jawaban_id_1' menjadi 1)
                $pertanyaan_id = str_replace('jawaban_id_', '', $key);

                // Simpan ke tabel jawaban
                Jawaban::create([
                    'pertanyaan_id' => $pertanyaan_id,
                    'jawaban' => $value,
                    'user_id' => $user->id
                ]);
            }
        }
        $user->tokens = $user->tokens - 1;
        $user->save();

        return redirect()->route('assessment.index')->with('success', 'Jawaban berhasil disimpan. 1 token telah terpakai.');
    }

    public function forgotPassword(Request $request)
    {
        if(!empty($request->email)){
            $model = User::where('email', $request->email)->first();
            if($model){
                if(!empty($request->password) && !empty($request->confirm_password)){
                    if($request->password != $request->confirm_password){
                        return redirect()->back()->with('warning', 'Password tidak sama');
                    }
                    $model->password = Hash::make($request->password);
                    $model->save();
                    return redirect()->route('login')->with('success', 'Password berhasil diubah.');
                }
            }else{
                return redirect('login')->with('warning', 'Email not found.');
            }
        }
        return view('auth.forgot-password');
    }
}
