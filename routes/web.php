<?php

use App\Http\Controllers\ExporController;
use App\Http\Controllers\LogoutController;
use App\Http\Livewire\Dashboard\Index as DashboardIndex;
use App\Http\Livewire\Dashboard\Laporan\Bulanan;
use App\Http\Livewire\Dashboard\Laporan\Harian;
use App\Http\Livewire\Dashboard\Laporan\Index as LaporanIndex;
use App\Http\Livewire\Dashboard\MasterPegawai\Jabatan\Index as JabatanIndex;
use App\Http\Livewire\Dashboard\MasterPegawai\Pegawai\Index as PegawaiIndex;
use App\Http\Livewire\Dashboard\Pengaturan\Index as PengaturanIndex;
use App\Http\Livewire\Dashboard\Profil\Index as ProfilIndex;
use App\Http\Livewire\Dashboard\Qrcode\Index as QrcodeIndex;
use App\Http\Livewire\Dashboard\User\Index as UserIndex;
use App\Http\Livewire\Index;
use App\Http\Livewire\Presensi\Absensi;
use App\Http\Livewire\Presensi\Index as PresensiIndex;
use App\Http\Livewire\Presensi\Riwayat;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Index::class)->name('login');

Route::controller(LogoutController::class)->group(function () {
    Route::post('/logout', 'logout')->middleware('auth');
});

// admin dashboard
Route::get('/dashboard', DashboardIndex::class)->middleware('admin');
Route::get('/dashboard/profil', ProfilIndex::class)->middleware('auth');
Route::get('/dashboard/master-pegawai/devisi', JabatanIndex::class)->middleware('admin');
Route::get('/dashboard/master-pegawai/data', PegawaiIndex::class)->middleware('admin');
Route::get('/dashboard/users', UserIndex::class)->middleware('admin');
Route::get('/dashboard/pengaturan', PengaturanIndex::class)->middleware('admin');
Route::get('/dashboard/qrcode', QrcodeIndex::class)->middleware('admin');
Route::get('/dashboard/laporan/harian', Harian::class)->middleware('admin');
Route::get('/dashboard/laporan/bulanan', Bulanan::class)->middleware('admin');

Route::controller(ExporController::class)->group(function () {
    Route::get('/dashboard/laporan/harian/export', 'laporanHarian')->middleware('admin');
    Route::post('/dashboard/laporan/bulanan/export', 'laporanBulanan')->middleware('admin');
});


// pegawai
Route::get('/presensi', PresensiIndex::class)->middleware('pegawai');
Route::get('/presensi/qrcode/{code:code}', Absensi::class)->middleware('pegawai');
Route::get('/presensi/riwayat', Riwayat::class)->middleware('pegawai');


