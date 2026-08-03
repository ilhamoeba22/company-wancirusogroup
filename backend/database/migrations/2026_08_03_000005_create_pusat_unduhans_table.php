<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pusat_unduhans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('Holding');
            $table->text('deskripsi')->nullable();
            $table->string('file_path');
            $table->string('ukuran_file')->nullable();
            $table->string('versi')->default('1.0');
            $table->boolean('status_publish')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pusat_unduhans');
    }
};
