<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi';

    protected $fillable = [
        'file',
        'judul_dokumentasi',
        'tanggal',
        'deskripsi',
        'link_google_drive',
    ];
}