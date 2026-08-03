<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKemitraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengirim',
        'perusahaan',
        'email',
        'telepon',
        'unit_usaha_dituju',
        'pesan',
        'status',
    ];
}
