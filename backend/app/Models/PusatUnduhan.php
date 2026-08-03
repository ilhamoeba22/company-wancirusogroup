<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PusatUnduhan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'file_path',
        'ukuran_file',
        'versi',
        'status_publish',
    ];

    protected $casts = [
        'status_publish' => 'boolean',
    ];
}
