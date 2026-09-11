<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman'; // Sesuaikan jika nama tabelnya beda

    // Pastikan 'isi' ada di dalam array ini!
    protected $fillable = [
        'judul',
        'tanggal',
        'isi',
        'status',
        'gambar', // Tambahkan ini jika ingin menyimpan nama file gambar
    ];
}