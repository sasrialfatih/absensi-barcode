<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;

class Update extends Component
{
    public $closeModal = false;

    // data request
    public $nama_divisi;

    public $idEdit;

    public function mount($jabatan)
    {
        $this->nama_divisi = $jabatan['nama_jabatan'];

        $this->idEdit = $jabatan['id_jabatan'];
    }

    public function update($id)
    {
        $rules = [
            'nama_divisi' => 'required|max:255',
        ];

        $getJabatan = Jabatan::where('id_jabatan', $this->idEdit)->first();

        if ($this->nama_divisi != $getJabatan->nama_jabatan) {
            $rules['nama_divisi'] = 'required|max:255|unique:jabatan,nama_jabatan';
        }

        $this->validate($rules);

        Jabatan::where('id_jabatan', $id)->update([
            'nama_jabatan' => $this->nama_divisi,
        ]);

        $this->emit('updated');

        $this->closeModal = true;

        session()->flash('message');
    }
    
    public function render()
    {
        return view('livewire.dashboard.master-pegawai.jabatan.update');
    }
}
