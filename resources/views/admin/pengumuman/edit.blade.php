@extends('layouts.admin')

@section('title', 'Edit Pengumuman | SIRTA')

@section('content')

<div class="content">

    <div class="mb-4">

        <div class="welcome-title">
            Edit Pengumuman
        </div>

        <div class="welcome-text">
            Perbarui informasi pengumuman.
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
            Form Edit Pengumuman
        </div>


        <form action="{{ route('admin.pengumuman.update', $pengumuman) }}"
              method="POST">

            @csrf
            @method('PUT')


            <div class="mb-3">

                <label for="judul" class="form-label">
                    Judul Pengumuman
                </label>

                <input
                    type="text"
                    name="judul"
                    id="judul"
                    class="form-control"
                    value="{{ old('judul', $pengumuman->judul) }}"
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
                    value="{{ old('tanggal', $pengumuman->tanggal) }}"
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

                    <option value="aktif"
                        {{ old('status', $pengumuman->status) == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="tidak aktif"
                        {{ old('status', $pengumuman->status) == 'tidak aktif' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>

                </select>

            </div>


            <div class="d-flex gap-2">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-save"></i>
                    Simpan Perubahan

                </button>


                <a href="{{ route('admin.pengumuman.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection