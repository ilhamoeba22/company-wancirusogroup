<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_unit',
        'slug',
        'deskripsi_umum',
        'layanan_utama',
        'keunggulan',
        'target_pasar',
        'foto_utama',
        'galeri_foto',
        'urutan_tampil',
        'status_publish',
    ];

    protected $casts = [
        'layanan_utama' => 'array',
        'galeri_foto' => 'array',
        'status_publish' => 'boolean',
    ];
}
