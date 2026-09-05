@extends('layouts.admin')

@section('title', 'Dashboard Admin | SIRTA')

@section('content')
<!-- WELCOME -->
<div class="mb-4">
    <div class="welcome-title">
        Dashboard Admin
    </div>
    <div class="welcome-text">
        Selamat datang kembali! Kelola informasi SIRTA dari sini.
    </div>
</div>

<!-- STATISTICS -->
<div class="row g-4 mb-4">
    <!-- PENGUMUMAN -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <div class="stat-number">
                {{ $totalPengumuman ?? 0 }}
            </div>
            <div class="stat-label">
                Total Pengumuman
            </div>
        </div>
    </div>

    <!-- KEGIATAN -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon icon-green">
                <i class="bi bi-calendar-event-fill"></i>
            </div>
            <div class="stat-number">
                {{ $totalKegiatan ?? 0 }}
            </div>
            <div class="stat-label">
                Jadwal Kegiatan
            </div>
        </div>
    </div>

    <!-- PENGURUS -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon icon-orange">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">
                {{ $totalPengurus ?? 0 }}
            </div>
            <div class="stat-label">
                Data Pengurus
            </div>
        </div>
    </div>

    <!-- PENGADUAN -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon icon-red">
                <i class="bi bi-chat-left-text-fill"></i>
            </div>
            <div class="stat-number">
                {{ $totalPengaduan ?? 0 }}
            </div>
            <div class="stat-label">
                Pengaduan Warga
            </div>
        </div>
    </div>
</div>

<!-- LOWER CONTENT -->
<div class="row g-4">
    <!-- AKTIVITAS TERBARU -->
    <div class="col-12 col-lg-8">
        <div class="dashboard-card">
            <div class="dashboard-card-title">
                Aktivitas Terbaru
            </div>

            @isset($aktivitas)
                @forelse($aktivitas as $item)
                    <div class="activity-item">
                        <div class="activity-icon icon-{{ $item['color'] }}">
                            <i class="bi {{ $item['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="activity-title">
                                {{ $item['title'] }}
                            </div>
                            <div class="activity-time">
                                {{ $item['time']->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-muted py-2">
                        Belum ada aktivitas terbaru.
                    </div>
                @endforelse
            @endisset
        </div>
    </div>

    <!-- AKSES CEPAT -->
    <div class="col-12 col-lg-4">
        <div class="dashboard-card">
            <div class="dashboard-card-title">
                Akses Cepat
            </div>

            <a href="{{ route('admin.pengumuman.create') }}" class="quick-menu">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Tambah Pengumuman</span>
            </a>

            <a href="{{ route('admin.kegiatan.create') }}" class="quick-menu">
                <i class="bi bi-calendar-plus-fill"></i>
                <span>Tambah Kegiatan</span>
            </a>

            <a href="{{ route('admin.pengurus.create') }}" class="quick-menu">
                <i class="bi bi-person-plus-fill"></i>
                <span>Tambah Pengurus</span>
            </a>
            
            <a href="{{ route('admin.warga.create') }}" class="quick-menu">
                <i class="bi bi-person-plus"></i>
                <span>Tambah Akun Warga</span>
            </a>

            <a href="{{ route('admin.dokumentasi.create') }}" class="quick-menu">
                <i class="bi bi-images"></i>
                <span>Tambah Dokumentasi</span>
            </a>
        </div>
    </div>
</div>
@endsection