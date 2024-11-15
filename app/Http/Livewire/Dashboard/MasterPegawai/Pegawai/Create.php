<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Pegawai;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Livewire\Component;

class Create extends Component
{
    public $closeModal = false;

    // data request
    public $no_karyawan;
    public $nama;
    public $jenis_kelamin;
    public $devisi;
    public $nomor_telepon;
   

    public function mount()
    {
        $this->no_karyawan = 'GBU-';
    }

    public function store()
    {
        $rules = [
            'no_karyawan' => 'max:255|required|unique:pegawai,no_karyawan',
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'devisi' => 'required|max:255',
            'nomor_telepon' => 'required|max:255',
        ];

        $this->validate($rules);

        Pegawai::create([
            'no_karyawan' => $this->no_karyawan,
            'nama' => $this->nama,
            'id_jabatan' => $this->devisi,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nomor_telepon' => $this->nomor_telepon,
        ]);

        $this->emit('stored');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.master-pegawai.pegawai.create',[
            'dataJabatan' => Jabatan::get()
        ]);
    }
}
