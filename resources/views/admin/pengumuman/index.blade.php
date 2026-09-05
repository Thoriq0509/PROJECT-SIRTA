@extends('layouts.admin')

@section('title', 'Pengumuman | SIRTA')

@section('content')

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

        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.pengumuman.index') }}" class="active">
            <i class="bi bi-megaphone-fill"></i>
            <span>Pengumuman</span>
        </a>

        <a href="{{ route('admin.kegiatan.index') }}">
            <i class="bi bi-calendar-event-fill"></i>
            <span>Jadwal Kegiatan</span>
        </a>

        <a href="{{ route('admin.pengurus.index') }}">
            <i class="bi bi-people-fill"></i>
            <span>Data Pengurus</span>
        </a>

        <a href="{{ route('admin.dokumentasi.index') }}">
            <i class="bi bi-images"></i>
            <span>Dokumentasi</span>
        </a>

        <a href="{{ route('admin.pengaduan.index') }}">
            <i class="bi bi-chat-left-text-fill"></i>
            <span>Pengaduan Warga</span>
        </a>

        <div class="menu-title mt-4">
            Pengaturan
        </div>

        <a href="{{ route('admin.profile.index') }}">
            <i class="bi bi-person-circle"></i>
            <span>Profil Admin</span>
        </a>

    </div>

    <div class="logout">

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="main-content">

    <div class="topbar">

        <div class="d-flex align-items-center gap-2">

            <button class="mobile-menu" id="mobileMenu">
                <i class="bi bi-list"></i>
            </button>

            <div class="topbar-title">
                Pengumuman
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

    <div class="content">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <div class="welcome-title">
                    Pengumuman
                </div>

                <div class="welcome-text">
                    Kelola informasi pengumuman SIRTA.
                </div>

            </div>

            <a href="{{ route('admin.pengumuman.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>
                Tambah Pengumuman

            </a>

        </div>

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        <div class="dashboard-card">

            <div class="dashboard-card-title">
                Data Pengumuman
            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pengumuman as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->judul }}
                                </td>

                                <td>
                                    {{ $item->tanggal }}
                                </td>

                                <td>
                                    {{ ucfirst($item->status) }}
                                </td>

                                <td>

                                    <a href="{{ route('admin.pengumuman.edit', $item) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="bi bi-pencil"></i>
                                        Edit

                                    </a>

                                    <form action="{{ route('admin.pengumuman.destroy', $item) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus pengumuman ini?')">

                                            <i class="bi bi-trash"></i>
                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">
                                    Belum ada data pengumuman.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection