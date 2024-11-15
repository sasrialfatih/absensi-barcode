<?php

namespace App\Http\Controllers;

use App\Exports\LaporanBulananExport;
use App\Exports\LaporanHarianExport;
use App\Models\Pegawai;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExporController extends Controller
{
    public function laporanHarian(Request $request)
    {
        include_once 'function/time.php';
        $array_tanggal = explode(':', $request->tanggal);

        // dd($request->tanggal);
        return Excel::download(new LaporanHarianExport($request->tanggal), 'laporan-harian-absensi-pegawai-tanggal-' . $array_tanggal[2] . ' ' . get_angka_bulan($array_tanggal[1]) . ' ' . $array_tanggal[0]  . ' .xlsx');
    }

    public function laporanBulanan(Request $request)
    {
        include_once 'function/time.php';
        $bulan = explode(':', $request->bulan);

        $sizePaper = 'f4';

        $data = [
            'title' => 'LAPORAN ABSENSI PEGAWAI BULAN' . strtoupper(get_angka_bulan($bulan[1])) . ' ' . $bulan[0],
            'pegawai' => Pegawai::orderBy('nama', 'ASC')->get(),
            'bulan' => $request->bulan,
            'pengaturan' => Pengaturan::first()
        ];

        $pdf = PDF::loadView('export.laporan-bulanan', $data);

        $pdf->setPaper('f4', 'landscape');

        return $pdf->stream('laporan-absensi-pegawai-bulan-' . get_angka_bulan($bulan[1]) . ' ' . $bulan[0] . '.pdf');
    }
}
