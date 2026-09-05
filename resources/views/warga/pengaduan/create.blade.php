@extends('layouts.warga')

@section('title', 'Buat Pengaduan | SIRTA')

@section('content')

<div class="mb-4">
    <div class="welcome-title">Buat Pengaduan Baru</div>
    <div class="welcome-text">Sampaikan keluhan atau masukan Anda terkait lingkungan RT.</div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="dashboard-card">
    <div class="dashboard-card-title">Form Pengaduan Warga</div>
    <form action="{{ route('warga.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Pengaduan</label>
            <select name="kategori" id="kategori" class="form-select" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="keamanan" {{ old('kategori') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                <option value="kebersihan" {{ old('kategori') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                <option value="infrastruktur" {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>Sosial & Ketertiban</option>
                <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="isi_pengaduan" class="form-label">Isi Pengaduan / Keluhan</label>
            <textarea name="isi_pengaduan" id="isi_pengaduan" class="form-control" rows="5" placeholder="Jelaskan detail permasalahan yang terjadi..." required>{{ old('isi_pengaduan') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="bukti" class="form-label">Bukti Foto / Video (Opsional)</label>
            <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*,video/*">
            <small class="text-muted">Format: JPG, PNG, WEBP, MP4 (Maks. ukuran standar)</small>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send"></i> Kirim Pengaduan
            </button>
            <a href="{{ route('warga.pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection