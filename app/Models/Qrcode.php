<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'qrcode';

    protected $primaryKey = 'id';
}
