<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom baru jika belum ada
            if (!Schema::hasColumn('users', 'nik')) {
                $table->string('nik')->unique()->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable()->after('nik');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'warga'])->default('warga')->after('password');
            }
            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nik', 'username', 'role', 'no_hp']);
        });
    }
};