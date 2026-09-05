@extends('layouts.admin')

@section('title', 'Tambah Pengumuman | SIRTA')

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
        <a href="{{ route('admin.dashboard') }}">

            <i class="bi bi-grid-1x2-fill"></i>

            <span>Dashboard</span>

        </a>


        <!-- PENGUMUMAN -->
        <a
            href="{{ route('admin.pengumuman.index') }}"
            class="active"
        >

            <i class="bi bi-megaphone-fill"></i>

            <span>Pengumuman</span>

        </a>


        <!-- KEGIATAN -->
        <a href="{{ route('admin.kegiatan.index') }}">

            <i class="bi bi-calendar-event-fill"></i>

            <span>Jadwal Kegiatan</span>

        </a>


        <!-- PENGURUS -->
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

            <button
                class="mobile-menu"
                id="mobileMenu"
            >

                <i class="bi bi-list"></i>

            </button>


            <div class="topbar-title">
                Tambah Pengumuman
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
                Tambah Pengumuman
            </div>


            <div class="welcome-text">
                Tambahkan informasi pengumuman baru.
            </div>

        </div>


        <!-- VALIDATION ERROR -->
        @if($errors->any())

            <div class="alert alert-danger">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        <!-- FORM -->
        <div class="dashboard-card">

            <div class="dashboard-card-title">
                Form Pengumuman
            </div>


            <form
                action="{{ route('admin.pengumuman.store') }}"
                method="POST"
            >

                @csrf


                <!-- JUDUL -->
                <div class="mb-3">

                    <label
                        for="judul"
                        class="form-label"
                    >
                        Judul Pengumuman
                    </label>


                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        class="form-control"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul pengumuman"
                        required
                    >

                </div>


                <!-- TANGGAL -->
                <div class="mb-3">

                    <label
                        for="tanggal"
                        class="form-label"
                    >
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


                <!-- STATUS -->
                <div class="mb-4">

                    <label
                        for="status"
                        class="form-label"
                    >
                        Status
                    </label>


                    <select
                        name="status"
                        id="status"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Pilih Status
                        </option>


                        <option
                            value="aktif"
                            {{ old('status') == 'aktif' ? 'selected' : '' }}
                        >
                            Aktif
                        </option>


                        <option
                            value="tidak aktif"
                            {{ old('status') == 'tidak aktif' ? 'selected' : '' }}
                        >
                            Tidak Aktif
                        </option>

                    </select>

                </div>


                <!-- BUTTON -->
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-save"></i>

                        Simpan

                    </button>


                    <a
                        href="{{ route('admin.pengumuman.index') }}"
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