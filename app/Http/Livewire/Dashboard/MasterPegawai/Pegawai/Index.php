<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Pegawai;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireCreate = false;
    public $showLivewireUpdate = false;
    public $showLivewireDelete = false;
    public $showLivewireShow = false;

    public $getPegawai;
    public $profil_instansi;
    public $pengaturan;

    public $paginate = 20;
    public $search;
    public $search_nama;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
        'updated' => 'handleUpdated',
        'deleted' => 'handleDeleted',
        'show' => 'handleShow',

        'success',

        'closeLivewire' => 'handleCloseLivewire',
    ];

    // create
    public function create()
    {
        $this->showLivewireCreate = true;
    }
    public function handleStored()
    {
        $this->showLivewireCreate = false;
    }

    // show
    public function show($id)
    {
        $this->showLivewireShow = true;

        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        $this->getPegawai = $pegawai;
    }

    public function handleShow()
    {
        $this->showLivewireShow = false;
    }

    // edit
    public function edit($id)
    {
        $this->showLivewireUpdate = true;

        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        $this->getPegawai = $pegawai;
    }
    public function handleUpdated()
    {
        $this->showLivewireUpdate = false;
    }

    // delete
    public function delete($id)
    {
        $this->showLivewireDelete = true;

        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        $this->getPegawai = $pegawai->id_pegawai;
    }
    public function handleDeleted()
    {
        $this->showLivewireDelete = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireCreate = false;
        $this->showLivewireUpdate = false;
        $this->showLivewireDelete = false;
    }

    public function akunAktif($id)
    {
        Pegawai::where('id_pegawai', $id)->update([
            'akun' => true
        ]);

        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        $username = $pegawai->no_karyawan;
        $password = strtoupper($username) . '@123';

        User::create([
            'id_pegawai' => $pegawai->id_pegawai,
            'nama' => $pegawai->nama,
            'username' => strtoupper($username),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => 1
        ]);

        session()->flash('message', 'success/Akun untuk ' . $pegawai->nama . ' berhasil diaktifkan');

        $this->emit('success');
    }

    public function akunNonAktif($id)
    {
        Pegawai::where('id_pegawai', $id)->update([
            'akun' => false
        ]);

        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        DB::table('users')->where('id', $pegawai->user->id)->delete();

        session()->flash('message', 'success/Akun untuk ' . $pegawai->nama . ' dimatikan');

        $this->emit('success');
    }

    public function success() {}

    public function exporData()
    {
        return redirect('/dashboard/pegawai/excel');
    }

    public function render()
    {
        return view('livewire.dashboard.master-pegawai.pegawai.index', [
            'title' => env('APP_NAME') . ' | Dashboard | Dashboard - Master Pegawai - Data Pegawai',
            'title_page' => 'Data Pegawai',
            'icon' => '<i class="bi bi-people-fill"></i>',
            'pegawai' => $this->search == null ?
                Pegawai::orderBy('nama', 'ASC')->paginate($this->paginate) :
                Pegawai::where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('nama', 'ASC')->paginate($this->paginate)
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
