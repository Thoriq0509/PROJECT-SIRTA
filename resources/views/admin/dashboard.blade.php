@extends('layouts.admin')

@section('title', 'Dashboard Admin | SIRTA')

@section('content')

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <div class="sidebar-brand">

        <img
            src="{{ asset('images/logo-sirta.jpg') }}"
            alt="Logo SIRTA"
            class="sidebar-logo"
        >

        <span>SIRTA</span>

    </div>

    <div class="sidebar-menu">

        <div class="menu-title">
            Menu Utama
        </div>

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}" class="active">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <!-- PENGUMUMAN -->
        <a href="{{ route('admin.pengumuman.index') }}">
            <i class="bi bi-megaphone-fill"></i>
            <span>Pengumuman</span>
        </a>

        <!-- KEGIATAN -->
        <a href="{{ route('admin.kegiatan.index') }}">
            <i class="bi bi-calendar-event-fill"></i>
            <span>Jadwal Kegiatan</span>
        </a>

        <!-- DATA PENGURUS -->
        <a href="{{ route('admin.pengurus.index') }}">
            <i class="bi bi-people-fill"></i>
            <span>Data Pengurus</span>
        </a>

        <!-- DOKUMENTASI -->
        <a href="{{ route('admin.dokumentasi.index') }}">
            <i class="bi bi-images"></i>
            <span>Dokumentasi</span>
        </a>

        <!-- PENGADUAN -->
        <a href="{{ route('admin.pengaduan.index') }}">
            <i class="bi bi-chat-left-text-fill"></i>
            <span>Pengaduan Warga</span>
        </a>

        <!-- PENGATURAN -->
        <div class="menu-title mt-4">
            Pengaturan
        </div>

        <!-- PROFIL -->
        <a href="{{ route('admin.profile.index') }}">
            <i class="bi bi-person-circle"></i>
            <span>Profil Admin</span>
        </a>

    </div>

    <!-- LOGOUT -->
    <div class="logout">

        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button type="submit">

                <i class="bi bi-box-arrow-left"></i>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</div>


<!-- OVERLAY MOBILE -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>


<!-- MAIN CONTENT -->
<div class="main-content">


    <!-- TOPBAR -->
    <div class="topbar">

        <div class="d-flex align-items-center gap-2">

            <button
                class="mobile-menu"
                id="mobileMenu"
            >

                <i class="bi bi-list"></i>

            </button>


            <div class="topbar-title">
                Dashboard
            </div>

        </div>


        <div class="admin-profile">

            <div class="admin-avatar">

                <i class="bi bi-person-fill"></i>

            </div>


            <div>

                <div class="admin-name">
                    {{ auth()->user()->name }}
                </div>


                <div class="admin-role">
                    {{ ucfirst(auth()->user()->role) }}
                </div>

            </div>

        </div>

    </div>


    <!-- CONTENT -->
    <div class="content">


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

                        {{ $totalPengumuman }}

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

                        {{ $totalKegiatan }}

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

                        {{ $totalPengurus }}

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

                        {{ $totalPengaduan }}

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

                </div>

            </div>


            <!-- AKSES CEPAT -->
            <div class="col-12 col-lg-4">

                <div class="dashboard-card">

                    <div class="dashboard-card-title">
                        Akses Cepat
                    </div>


                    <!-- TAMBAH PENGUMUMAN -->
                    <a
                        href="{{ route('admin.pengumuman.create') }}"
                        class="quick-menu"
                    >

                        <i class="bi bi-plus-circle-fill"></i>

                        <span>
                            Tambah Pengumuman
                        </span>

                    </a>


                    <!-- TAMBAH KEGIATAN -->
                    <a
                        href="{{ route('admin.kegiatan.create') }}"
                        class="quick-menu"
                    >

                        <i class="bi bi-calendar-plus-fill"></i>

                        <span>
                            Tambah Kegiatan
                        </span>

                    </a>


                    <!-- TAMBAH PENGURUS -->
                    <a
                        href="{{ route('admin.pengurus.create') }}"
                        class="quick-menu"
                    >

                        <i class="bi bi-person-plus-fill"></i>

                        <span>
                            Tambah Pengurus
                        </span>

                    </a>


                    <!-- TAMBAH DOKUMENTASI -->
                    <a
                        href="{{ route('admin.dokumentasi.create') }}"
                        class="quick-menu"
                    >

                        <i class="bi bi-images"></i>

                        <span>
                            Tambah Dokumentasi
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection