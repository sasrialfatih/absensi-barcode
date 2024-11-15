<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanHarianExport implements FromView
{
    public $tanggal;

    public function __construct($tanggal)
    {
        $this->tanggal  = $tanggal;
        // dd(1);
    }

    public function view(): View
    {
        return view('export.laporan-harian', [
            'pegawai' => Pegawai::orderBy('nama', 'ASC')->get(),
            'tanggal' => $this->tanggal
        ]);
    }
}
