@extends('layouts.admin')

@section('title', 'Dokumentasi | SIRTA')

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

        <a href="{{ route('admin.pengurus.index') }}">
            <i class="bi bi-people-fill"></i>
            <span>Data Pengurus</span>
        </a>

        <a href="{{ route('admin.dokumentasi.index') }}" class="active">
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
                Dokumentasi
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
                    Dokumentasi
                </div>

                <div class="welcome-text">
                    Kelola foto dan video dokumentasi kegiatan SIRTA.
                </div>

            </div>

            <a href="{{ route('admin.dokumentasi.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>
                Tambah Dokumentasi

            </a>

        </div>


        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-danger">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        <div class="dashboard-card">

            <div class="dashboard-card-title">
                Data Dokumentasi
            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>File</th>
                            <th>Judul Dokumentasi</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Google Drive</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($dokumentasi as $item)

                            <tr>

                                <td>

                                    @if($item->file)

                                        @php
                                            $extension = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                                        @endphp

                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))

                                            <img
                                                src="{{ asset('storage/' . $item->file) }}"
                                                alt="{{ $item->judul_dokumentasi }}"
                                                width="70"
                                                height="70"
                                                style="object-fit: cover; border-radius: 8px;"
                                            >

                                        @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))

                                            <video
                                                width="100"
                                                height="70"
                                                controls
                                                style="object-fit: cover; border-radius: 8px;"
                                            >
                                                <source src="{{ asset('storage/' . $item->file) }}">
                                                Browser tidak mendukung video.
                                            </video>

                                        @else

                                            <span class="text-muted">
                                                File

                                            </span>

                                        @endif

                                    @else

                                        <span class="text-muted">
                                            Tidak ada file
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    {{ $item->judul_dokumentasi }}
                                </td>


                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </td>


                                <td>
                                    {{ $item->deskripsi ?? '-' }}
                                </td>


                                <td>

                                    @if($item->link_google_drive)

                                        <a
                                            href="{{ $item->link_google_drive }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            <i class="bi bi-google"></i>
                                            Buka
                                        </a>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.dokumentasi.edit', $item) }}"
                                        class="btn btn-sm btn-warning"
                                    >
                                        <i class="bi bi-pencil"></i>
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('admin.dokumentasi.destroy', $item) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus dokumentasi ini?')"
                                        >
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">
                                    Belum ada dokumentasi.
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