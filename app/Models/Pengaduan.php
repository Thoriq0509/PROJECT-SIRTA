<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'kategori',
        'nama_pelapor',
        'nomor_hp_pelapor',
        'isi_pengaduan',
        'tanggal_pengaduan',
        'bukti',
        'status',
    ];

    // Relasi ke User (Warga)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}