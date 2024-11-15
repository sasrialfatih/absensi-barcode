<?php

namespace App\Http\Livewire\Dashboard\MasterPegawai\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireCreate = false;
    public $showLivewireUpdate = false;
    public $showLivewireDelete = false;
    public $showLivewireShow = false;

    public $getJabatan;

    public $paginate = 20;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
        'updated' => 'handleUpdated',
        'deleted' => 'handleDeleted',
        'show' => 'handleShow',

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

       $jabatan = Jabatan::where('id_jabatan', $id)->first();
        $this->getJabatan =$jabatan;
    }

    public function handleShow()
    {
        $this->showLivewireShow = false;
    }

    // edit
    public function edit($id)
    {
        $this->showLivewireUpdate = true;

       $jabatan = Jabatan::where('id_jabatan', $id)->first();
        $this->getJabatan =$jabatan;
    }
    public function handleUpdated()
    {
        $this->showLivewireUpdate = false;
    }

    // delete
    public function delete($id)
    {
        $this->showLivewireDelete = true;

       $jabatan = Jabatan::where('id_jabatan', $id)->first();
        $this->getJabatan =$jabatan->id_jabatan;
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

    public function render()
    {
        return view('livewire.dashboard.master-pegawai.jabatan.index', [
            'title' => env('APP_NAME') . ' | Dashboard - Master Pegawai - Divisi',
            'title_page' => 'Divisi',
            'icon' => '<i class="bi bi-person-bounding-box"></i>',
            'jabatan' => $this->search == null ?
                Jabatan::orderBy('id_jabatan', 'ASC')->paginate($this->paginate) :
                Jabatan::where('nama_jabatan', 'like', '%' . $this->search . '%')
                ->orderBy('id_jabatan', 'ASC')->paginate($this->paginate)

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
