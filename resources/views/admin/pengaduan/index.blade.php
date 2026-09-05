@extends('layouts.admin')

@section('title', 'Pengaduan Warga | SIRTA')

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

        <button
            class="mobile-menu"
            id="mobileMenu"
        >
            <i class="bi bi-list"></i>
        </button>

        <div class="topbar-title">
            Pengaduan Warga
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
            Pengaduan Warga
        </div>

        <div class="welcome-text">
            Kelola pengaduan yang dikirim oleh warga SIRTA.
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
                <div>{{ $error }}</div>
            @endforeach

        </div>

    @endif


    <div class="dashboard-card">

        <div class="dashboard-card-title">
            Data Pengaduan Warga
        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Bukti</th>
                        <th>Nama Pelapor</th>
                        <th>No. HP</th>
                        <th>Isi Pengaduan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($pengaduan as $item)

                        <tr>

                            {{-- NO --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- BUKTI --}}
                            <td>

                                @if($item->bukti)

                                    @php
                                        $extension = strtolower(
                                            pathinfo(
                                                $item->bukti,
                                                PATHINFO_EXTENSION
                                            )
                                        );

                                        $fileUrl = asset(
                                            'storage/' . $item->bukti
                                        );
                                    @endphp


                                    {{-- FOTO --}}
                                    @if(in_array($extension, [
                                        'jpg',
                                        'jpeg',
                                        'png',
                                        'webp'
                                    ]))

                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                        >

                                            <img
                                                src="{{ $fileUrl }}"
                                                alt="Bukti Pengaduan"
                                                width="80"
                                                height="80"
                                                style="
                                                    object-fit: cover;
                                                    border-radius: 8px;
                                                    border: 1px solid #ddd;
                                                    cursor: pointer;
                                                "
                                            >

                                        </a>


                                    {{-- VIDEO --}}
                                    @elseif(in_array($extension, [
                                        'mp4',
                                        'webm',
                                        'ogg',
                                        'mov'
                                    ]))

                                        <video
                                            width="120"
                                            height="80"
                                            controls
                                            preload="metadata"
                                            style="
                                                object-fit: cover;
                                                border-radius: 8px;
                                                border: 1px solid #ddd;
                                            "
                                        >

                                            <source
                                                src="{{ $fileUrl }}"
                                                type="video/{{ $extension }}"
                                            >

                                            Browser kamu tidak mendukung video.

                                        </video>


                                    {{-- FILE LAIN --}}
                                    @else

                                        <a
                                            href="{{ $fileUrl }}"
                                            target="_blank"
                                            class="btn btn-sm btn-secondary"
                                        >

                                            <i class="bi bi-file-earmark"></i>
                                            Lihat File

                                        </a>

                                    @endif


                                @else

                                    <span class="text-muted">
                                        Tidak ada bukti
                                    </span>

                                @endif

                            </td>


                            {{-- NAMA PELAPOR --}}
                            <td>
                                {{ $item->nama_pelapor }}
                            </td>


                            {{-- NO HP --}}
                            <td>
                                {{ $item->nomor_hp_pelapor }}
                            </td>


                            {{-- ISI PENGADUAN --}}
                            <td style="max-width: 300px;">

                                {{ $item->isi_pengaduan }}

                            </td>


                            {{-- TANGGAL --}}
                            <td>

                                {{ \Carbon\Carbon::parse(
                                    $item->tanggal_pengaduan
                                )->format('d-m-Y') }}

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($item->status === 'selesai')

                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Belum Selesai
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route(
                                            'admin.pengaduan.edit',
                                            $item
                                        ) }}"
                                        class="btn btn-sm btn-warning"
                                    >

                                        <i class="bi bi-pencil"></i>
                                        Edit

                                    </a>


                                    <form
                                        action="{{ route(
                                            'admin.pengaduan.destroy',
                                            $item
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm(
                                                'Yakin ingin menghapus pengaduan ini?'
                                            )"
                                        >

                                            <i class="bi bi-trash"></i>
                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-4"
                            >

                                <i class="bi bi-chat-left-text fs-3 d-block mb-2"></i>

                                Belum ada pengaduan warga.

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
