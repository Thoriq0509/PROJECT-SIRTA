@extends('layouts.admin')

@section('title', 'Edit Kegiatan | SIRTA')

@section('content')

<div class="content">

    <div class="mb-4">

        <div class="welcome-title">
            Edit Kegiatan
        </div>

        <div class="welcome-text">
            Perbarui jadwal kegiatan.
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
            Form Edit Kegiatan
        </div>


        <form action="{{ route('admin.kegiatan.update', $kegiatan) }}"
              method="POST">

            @csrf

            @method('PUT')


            <div class="mb-3">

                <label for="nama_kegiatan" class="form-label">
                    Nama Kegiatan
                </label>

                <input
                    type="text"
                    name="nama_kegiatan"
                    id="nama_kegiatan"
                    class="form-control"
                    value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}"
                    required>

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
                    value="{{ old('tanggal', $kegiatan->tanggal) }}"
                    required>

            </div>


            <div class="mb-3">

                <label for="waktu" class="form-label">
                    Waktu
                </label>

                <input
                    type="time"
                    name="waktu"
                    id="waktu"
                    class="form-control"
                    value="{{ old('waktu', $kegiatan->waktu) }}"
                    required>

            </div>


            <div class="mb-3">

                <label for="lokasi" class="form-label">
                    Lokasi
                </label>

                <input
                    type="text"
                    name="lokasi"
                    id="lokasi"
                    class="form-control"
                    value="{{ old('lokasi', $kegiatan->lokasi) }}"
                    required>

            </div>


            <div class="mb-4">

                <label for="status" class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="form-select"
                    required>

                    <option value="akan datang"
                        {{ old('status', $kegiatan->status) == 'akan datang' ? 'selected' : '' }}>
                        Akan Datang
                    </option>

                    <option value="selesai"
                        {{ old('status', $kegiatan->status) == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                </select>

            </div>


            <div class="d-flex gap-2">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-save"></i>
                    Simpan Perubahan

                </button>


                <a href="{{ route('admin.kegiatan.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection