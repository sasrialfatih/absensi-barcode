<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;

class Delete extends Component
{
    public $closeModal = false;

    // data request
    public $nama_divisi;
    public $dataHapus;

    public $idDelete;


    public function mount($jabatan)
    {
        $this->dataHapus = Jabatan::where('id_jabatan', $jabatan)->first();

        $this->nama_divisi = $this->dataHapus->nama_jabatan;

        $this->idDelete = $jabatan;
    }

    public function destroy($id)
    {

        if ($this->dataHapus->pegawai->count() > 0) {
            session()->flash('relation_on');
            return false;
        }

        Jabatan::destroy('id_jabatan', $id);

        $this->emit('deleted');

        $this->closeModal = true;

        session()->flash('message');
    }
    
    public function render()
    {
        return view('livewire.dashboard.master-pegawai.jabatan.delete');
    }
}
