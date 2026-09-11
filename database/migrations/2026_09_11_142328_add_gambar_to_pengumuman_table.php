<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // Mengubah nama kolom 'waktu' menjadi 'waktu_pelaksanaan' dan menjadikannya string agar fleksibel
            if (Schema::hasColumn('kegiatan', 'waktu')) {
                $table->renameColumn('waktu', 'waktu_pelaksanaan');
            } else {
                $table->string('waktu_pelaksanaan')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->renameColumn('waktu_pelaksanaan', 'waktu');
        });
    }
};