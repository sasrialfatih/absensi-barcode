<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = ['id_absensi'];

    protected $table = 'absensi';

    protected $primaryKey = 'id_absensi';
}
