<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_usahas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit');
            $table->string('slug')->unique();
            $table->text('deskripsi_umum')->nullable();
            $table->json('layanan_utama')->nullable();
            $table->text('keunggulan')->nullable();
            $table->text('target_pasar')->nullable();
            $table->string('foto_utama')->nullable();
            $table->json('galeri_foto')->nullable();
            $table->integer('urutan_tampil')->default(0);
            $table->boolean('status_publish')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_usahas');
    }
};
