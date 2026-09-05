<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\Kegiatan;
use App\Models\Pengurus;
use App\Models\Dokumentasi;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengumuman = Pengumuman::count();

        $totalKegiatan = Kegiatan::count();

        $totalPengurus = Pengurus::count();

        $totalPengaduan = Pengaduan::count();

        $aktivitasPengumuman = Pengumuman::latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'pengumuman',
                    'icon' => 'bi-megaphone-fill',
                    'color' => 'blue',
                    'title' => 'Pengumuman "' . $item->judul . '" ditambahkan',
                    'time' => $item->created_at,
                ];
            });


        $aktivitasKegiatan = Kegiatan::latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'kegiatan',
                    'icon' => 'bi-calendar-event-fill',
                    'color' => 'green',
                    'title' => 'Kegiatan "' . $item->nama_kegiatan . '" ditambahkan',
                    'time' => $item->created_at,
                ];
            });


        $aktivitasPengurus = Pengurus::latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'pengurus',
                    'icon' => 'bi-people-fill',
                    'color' => 'orange',
                    'title' => 'Data pengurus "' . $item->nama_pengurus . '" ditambahkan',
                    'time' => $item->created_at,
                ];
            });


        $aktivitasDokumentasi = Dokumentasi::latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'dokumentasi',
                    'icon' => 'bi-images',
                    'color' => 'blue',
                    'title' => 'Dokumentasi "' . $item->judul_dokumentasi . '" ditambahkan',
                    'time' => $item->created_at,
                ];
            });


        $aktivitasPengaduan = Pengaduan::latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'pengaduan',
                    'icon' => 'bi-chat-left-text-fill',
                    'color' => 'red',
                    'title' => 'Pengaduan dari ' . $item->nama_pelapor . ' masuk',
                    'time' => $item->created_at,
                ];
            });


        $aktivitas = $aktivitasPengumuman
            ->concat($aktivitasKegiatan)
            ->concat($aktivitasPengurus)
            ->concat($aktivitasDokumentasi)
            ->concat($aktivitasPengaduan)
            ->sortByDesc('time')
            ->take(5)
            ->values();


        return view('admin.dashboard', compact(
            'totalPengumuman',
            'totalKegiatan',
            'totalPengurus',
            'totalPengaduan',
            'aktivitas'
        ));
    }
}