<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Mengubah tipe enum status pada tabel pengaduan
        DB::statement("ALTER TABLE pengaduan MODIFY COLUMN status ENUM('diajukan', 'diproses', 'selesai') NOT NULL DEFAULT 'diajukan'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pengaduan MODIFY COLUMN status ENUM('belum selesai', 'selesai') NOT NULL DEFAULT 'belum selesai'");
    }
};