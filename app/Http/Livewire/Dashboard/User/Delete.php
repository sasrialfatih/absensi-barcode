<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\Pegawai;
use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    public $closeModal = false;

    // data request
    public $admin;
    public $nama;
    public $idDelete;


    public function mount($user)
    {
        $data = User::where('id', $user)->first();

        $this->nama = $data->nama;
        $this->idDelete = $user;
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if ($user->pegawai) {
            Pegawai::where('id_pegawai', $user->pegawai->id_pegawai)->update([
                'akun' => false
            ]);
        }

        User::destroy('id', $id);

        $this->emit('deleted');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.user.delete');
    }
}
