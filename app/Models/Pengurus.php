<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'foto',
        'jabatan',
        'nama_pengurus',
        'no_telepon',
    ];
}