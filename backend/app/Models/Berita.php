<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'isi',
        'gambar_utama',
        'tanggal_publish',
        'status_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'status_publish' => 'boolean',
    ];
}
