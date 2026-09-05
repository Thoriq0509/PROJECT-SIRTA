@extends('layouts.admin')

@section('title', 'Tambah Pengaduan | SIRTA')

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

        <a href="{{ route('admin.dokumentasi.index') }}">
            <i class="bi bi-images"></i>
            <span>Dokumentasi</span>
        </a>

        <a href="{{ route('admin.pengaduan.index') }}" class="active">
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

    <div class="topbar">

        <div class="d-flex align-items-center gap-2">

            <button class="mobile-menu" id="mobileMenu">
                <i class="bi bi-list"></i>
            </button>

            <div class="topbar-title">
                Tambah Pengaduan
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
                Tambah Pengaduan
            </div>

            <div class="welcome-text">
                Tambahkan pengaduan warga secara manual.
            </div>

        </div>

        @if($errors->any())

            <div class="alert alert-danger">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif

        <div class="dashboard-card">

            <div class="dashboard-card-title">
                Form Pengaduan Warga
            </div>

            <form
                action="{{ route('admin.pengaduan.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="mb-3">

                    <label for="bukti" class="form-label">
                        Bukti Foto / Video
                    </label>

                    <input
                        type="file"
                        name="bukti"
                        id="bukti"
                        class="form-control"
                        accept="image/*,video/*"
                    >

                </div>

                <div class="mb-3">

                    <label for="nama_pelapor" class="form-label">
                        Nama Pelapor
                    </label>

                    <input
                        type="text"
                        name="nama_pelapor"
                        id="nama_pelapor"
                        class="form-control"
                        value="{{ old('nama_pelapor') }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label for="nomor_hp_pelapor" class="form-label">
                        Nomor HP Pelapor
                    </label>

                    <input
                        type="text"
                        name="nomor_hp_pelapor"
                        id="nomor_hp_pelapor"
                        class="form-control"
                        value="{{ old('nomor_hp_pelapor') }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label for="isi_pengaduan" class="form-label">
                        Isi Pengaduan
                    </label>

                    <textarea
                        name="isi_pengaduan"
                        id="isi_pengaduan"
                        class="form-control"
                        rows="5"
                        required
                    >{{ old('isi_pengaduan') }}</textarea>

                </div>

                <div class="mb-3">

                    <label for="tanggal_pengaduan" class="form-label">
                        Tanggal Pengaduan
                    </label>

                    <input
                        type="date"
                        name="tanggal_pengaduan"
                        id="tanggal_pengaduan"
                        class="form-control"
                        value="{{ old('tanggal_pengaduan', date('Y-m-d')) }}"
                        required
                    >

                </div>

                <div class="mb-4">

                    <label for="status" class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select"
                        required
                    >

                        <option value="belum selesai">
                            Belum Selesai
                        </option>

                        <option value="selesai">
                            Selesai
                        </option>

                    </select>

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
                        href="{{ route('admin.pengaduan.index') }}"
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