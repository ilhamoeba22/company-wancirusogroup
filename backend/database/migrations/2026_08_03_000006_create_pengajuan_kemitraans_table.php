<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_kemitraans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->string('perusahaan');
            $table->string('email');
            $table->string('telepon');
            $table->string('unit_usaha_dituju')->nullable();
            $table->text('pesan');
            $table->string('status')->default('Baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kemitraans');
    }
};
