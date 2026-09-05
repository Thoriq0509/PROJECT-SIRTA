@extends('layouts.admin')

@section('title', 'Tambah Dokumentasi | SIRTA')

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

        <a href="#">
            <i class="bi bi-chat-left-text-fill"></i>
            <span>Pengaduan Warga</span>
        </a>

        <div class="menu-title mt-4">
            Pengaturan
        </div>

        <a href="#">
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

    <!-- TOPBAR -->
    <div class="topbar">

        <div class="d-flex align-items-center gap-2">

            <button class="mobile-menu" id="mobileMenu">
                <i class="bi bi-list"></i>
            </button>

            <div class="topbar-title">
                Tambah Dokumentasi
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

        <div class="mb-4">

            <div class="welcome-title">
                Tambah Dokumentasi
            </div>

            <div class="welcome-text">
                Tambahkan foto atau video dokumentasi baru.
            </div>

        </div>


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
                Form Dokumentasi
            </div>


            <form
                action="{{ route('admin.dokumentasi.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="mb-3">

                    <label for="file" class="form-label">
                        Foto / Video
                    </label>

                    <input
                        type="file"
                        name="file"
                        id="file"
                        class="form-control"
                        accept="image/*,video/*"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label for="judul_dokumentasi" class="form-label">
                        Judul Dokumentasi
                    </label>

                    <input
                        type="text"
                        name="judul_dokumentasi"
                        id="judul_dokumentasi"
                        class="form-control"
                        value="{{ old('judul_dokumentasi') }}"
                        placeholder="Masukkan judul dokumentasi"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label for="tanggal" class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                        class="form-control"
                        value="{{ old('tanggal') }}"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label for="deskripsi" class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan deskripsi dokumentasi"
                    >{{ old('deskripsi') }}</textarea>

                </div>


                <div class="mb-4">

                    <label for="link_google_drive" class="form-label">
                        Link Google Drive
                    </label>

                    <input
                        type="url"
                        name="link_google_drive"
                        id="link_google_drive"
                        class="form-control"
                        value="{{ old('link_google_drive') }}"
                        placeholder="https://drive.google.com/..."
                    >

                </div>


                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-save"></i>
                        Simpan

                    </button>


                    <a
                        href="{{ route('admin.dokumentasi.index') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection