@extends('layouts.admin')

@section('title', 'Tambah Pengurus | SIRTA')

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

        <a href="#">
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


<!-- MAIN CONTENT -->
<div class="main-content">

    <div class="topbar">

        <div class="d-flex align-items-center gap-2">

            <button class="mobile-menu" id="mobileMenu">
                <i class="bi bi-list"></i>
            </button>

            <div class="topbar-title">
                Tambah Pengurus
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

        <div class="mb-4">

            <div class="welcome-title">
                Tambah Pengurus
            </div>

            <div class="welcome-text">
                Tambahkan data pengurus baru.
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
                Form Data Pengurus
            </div>


            <form
                action="{{ route('admin.pengurus.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="mb-3">

                    <label for="foto" class="form-label">
                        Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control"
                        accept="image/*"
                    >

                </div>


                <div class="mb-3">

                    <label for="jabatan" class="form-label">
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="jabatan"
                        id="jabatan"
                        class="form-control"
                        value="{{ old('jabatan') }}"
                        placeholder="Masukkan jabatan"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label for="nama_pengurus" class="form-label">
                        Nama Pengurus
                    </label>

                    <input
                        type="text"
                        name="nama_pengurus"
                        id="nama_pengurus"
                        class="form-control"
                        value="{{ old('nama_pengurus') }}"
                        placeholder="Masukkan nama pengurus"
                        required
                    >

                </div>


                <div class="mb-4">

                    <label for="no_telepon" class="form-label">
                        No. Telepon
                    </label>

                    <input
                        type="text"
                        name="no_telepon"
                        id="no_telepon"
                        class="form-control"
                        value="{{ old('no_telepon') }}"
                        placeholder="Masukkan nomor telepon"
                        required
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
                        href="{{ route('admin.pengurus.index') }}"
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