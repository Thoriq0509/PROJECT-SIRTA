<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Kegiatan;
use App\Models\Pengurus;
use App\Models\Dokumentasi;

class PublicController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('status', 'aktif')
            ->latest()
            ->get();

        $kegiatan = Kegiatan::latest()->get();

        $pengurus = Pengurus::latest()->get();

        $dokumentasi = Dokumentasi::latest()->get();

        return view('public.index', compact(
            'pengumuman',
            'kegiatan',
            'pengurus',
            'dokumentasi'
        ));
    }
}