<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemohon',
        'perusahaan',
        'jabatan',
        'email',
        'telepon',
        'tujuan',
        'status',
    ];
}
