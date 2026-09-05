<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('jabatan');
            $table->string('nama_pengurus');
            $table->string('no_telepon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};