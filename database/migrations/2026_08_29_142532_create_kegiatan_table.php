<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('lokasi');
            $table->enum('status', ['akan datang', 'selesai'])->default('akan datang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};