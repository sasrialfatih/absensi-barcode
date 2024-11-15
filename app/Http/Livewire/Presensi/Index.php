<?php

namespace App\Http\Livewire\Presensi;

use App\Models\Absensi;
use App\Models\Qrcode;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Index extends Component
{

    protected $listeners = ['presensi'];


    public function presensi($data)
    {
        $cek_url = explode('/', $data);

        if (count($cek_url) == 6) {
            $cek_qrcode = Qrcode::where('code', $cek_url[5])->first();

            if ($cek_qrcode) {
                // dd(1);
                return redirect($data);
            } else {
                session()->flash('message_index', 'error/Maaf QrCode salah/Silahkan hubungdi admin untuk mendapatkan QrCode yang benar.');
                return false;
            }
        } else {
            session()->flash('message_index', 'error/Maaf QrCode salah/Silahkan hubungdi admin untuk mendapatkan QrCode yang benar.');
            return false;
        }


        // dd($cek_qrcode);

    }

    public function render()
    {
        return view('livewire.presensi.index', [
            'title' => env('APP_NAME') . ' | Home',
            'title_page' => 'Home',
            'absensi_hari_ini' => Absensi::where('id_pegawai', Auth()->user()->pegawai->id_pegawai)
                ->where('tanggal', date('Y:m:d'))->first(),

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
