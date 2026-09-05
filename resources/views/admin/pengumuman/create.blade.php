@extends('layouts.admin')

@section('title', 'Tambah Pengumuman | SIRTA')

@section('content')
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
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<!-- FORM -->
<div class="dashboard-card">
    <div class="dashboard-card-title">
        Form Pengumuman
    </div>

    <form action="{{ route('admin.pengumuman.store') }}" method="POST">
        @csrf

        <!-- JUDUL -->
        <div class="mb-3">
            <label for="judul" class="form-label">
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

        <!-- STATUS -->
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
@endsection