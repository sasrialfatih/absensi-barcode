<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = ['id_pegawai'];

    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $with = ['jabatan'];


    public function user()
    {
        return $this->hasOne(User::class, 'id_pegawai');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }


}
