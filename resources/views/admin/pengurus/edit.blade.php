@extends('layouts.admin')

@section('title', 'Edit Pengurus | SIRTA')

@section('content')

<div class="mb-4">

    <div class="welcome-title">
        Edit Pengurus
    </div>

    <div class="welcome-text">
        Perbarui data pengurus.
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
        Form Edit Pengurus
    </div>


    <form
        action="{{ route('admin.pengurus.update', $pengurus->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')


        <div class="mb-3">

            <label class="form-label">
                Foto Saat Ini
            </label>

            <div>

                @if($pengurus->foto)

                    <img
                        src="{{ asset('storage/' . $pengurus->foto) }}"
                        alt="{{ $pengurus->nama_pengurus }}"
                        width="100"
                        height="100"
                        style="object-fit: cover; border-radius: 10px;"
                    >

                @else

                    <div class="text-muted">
                        Belum ada foto.
                    </div>

                @endif

            </div>

        </div>


        <div class="mb-3">

            <label for="foto" class="form-label">
                Ganti Foto (Opsional)
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
                value="{{ old('jabatan', $pengurus->jabatan) }}"
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
                value="{{ old('nama_pengurus', $pengurus->nama_pengurus) }}"
                required
            >

        </div>


        <div class="mb-4">

            <label for="no_telepon" class="form-label">
                No. Telepon (Opsional)
            </label>

            <input
                type="text"
                name="no_telepon"
                id="no_telepon"
                class="form-control"
                value="{{ old('no_telepon', $pengurus->no_telepon) }}"
                placeholder="Contoh: 081234567890"
            >

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
                href="{{ route('admin.pengurus.index') }}"
                class="btn btn-secondary"
            >
                Kembali
            </a>

        </div>

    </form>

</div>

@endsection