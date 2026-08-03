<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Korporat');
            $table->text('ringkasan')->nullable();
            $table->longText('isi')->nullable();
            $table->string('gambar_utama')->nullable();
            $table->timestamp('tanggal_publish')->nullable();
            $table->boolean('status_publish')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
