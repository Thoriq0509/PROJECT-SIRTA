@extends('layouts.admin')

@section('title', 'Tambah Kegiatan | SIRTA')

@section('content')

<div class="mb-4">

    <div class="welcome-title">
        Tambah Kegiatan
    </div>

    <div class="welcome-text">
        Tambahkan jadwal kegiatan baru.
    </div>

</div>


<!-- ERROR -->
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
        Form Jadwal Kegiatan
    </div>


    <form
        action="{{ route('admin.kegiatan.store') }}"
        method="POST"
    >

        @csrf


        <!-- NAMA KEGIATAN -->
        <div class="mb-3">

            <label
                for="nama_kegiatan"
                class="form-label"
            >
                Nama Kegiatan
            </label>

            <input
                type="text"
                name="nama_kegiatan"
                id="nama_kegiatan"
                class="form-control"
                value="{{ old('nama_kegiatan') }}"
                placeholder="Masukkan nama kegiatan"
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


        <!-- WAKTU PELAKSANAAN & JAM SELESAI -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label
                    for="waktu_pelaksanaan"
                    class="form-label"
                >
                    Jam Mulai
                </label>

                <input
                    type="time"
                    name="waktu_pelaksanaan"
                    id="waktu_pelaksanaan"
                    class="form-control"
                    value="{{ old('waktu_pelaksanaan') }}"
                    required
                >
            </div>

            <div class="col-md-6 mb-3">
                <label
                    for="jam_selesai"
                    class="form-label"
                >
                    Jam Selesai (Opsional)
                </label>

                <input
                    type="time"
                    name="jam_selesai"
                    id="jam_selesai"
                    class="form-control"
                    value="{{ old('jam_selesai') }}"
                >
            </div>
        </div>


        <!-- LOKASI -->
        <div class="mb-3">

            <label
                for="lokasi"
                class="form-label"
            >
                Lokasi
            </label>

            <input
                type="text"
                name="lokasi"
                id="lokasi"
                class="form-control"
                value="{{ old('lokasi') }}"
                placeholder="Masukkan lokasi kegiatan"
                required
            >

        </div>


        <!-- STATUS -->
        <div class="mb-4">

            <label
                for="status"
                class="form-label"
            >
                Status (Override Sistem)
            </label>

            <select
                name="status"
                id="status"
                class="form-select"
            >

                <option value="">
                    -- Otomatis Berdasarkan Sistem --
                </option>

                <option
                    value="Mendatang"
                    {{ old('status') === 'Mendatang' ? 'selected' : '' }}
                >
                    Paksa: Mendatang
                </option>

                <option
                    value="Berlangsung"
                    {{ old('status') === 'Berlangsung' ? 'selected' : '' }}
                >
                    Paksa: Berlangsung
                </option>

                <option
                    value="Selesai"
                    {{ old('status') === 'Selesai' ? 'selected' : '' }}
                >
                    Paksa: Selesai
                </option>

            </select>
            <small class="text-muted">Biarkan kosong jika ingin status berjalan otomatis sesuai waktu.</small>

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
                href="{{ route('admin.kegiatan.index') }}"
                class="btn btn-secondary"
            >

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection