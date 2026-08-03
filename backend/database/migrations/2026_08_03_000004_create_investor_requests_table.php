<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investor_requests', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('perusahaan');
            $table->string('jabatan');
            $table->string('email');
            $table->string('telepon');
            $table->text('tujuan');
            $table->string('status')->default('Baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_requests');
    }
};
