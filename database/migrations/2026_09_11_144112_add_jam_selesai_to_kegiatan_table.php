<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // Ubah 'waktu' menjadi 'waktu_pelaksanaan' jika kolomnya masih bernama 'waktu'
            if (Schema::hasColumn('kegiatan', 'waktu') && !Schema::hasColumn('kegiatan', 'waktu_pelaksanaan')) {
                $table->renameColumn('waktu', 'waktu_pelaksanaan');
            }
            
            // Tambahkan jam_selesai jika belum ada
            if (!Schema::hasColumn('kegiatan', 'jam_selesai')) {
                $table->time('jam_selesai')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            if (Schema::hasColumn('kegiatan', 'jam_selesai')) {
                $table->dropColumn('jam_selesai');
            }
            if (Schema::hasColumn('kegiatan', 'waktu_pelaksanaan')) {
                $table->renameColumn('waktu_pelaksanaan', 'waktu');
            }
        });
    }
};