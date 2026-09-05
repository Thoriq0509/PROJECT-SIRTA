@extends('layouts.warga')

@section('title', 'Edit Pengaduan | SIRTA')

@section('content')

<div class="mb-4">
    <div class="welcome-title">Edit Pengaduan</div>
    <div class="welcome-text">Perbarui detail pengaduan yang telah Anda ajukan.</div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="dashboard-card">
    <div class="dashboard-card-title">Form Edit Pengaduan</div>
    <form action="{{ route('warga.pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Pengaduan</label>
            <select name="kategori" id="kategori" class="form-select" required>
                <option value="keamanan" {{ old('kategori', $pengaduan->kategori) == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                <option value="kebersihan" {{ old('kategori', $pengaduan->kategori) == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                <option value="infrastruktur" {{ old('kategori', $pengaduan->kategori) == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                <option value="sosial" {{ old('kategori', $pengaduan->kategori) == 'sosial' ? 'selected' : '' }}>Sosial & Ketertiban</option>
                <option value="lainnya" {{ old('kategori', $pengaduan->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="isi_pengaduan" class="form-label">Isi Pengaduan / Keluhan</label>
            <textarea name="isi_pengaduan" id="isi_pengaduan" class="form-control" rows="5" required>{{ old('isi_pengaduan', $pengaduan->isi_pengaduan) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="bukti" class="form-label">Ganti Bukti Foto / Video (Opsional)</label>
            @if($pengaduan->bukti)
                <div class="mb-2">
                    <small class="text-muted d-block">File saat ini:</small>
                    <a href="{{ asset('storage/' . $pengaduan->bukti) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat Bukti Lama</a>
                </div>
            @endif
            <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*,video/*">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Perbarui Pengaduan
            </button>
            <a href="{{ route('warga.pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection