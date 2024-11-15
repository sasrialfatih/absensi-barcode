<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;

    public $showLivewireCreate = false;
    public $showLivewireDelete = false;

    public $paginate = 15;
    public $search;

    public $pengaturan;

    public $getUser;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
        'deleted' => 'handleDeleted',

        'closeLivewire' => 'handleCloseLivewire'
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

    // delete
    public function delete($id)
    {
        $this->showLivewireDelete = true;

        $user = User::where('id', $id)->first();

        $this->getUser = $user->id;
    }
    public function handleDeleted()
    {
        $this->showLivewireDelete = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireCreate = false;
        $this->showLivewireDelete = false;
    }

    public function resetAkun($id)
    {
        $user = User::where('id', $id)->first();
        $pegawai = $user->pegawai;

        $username = $pegawai->no_karyawan;
        $password = strtoupper($username) . '@123';

            User::where('id', $id)->update([
                'username' => strtoupper($username),
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);

        session()->flash('message', 'success/Reset akun berhasil');

        $this->emit('success');
    }

    public function render()
    {
        return view('livewire.dashboard.user.index', [
            'title' => env('APP_NAME')  . ' | Dashboard - Users',
            'title_page' => 'Users',
            'icon' => '<i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
          </svg></i>',
            'auth' => auth()->user(),
            'user' => $this->search == null ?
                User::orderBy('level', 'ASC')->orderBy('nama', 'ASC')->paginate($this->paginate) :
                User::where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('level', 'ASC')->orderBy('nama', 'ASC')->paginate($this->paginate)
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
