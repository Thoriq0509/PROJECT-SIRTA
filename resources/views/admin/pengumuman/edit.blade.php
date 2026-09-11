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

        <!-- PENTING: enctype wajib ada untuk upload file -->
        <form action="{{ route('admin.pengumuman.update', $pengumuman) }}"
              method="POST" enctype="multipart/form-data">

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

            <div class="mb-3">
                <label for="isi" class="form-label">
                    Isi Pengumuman
                </label>
                <textarea
                    name="isi"
                    id="isi"
                    rows="4"
                    class="form-control"
                    placeholder="Tulis isi pengumuman di sini...">{{ old('isi', $pengumuman->isi) }}</textarea>
            </div>

            <!-- GAMBAR / THUMBNAIL (OPSIONAL) -->
            <div class="mb-3">
                <label for="gambar" class="form-label">
                    Ganti Gambar / Thumbnail (Opsional)
                </label>
                
                @if($pengumuman->gambar)
                    <div class="mb-2">
                        <span class="d-block text-muted small mb-1">Gambar saat ini:</span>
                        <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="Thumbnail" class="img-thumbnail" style="max-height: 120px;">
                    </div>
                @endif

                <input
                    type="file"
                    name="gambar"
                    id="gambar"
                    class="form-control"
                >
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
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

                    <option value="publish"
                        {{ old('status', $pengumuman->status) == 'publish' ? 'selected' : '' }}>
                        Publish
                    </option>

                    <option value="draft"
                        {{ old('status', $pengumuman->status) == 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>

</div>

@endsection