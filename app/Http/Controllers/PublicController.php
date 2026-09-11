<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Kegiatan;
use App\Models\Pengurus;
use App\Models\Dokumentasi;
use Carbon\Carbon; // Wajib dipanggil untuk manipulasi dan cek waktu

class PublicController extends Controller
{
    public function index()
    {
        // 1. AUTO-DRAFT PENGUMUMAN
        $pengumuman = Pengumuman::latest()->get();
        
        foreach ($pengumuman as $p) {
            // Pastikan data memiliki tanggal untuk dicek
            if ($p->tanggal) { 
                $waktuBatas = Carbon::parse($p->tanggal)->endOfDay();
                
                // Jika status publish dan tanggal pelaksanaannya sudah terlewat
                if (strtolower($p->status) === 'publish' && $waktuBatas->isPast()) {
                    
                    // Cek apakah admin mengedit (mem-publish ulang) SETELAH kedaluwarsa
                    $diupdateSetelahKedaluarsa = $p->updated_at->isAfter($waktuBatas);
                    
                    // Jika tidak ada update dari admin setelah lewat tanggal, otomatis Draft
                    if (!$diupdateSetelahKedaluarsa) {
                        $p->update(['status' => 'draft']);
                        $p->status = 'draft'; // Perbarui objek saat ini agar view langsung menyesuaikan
                    }
                }
            }
        }

        // 2. AUTO-DRAFT KEGIATAN
        $kegiatan = Kegiatan::latest()->get();
        
        foreach ($kegiatan as $k) {
            if ($k->tanggal) {
                $waktuBatas = Carbon::parse($k->tanggal)->endOfDay();
                
                if (strtolower($k->status) === 'publish' && $waktuBatas->isPast()) {
                    $diupdateSetelahKedaluarsa = $k->updated_at->isAfter($waktuBatas);
                    
                    if (!$diupdateSetelahKedaluarsa) {
                        $k->update(['status' => 'draft']);
                        $k->status = 'draft';
                    }
                }
            }
        }

        // 3. AMBIL DATA PENGURUS & DOKUMENTASI
        $pengurus = Pengurus::latest()->get();
        $dokumentasi = Dokumentasi::latest()->get();

        /*
         * Semua data dikirim ke view.
         * Penyaringan data mana yang berstatus 'publish' dan layak tampil
         * sudah ditangani oleh Blade View (welcome.blade.php / public.index)
         * menggunakan fungsi collect()->filter() yang kita buat sebelumnya.
         */
        return view('public.index', compact(
            'pengumuman',
            'kegiatan',
            'pengurus',
            'dokumentasi'
        ));
    }
}