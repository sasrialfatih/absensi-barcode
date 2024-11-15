<?php

namespace App\Http\Livewire\Dashboard\Profil;

use Livewire\Component;

class Index extends Component
{
    public $showUpdateNama = false;
    public $showUpdateUsername = false;
    public $showUpdatePassword = false;
    public $showUpdateEmail = false;

    public $getUser;

    protected $listeners = [
        'namaUpdated' => 'handleNamaUpdated',
        'usernameUpdated' => 'handleUsernameUpdated',
        'passwordUpdated' => 'handlePasswordUpdated',

        'closeLivewire' => 'handleCloseLivewire'
    ];

    // update nama
    public function updateNama()
    {
        $this->showUpdateNama = true;
    }

    public function handleNamaUpdated()
    {
        $this->showUpdateNama = false;
    }

    // update username
    public function updateUsername()
    {
        $this->showUpdateUsername = true;
    }

    public function handleUsernameUpdated()
    {
        $this->showUpdateUsername = false;
    }

    // update password
    public function updatePassword()
    {
        $this->showUpdatePassword = true;
    }

    public function handlePasswordUpdated()
    {
        $this->showUpdatePassword = false;
    }

    public function handleCloseLivewire()
    {
        $this->showUpdateNama = false;
        $this->showUpdateUsername = false;
        $this->showUpdateEmail = false;
        $this->showUpdatePassword = false;
    }

    public function render()
    {
        return view('livewire.dashboard.profil.index', [
            'title' => env('APP_NAME') . ' | Dashboard - Profil',
            'title_page' => 'Profil',
            'icon' => '<i class="bi bi-person-locj"></i>',

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
