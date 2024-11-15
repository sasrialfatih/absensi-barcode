<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Pegawai;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use Livewire\Component;

class Update extends Component
{
    public $closeModal = false;

    // data request
    public $no_karyawan;
    public $nama;
    public $jenis_kelamin;
    public $devisi;
    public $nomor_telepon;

    public $idEdit;

    public function mount($pegawai)
    {
        $this->no_karyawan = $pegawai['no_karyawan'];
        $this->nama = $pegawai['nama'];
        $this->devisi = $pegawai['id_jabatan'];
        $this->jenis_kelamin = $pegawai['jenis_kelamin'];
        $this->nomor_telepon = $pegawai['nomor_telepon'];

        $this->idEdit = $pegawai['id_pegawai'];
    }

    public function update($id)
    {
        $rules = [
            'no_karyawan' => 'max:255',
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'devisi' => 'required|max:255',
            'nomor_telepon' => 'required|max:255',
        ];

        $cek_pegawai = Pegawai::where('id_pegawai', $id)->first();

        if($cek_pegawai->no_karyawan != $this->no_karyawan){
            $rules['no_karyawan'] = 'max:255|required|unique:pegawai,no_karyawan';
        }

        $this->validate($rules);

        Pegawai::where('id_pegawai', $id)->update([
            'no_karyawan' => $this->no_karyawan,
            'nama' => $this->nama,
            'id_jabatan' => $this->devisi,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nomor_telepon' => $this->nomor_telepon
        ]);

        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if ($pegawai->user) {
            User::where('id', $pegawai->user->id)->update([
                'nama' => $this->nama
            ]);
        }

        $this->emit('updated');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.master-pegawai.pegawai.update',[
            'dataJabatan' => Jabatan::get()
        ]);
    }
}
