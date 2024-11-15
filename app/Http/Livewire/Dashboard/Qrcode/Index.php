<?php

namespace App\Http\Livewire\Dashboard\Qrcode;

use App\Models\Pengaturan;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Index extends Component
{
    public $generate = false;

    
    public function generate_qrcode()
    {
        $this->generate = true;
    }

    public function render()
    {
        return view('livewire.dashboard.qrcode.index', [
            'title' => env('APP_NAME') . ' | Dashboard - QrCode',
            'title_page' => 'QrCode',
            'icon' => ' <i class="bi bi-qr-code-scan"></i>',
            'pengaturan' => Pengaturan::first()

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
