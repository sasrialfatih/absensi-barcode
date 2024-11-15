<?php

namespace App\Http\Livewire\Dashboard\Laporan;

use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;

class Harian extends Component
{
    use WithPagination;

    public $paginate = 20;
    public $search;

    protected $paginationTheme = 'bootstrap';

    public $tanggal;
    public $bulan;
    public $tahun;

    protected $listeners = [];

    public function mount()
    {
        $this->tanggal = date('d');
        $this->bulan = date('m');
        $this->tahun = date('Y');
        // dd($this->bulan);
    }

    public function export()
    {
        return redirect('/dashboard/laporan/harian/export?tanggal='.$this->tahun .':'. $this->bulan .':'. $this->tanggal);
    }
    
    public function render()
    {
        return view('livewire.dashboard.laporan.harian',[
            'title' => env('APP_NAME') . ' | Dashboard | Laporan Harian',
            'title_page' => 'Laporan Harian',
            'icon' => '<i class="bi bi-card-text"></i>',
            'pegawai' => $this->search == null ?
                Pegawai::orderBy('nama', 'ASC')->paginate($this->paginate) :
                Pegawai::where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('nama', 'ASC')->paginate($this->paginate)
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
