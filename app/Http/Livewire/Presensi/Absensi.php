<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Absensi as ModelsAbsensi;
use App\Models\Pengaturan;
use App\Models\Qrcode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Absensi extends Component
{
    public function mount(Qrcode $code)
    {
        $cek_data = Qrcode::where('id', $code->id);

        $pengaturan = Pengaturan::first();

        if ($cek_data) {

            $absensi = ModelsAbsensi::where('id_pegawai', Auth()->user()->pegawai->id_pegawai)
                ->where('tanggal', date('Y:m:d'))->first();

            // dd($absensi);

            $jam_masuk = '';
            $jam_pulang = '';

            // jam masuk set
            if ($pengaturan) {
                if ($pengaturan->jam_masuk) {
                    $jam_masuk  = strtotime(date('Y-m-d ' . $pengaturan->jam_masuk));
                } else {
                    $jam_masuk  = strtotime(date('Y-m-d 07:30:00'));
                }
            } else {
                $jam_masuk  = strtotime(date('Y-m-d 07:30:00'));
            }

            // jam pulang set
            if ($pengaturan) {
                if ($pengaturan->jam_pulang) {
                    // dd($pengaturan->jam_pulang);
                    $array_jam_pulang = explode(':', $pengaturan->jam_pulang);
                    $jam_pulang  = date($array_jam_pulang[0] . ':' . $array_jam_pulang[1]);
                } else {
                    $jam_pulang  = $jam_pulang = date('16:30');
                }
            } else {
                $jam_pulang  = $jam_pulang = date('16:30');
            }

            if (!$absensi) {
                $jam_datang = strtotime(date('Y-m-d H:i:s'));

                $selisih  = $jam_datang - $jam_masuk;

                $jam   = floor($selisih / (60 * 60));
                $menit = $selisih - ($jam * (60 * 60));
                $detik = $selisih % 60;

                $terlambat = 0;

                if (floor($jam * 60) + floor($menit / 60) <= 0) {
                    $terlambat = 0;
                } else {
                    $terlambat = floor($jam * 60) + floor($menit / 60);
                }

                ModelsAbsensi::create([
                    'id_pegawai' => Auth()->user()->pegawai->id_pegawai,
                    'tanggal' => date('Y:m:d'),
                    'masuk' => date('Y:m:d H:i:s'),
                    // 'pulang' => date('Y:m:d H:i:s'),
                    'terlambat' => $terlambat,
                    'status' => 1
                ]);

                return redirect('/presensi')->with('message', 'success/Absensi masuk berhasil');
            } else {
                $jam_absen = date('H:i');

                if ($jam_absen >= $jam_pulang) {
                    ModelsAbsensi::where('id_absensi', $absensi->id_absensi)->update([
                        'pulang' => date('Y:m:d H:i:s'),
                        'status' => 2
                    ]);

                    return redirect('/presensi')->with('message', 'success/Absensi pulang berhasil');
                } else {
                    return redirect('/presensi')->with('message', 'error/Maaf belum waktu pulang !');
                }
            }
        }
    }


    public function render()
    {
        return view('livewire.presensi.absensi', [
            // 'pengaturan' => Pengaturan::first()
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
