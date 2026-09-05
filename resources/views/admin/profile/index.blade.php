@extends('layouts.admin')

@section('title', 'Profil Admin | SIRTA')

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

        <a href="{{ route('admin.pengaduan.index') }}">
            <i class="bi bi-chat-left-text-fill"></i>
            <span>Pengaduan Warga</span>
        </a>

        <div class="menu-title mt-4">
            Pengaturan
        </div>

        <a href="{{ route('admin.profile.index') }}" class="active">
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
                Profil Admin
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
                Profil Admin
            </div>

            <div class="welcome-text">
                Kelola informasi akun admin SIRTA.
            </div>

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
                Informasi Profil
            </div>

            <form
                action="{{ route('admin.profile.update') }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label for="name" class="form-label">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        value="{{ old('name', $admin->name) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label for="username" class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="form-control"
                        value="{{ old('username', $admin->username) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email', $admin->email) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label for="no_whatsapp" class="form-label">
                        No. WhatsApp
                    </label>

                    <input
                        type="text"
                        name="no_whatsapp"
                        id="no_whatsapp"
                        class="form-control"
                        value="{{ old('no_whatsapp', $admin->no_whatsapp) }}"
                    >

                </div>

                <div class="mb-3">

                    <label for="password" class="form-label">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                    >

                </div>

                <div class="mb-4">

                    <label for="password_confirmation" class="form-label">
                        Konfirmasi Password Baru
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password baru"
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>

            </form>

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="mt-2"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-danger"
                    onclick="return confirm('Yakin ingin logout?')"
                >
                    <i class="bi bi-box-arrow-left"></i>
                    Logout
                </button>

            </form>

        </div>

    </div>

</div>

@endsection