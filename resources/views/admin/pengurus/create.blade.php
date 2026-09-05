@extends('layouts.admin')

@section('title', 'Tambah Pengurus | SIRTA')

@section('content')

<div class="mb-4">

    <div class="welcome-title">
        Tambah Pengurus
    </div>

    <div class="welcome-text">
        Tambahkan data pengurus baru.
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
        Form Data Pengurus
    </div>


    <form
        action="{{ route('admin.pengurus.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="mb-3">

            <label for="foto" class="form-label">
                Foto
            </label>

            <input
                type="file"
                name="foto"
                id="foto"
                class="form-control"
                accept="image/*"
            >

        </div>


        <div class="mb-3">

            <label for="jabatan" class="form-label">
                Jabatan
            </label>

            <input
                type="text"
                name="jabatan"
                id="jabatan"
                class="form-control"
                value="{{ old('jabatan') }}"
                placeholder="Masukkan jabatan"
                required
            >

        </div>


        <div class="mb-3">

            <label for="nama_pengurus" class="form-label">
                Nama Pengurus
            </label>

            <input
                type="text"
                name="nama_pengurus"
                id="nama_pengurus"
                class="form-control"
                value="{{ old('nama_pengurus') }}"
                placeholder="Masukkan nama pengurus"
                required
            >

        </div>


        <div class="mb-4">

            <label for="no_telepon" class="form-label">
                No. Telepon <span class="text-muted small">(Opsional)</span>
            </label>

            <input
                type="text"
                name="no_telepon"
                id="no_telepon"
                class="form-control"
                value="{{ old('no_telepon') }}"
                placeholder="Kosongkan jika tidak ingin dipublish"
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
                href="{{ route('admin.pengurus.index') }}"
                class="btn btn-secondary"
            >

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection