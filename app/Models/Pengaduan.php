<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'bukti',
        'nama_pelapor',
        'nomor_hp_pelapor',
        'isi_pengaduan',
        'tanggal_pengaduan',
        'status',
    ];
}