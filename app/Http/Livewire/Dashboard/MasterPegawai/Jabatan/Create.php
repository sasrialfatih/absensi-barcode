<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;

class Create extends Component
{
    
    public $closeModal = false;

    // data request
    public $nama_divisi;

    public function store()
    {
        $this->validate([
            'nama_divisi' => 'required|max:255|unique:jabatan,nama_jabatan',
        ]);

        Jabatan::create([
            'nama_jabatan' =>  $this->nama_divisi
        ]);

        $this->emit('stored');

        $this->closeModal = true;

        session()->flash('message');
    }
    public function render()
    {
        return view('livewire.dashboard.master-pegawai.jabatan.create');
    }
}
