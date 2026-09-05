@extends('layouts.admin')

@section('title', 'Pengaduan Warga | SIRTA')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <div class="welcome-title">
            Pengaduan Warga
        </div>

        <div class="welcome-text">
            Kelola pengaduan yang dikirim oleh warga SIRTA.
        </div>

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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="dashboard-card-title mb-0">
            Data Pengaduan Warga
        </div>

        <!-- FORM FILTER KATEGORI -->
        <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="d-flex align-items-center">
            <select name="kategori" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                <option value="sosial" {{ request('kategori') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                <option value="infrastruktur" {{ request('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                <option value="keamanan" {{ request('kategori') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                <option value="kebersihan" {{ request('kategori') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
            </select>
        </form>
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

                            {{ isset($item->tanggal_pengaduan) ? \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('d-m-Y') : '-' }}

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if($item->status === 'selesai')

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                            @elseif($item->status === 'diproses')

                                <span class="badge bg-info text-dark">
                                    Diproses
                                </span>

                            @else

                                <span class="badge bg-warning text-dark">
                                    Diajukan
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
                                    class="btn btn-sm btn-warning text-white"
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
                            class="text-center py-4 text-muted"
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

@endsection