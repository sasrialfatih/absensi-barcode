<?php

namespace App\Http\Livewire\Dashboard\Profil;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class UpdateNama extends Component
{
    public $closeModal = false;

    public $nama;

    public function update()
    {

        $user = User::where('id', Auth()->user()->id)->first();
        // dd($user->guru_mapel);

        $this->validate([
            'nama' => 'required|max:25'
        ]);

        User::where('id', auth()->user()->id)->update([
            'nama' => strtoupper($this->nama)
        ]);

        $this->emit('namaUpdated');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.profil.update-nama');
    }
}
