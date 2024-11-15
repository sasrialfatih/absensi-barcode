<?php

namespace App\Http\Livewire\Dashboard\Profil;

use App\Models\User;
use Livewire\Component;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class UpdatePassword extends Component
{
    public $closeModal = false;

    public $password;

    public function update()
    {
        $user = User::where('id', Auth()->user()->id)->first();

        $this->validate([
            'password' => 'required|min:8'
        ]);

        User::where('id', auth()->user()->id)->update([
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
        ]);

        $this->emit('passwordUpdated');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.profil.update-password');
    }
}
