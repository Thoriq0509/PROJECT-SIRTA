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


        <!-- WAKTU -->
        <div class="mb-3">

            <label
                for="waktu"
                class="form-label"
            >
                Waktu
            </label>

            <input
                type="time"
                name="waktu"
                id="waktu"
                class="form-control"
                value="{{ old('waktu') }}"
                required
            >

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
                    value="akan datang"
                    {{ old('status') === 'akan datang' ? 'selected' : '' }}
                >
                    Akan Datang
                </option>

                <option
                    value="selesai"
                    {{ old('status') === 'selesai' ? 'selected' : '' }}
                >
                    Selesai
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
                href="{{ route('admin.kegiatan.index') }}"
                class="btn btn-secondary"
            >

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection