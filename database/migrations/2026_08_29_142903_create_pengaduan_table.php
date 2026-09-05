<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('bukti')->nullable();
            $table->string('nama_pelapor');
            $table->string('nomor_hp_pelapor');
            $table->text('isi_pengaduan');
            $table->date('tanggal_pengaduan');
            $table->enum('status', ['belum selesai', 'selesai'])->default('belum selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};