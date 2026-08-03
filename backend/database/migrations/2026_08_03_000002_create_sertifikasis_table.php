<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sertifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sertifikasi');
            $table->string('diterbitkan_oleh');
            $table->string('tahun')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_gambar')->nullable();
            $table->boolean('tampil_publik')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikasis');
    }
};
