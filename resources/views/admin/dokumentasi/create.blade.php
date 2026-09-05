@extends('layouts.admin')

@section('title', 'Tambah Dokumentasi | SIRTA')

@section('content')

<div class="mb-4">

    <div class="welcome-title">
        Tambah Dokumentasi
    </div>

    <div class="welcome-text">
        Tambahkan foto atau video dokumentasi baru.
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
        Form Dokumentasi
    </div>


    <form
        action="{{ route('admin.dokumentasi.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="mb-3">

            <label for="file" class="form-label">
                Foto / Video
            </label>

            <input
                type="file"
                name="file"
                id="file"
                class="form-control"
                accept="image/*,video/*"
                required
            >

        </div>


        <div class="mb-3">

            <label for="judul_dokumentasi" class="form-label">
                Judul Dokumentasi
            </label>

            <input
                type="text"
                name="judul_dokumentasi"
                id="judul_dokumentasi"
                class="form-control"
                value="{{ old('judul_dokumentasi') }}"
                placeholder="Masukkan judul dokumentasi"
                required
            >

        </div>


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


        <div class="mb-3">

            <label for="deskripsi" class="form-label">
                Deskripsi
            </label>

            <textarea
                name="deskripsi"
                id="deskripsi"
                class="form-control"
                rows="4"
                placeholder="Masukkan deskripsi dokumentasi"
            >{{ old('deskripsi') }}</textarea>

        </div>


        <div class="mb-4">

            <label for="link_google_drive" class="form-label">
                Link Google Drive
            </label>

            <input
                type="url"
                name="link_google_drive"
                id="link_google_drive"
                class="form-control"
                value="{{ old('link_google_drive') }}"
                placeholder="https://drive.google.com/..."
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
                href="{{ route('admin.dokumentasi.index') }}"
                class="btn btn-secondary"
            >
                Kembali
            </a>

        </div>

    </form>

</div>

@endsection