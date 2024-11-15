<?php

namespace App\Http\Livewire\Dashboard\Profil;

use App\Models\User;
use Livewire\Component;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class UpdateUsername extends Component
{
    public $closeModal = false;

    public $username;


    public function update()
    {
        $user = User::where('id', Auth()->user()->id)->first();

        $this->validate([
            'username' => 'required|unique:users,username|max:255'
        ]);

        User::where('id', auth()->user()->id)->update([
            'username' => $this->username
        ]);

        $this->emit('usernameUpdated');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.profil.update-username');
    }
}
