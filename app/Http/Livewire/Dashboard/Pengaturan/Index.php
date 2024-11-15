<?php

namespace App\Http\Livewire\Dashboard\Pengaturan;

use App\Models\Pengaturan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireUpdate = false;

    public $getPengaturan;

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
        Pengaturan::create([]);
    }



    // edit
    public function edit($id)
    {
        $this->showLivewireUpdate = true;

       $pengaturan = Pengaturan::where('id', $id)->first();
        $this->getPengaturan =$pengaturan;
    }
    public function handleUpdated()
    {
        $this->showLivewireUpdate = false;
    }


    public function handleCloseLivewire()
    {
        $this->showLivewireUpdate = false;
    }

    public function render()
    {
        return view('livewire.dashboard.pengaturan.index', [
            'title' => env('APP_NAME') . ' | Dashboard - Pengaturan',
            'title_page' => 'Pengaturan',
            'icon' => '<i class="bi bi-gear"></i>',
            'pengaturan' => Pengaturan::first()

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
