<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sertifikasi',
        'diterbitkan_oleh',
        'tahun',
        'deskripsi',
        'file_gambar',
        'tampil_publik',
    ];

    protected $casts = [
        'tampil_publik' => 'boolean',
    ];
}
