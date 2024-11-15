<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Index extends Component
{

    public $username;
    public $password;
    public $remember_me = false;

    public $showLivewireRegistrasi = false;

    protected $listeners = [
        'error',

        'register' => 'handleRegister',

        'closeLivewire' => 'handleCloseLivewire',

    ];


    public function mount()
    {
        if (Auth()->user()) {
            if (auth()->user()->level == 0) {
                return redirect('/dashboard');
            }

            if (auth()->user()->level == 1) {
                return redirect('/presensi/riwayat');
            }
        }
    }


    // registrasi_akun
    public function registrasi_akun()
    {
        $this->showLivewireRegistrasi = true;
    }
    public function handleRegister()
    {
        $this->showLivewireRegistrasi = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireRegistrasi = false;
    }


    public function auth(Request $request)
    {
        $remember_me = $this->remember_me ? true : false;

        $validateData =  $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($validateData, $remember_me)) {
            session()->regenerate();

            // return redirect()->intended('/dashboard')->with('message', 'success/Login Berhasil');

            if (auth()->user()->level == 1) {
                return redirect()->intended('/presensi')->with('message', 'success/Login Berhasil');
            } else {
                return redirect()->intended('/dashboard')->with('message', 'success/Login Berhasil');
            }
        }

        $this->emit('error');

        return back()->with('message', 'error/Login gagal');
    }

    public function error() {}

    public function render()
    {
        return view('livewire.index', [
            'title' => env('APP_NAME'),
        ])->layout('index');
    }
}
