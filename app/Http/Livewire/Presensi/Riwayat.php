<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Absensi;
use Livewire\Component;

class Riwayat extends Component
{
    public function render()
    {
        return view('livewire.presensi.riwayat', [
            'title' => env('APP_NAME') . ' | Riwayat Absensi',
            'title_page' => 'Riwayat Absensi',
            'riwayat' => Absensi::where('id_pegawai', Auth()->user()->pegawai->id_pegawai)
                ->where('tanggal', 'like', date('Y:m') . '%')
                ->orderBy('id_absensi', 'DESC')->get()
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
