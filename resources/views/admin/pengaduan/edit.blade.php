@extends('layouts.admin')

@section('title', 'Edit Pengaduan | SIRTA')

@section('content')

<div class="mb-4">

    <div class="welcome-title">
        Edit Pengaduan
    </div>

    <div class="welcome-text">
        Perbarui data pengaduan warga.
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
        Form Edit Pengaduan
    </div>

    <form
        action="{{ route('admin.pengaduan.update', $pengaduan) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label class="form-label">
                Bukti Saat Ini
            </label>

            <div>

                @if($pengaduan->bukti)

                    @php
                        $extension = strtolower(
                            pathinfo($pengaduan->bukti, PATHINFO_EXTENSION)
                        );
                    @endphp

                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))

                        <img
                            src="{{ asset('storage/' . $pengaduan->bukti) }}"
                            alt="Bukti Pengaduan"
                            width="120"
                            height="120"
                            style="object-fit: cover; border-radius: 10px;"
                        >

                    @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))

                        <video
                            width="200"
                            controls
                            style="border-radius: 10px;"
                        >
                            <source src="{{ asset('storage/' . $pengaduan->bukti) }}">
                        </video>

                    @endif

                @else

                    <div class="text-muted">
                        Tidak ada bukti.
                    </div>

                @endif

            </div>

        </div>

        <div class="mb-3">

            <label for="bukti" class="form-label">
                Ganti Bukti
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
                value="{{ old('nama_pelapor', $pengaduan->nama_pelapor) }}"
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
                value="{{ old('nomor_hp_pelapor', $pengaduan->nomor_hp_pelapor) }}"
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
            >{{ old('isi_pengaduan', $pengaduan->isi_pengaduan) }}</textarea>

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
                value="{{ old('tanggal_pengaduan', $pengaduan->tanggal_pengaduan) }}"
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

                <option value="diajukan"
                    {{ old('status', $pengaduan->status) === 'diajukan' ? 'selected' : '' }}>
                    Diajukan
                </option>

                <option value="diproses"
                    {{ old('status', $pengaduan->status) === 'diproses' ? 'selected' : '' }}>
                    Diproses
                </option>

                <option value="selesai"
                    {{ old('status', $pengaduan->status) === 'selesai' ? 'selected' : '' }}>
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
                Simpan Perubahan
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

@endsection