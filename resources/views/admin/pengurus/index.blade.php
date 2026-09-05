@extends('layouts.admin')

@section('title', 'Data Pengurus | SIRTA')

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

        <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.pengumuman.index') }}">
            <i class="bi bi-megaphone-fill"></i>
            <span>Pengumuman</span>
        </a>

        <a href="{{ route('admin.kegiatan.index') }}">
            <i class="bi bi-calendar-event-fill"></i>
            <span>Jadwal Kegiatan</span>
        </a>

        <a href="{{ route('admin.pengurus.index') }}" class="active">
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


<!-- OVERLAY MOBILE -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>


<!-- MAIN CONTENT -->
<div class="main-content">

    <!-- TOPBAR -->
    <div class="topbar">

        <div class="d-flex align-items-center gap-2">

            <button class="mobile-menu" id="mobileMenu">
                <i class="bi bi-list"></i>
            </button>

            <div class="topbar-title">
                Data Pengurus
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

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <div class="welcome-title">
                    Data Pengurus
                </div>

                <div class="welcome-text">
                    Kelola data pengurus SIRTA.
                </div>

            </div>


            <a href="{{ route('admin.pengurus.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>
                Tambah Pengurus

            </a>

        </div>


        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        <div class="dashboard-card">

            <div class="dashboard-card-title">
                Data Pengurus
            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Foto</th>
                            <th>Jabatan</th>
                            <th>Nama Pengurus</th>
                            <th>No. Telepon</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pengurus as $item)

                            <tr>

                                <td>

                                    @if($item->foto)

                                        <img
                                            src="{{ asset('storage/' . $item->foto) }}"
                                            alt="{{ $item->nama_pengurus }}"
                                            width="55"
                                            height="55"
                                            style="object-fit: cover; border-radius: 8px;"
                                        >

                                    @else

                                        <span class="text-muted">
                                            Tidak ada foto
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    {{ $item->jabatan }}
                                </td>


                                <td>
                                    {{ $item->nama_pengurus }}
                                </td>


                                <td>
                                    {{ $item->no_telepon }}
                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.pengurus.edit', $item) }}"
                                        class="btn btn-sm btn-warning"
                                    >

                                        <i class="bi bi-pencil"></i>
                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('admin.pengurus.destroy', $item) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data pengurus ini?')"
                                        >

                                            <i class="bi bi-trash"></i>
                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    Belum ada data pengurus.

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