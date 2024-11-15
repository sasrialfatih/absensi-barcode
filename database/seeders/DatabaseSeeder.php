<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // admin
        \App\Models\User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);


        \App\Models\Qrcode::create([
            'code' => Str::random(20) 
        ]);


        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Technical' 
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Admin & Services' 
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'CSR' 
        ]);


        \App\Models\Pegawai::create([
            'no_karyawan' => 'GBU-003',
            'nama' => 'Suparno',
            'id_jabatan' => rand(1,3),
            'jenis_kelamin' => 'Laki-Laki',
            'nomor_telepon' => '6285254100358',
        ]);
        \App\Models\Pegawai::create([
            'no_karyawan' => 'GBU-008',
            'nama' => 'Iwan Agustiawan',
            'id_jabatan' => rand(1,3),
            'jenis_kelamin' => 'Laki-Laki',
            'nomor_telepon' => '6285254100358',
        ]);
        \App\Models\Pegawai::create([
            'no_karyawan' => 'GBU-025',
            'nama' => 'Gunawan Aripin',
            'id_jabatan' => rand(1,3),
            'jenis_kelamin' => 'Laki-Laki',
            'nomor_telepon' => '6285254100358',
        ]);
        
    }
}
