<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Pegawai;

use App\Models\Absensi;
use App\Models\Pegawai;
use Livewire\Component;

class Delete extends Component
{
    public $closeModal = false;

    // data request
    public $nama;

    public $dataHapus;

    public $idDelete;


    public function mount($pegawai)
    {
        $this->dataHapus = Pegawai::where('id_pegawai', $pegawai)->first();

        $this->nama = $this->dataHapus->nama;

        $this->idDelete = $pegawai;
    }

    public function destroy($id)
    {
        $absensi_pegawai = Absensi::where('id_pegawai', $id)->get();

        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        
        if ($absensi_pegawai->count() > 0) {
            session()->flash('relation_on');
            return false;
        }

        if ($pegawai->user) {
            session()->flash('relation_on_user');
            return false;
        }

        Pegawai::destroy('id_pegawai', $id);

        $this->emit('deleted');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.master-pegawai.pegawai.delete');
    }
}
