<?php

namespace App\Http\Livewire\Dashboard\Pengaturan;

use App\Models\Pengaturan;
use Livewire\Component;

class Update extends Component
{
    public $closeModal = false;

    // data request
    public $jam_masuk;
    public $jam_pulang;
    public $url;
    public $nama;
    public $jabatan;

    public $idEdit;

    public function mount($pengaturan)
    {
        $this->jam_masuk = $pengaturan['jam_masuk'];
        $this->jam_pulang = $pengaturan['jam_pulang'];
        $this->url = $pengaturan['url'];
        $this->nama = $pengaturan['pimpinan'];
        $this->jabatan = $pengaturan['jabatan'];

        $this->idEdit = $pengaturan['id'];
    }

    public function update($id)
    {
        $rules = [
            'jam_masuk' => 'required|max:8|min:8',
            'jam_pulang' => 'required|max:8|min:8',
            'url' => 'required|max:255',
            'nama' => 'required|max:255',
            'jabatan' => 'required|max:255',
        ];

        $this->validate($rules);

        Pengaturan::where('id', $id)->update([
            'jam_masuk' => $this->jam_masuk,
            'jam_pulang' => $this->jam_pulang,
            'url' => $this->url,
            'pimpinan' => $this->nama,
            'jabatan' => $this->jabatan,
        ]);

        $this->emit('updated');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.pengaturan.update');
    }
}
