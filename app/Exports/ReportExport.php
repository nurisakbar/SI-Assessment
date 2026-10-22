<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
    protected $kelompok;

    public function __construct(string $kelompok)
    {
        $this->kelompok = $kelompok;
    }

    public function view(): View
    {
        return view('report.export', [
            'users' => User::with('jawaban')->where('level', 'guest')->inKelompok($this->kelompok)->get()
        ]);
    }
}
