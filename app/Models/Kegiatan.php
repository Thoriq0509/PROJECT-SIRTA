<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu_pelaksanaan',
        'jam_selesai',
        'lokasi',
        'status',
    ];

    // Accessor untuk mendapatkan status final (manual admin atau hitungan sistem)
    public function getStatusFinalAttribute()
    {
        // Jika admin memilih status override manual secara spesifik
        if (!empty($this->attributes['status']) && in_array($this->attributes['status'], ['Mendatang', 'Berlangsung', 'Selesai'])) {
            return $this->attributes['status'];
        }

        $now = Carbon::now('Asia/Jakarta');

        try {
            $tglMulai = Carbon::parse($this->tanggal . ' ' . $this->waktu_pelaksanaan, 'Asia/Jakarta');
            
            $tglSelesai = $this->jam_selesai 
                ? Carbon::parse($this->tanggal . ' ' . $this->jam_selesai, 'Asia/Jakarta') 
                : $tglMulai->copy()->addHours(2); 

            if ($now->lt($tglMulai)) {
                return 'Mendatang';
            } elseif ($now->gte($tglMulai) && $now->lte($tglSelesai)) {
                return 'Berlangsung';
            } else {
                return 'Selesai';
            }
        } catch (\Exception $e) {
            return 'Mendatang';
        }
    }
}