@extends('layouts.admin')

@section('title', 'Edit Warga | SIRTA')

@section('content')
<div class="content">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.warga.index') }}" class="btn btn-light border shadow-sm me-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <div>
            <h3 class="fw-bold mb-1 text-dark">Edit Akun Warga</h3>
            <p class="text-muted small mb-0">Perbarui informasi akun untuk warga: {{ $warga->name }}</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.warga.update', $warga->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    
                    <!-- Input Nama -->
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $warga->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <!-- Input NIK -->
                    <div class="col-md-6">
                        <label for="nik" class="form-label fw-semibold">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $warga->nik) }}" required>
                        @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Input Username -->
                    <div class="col-md-6">
                        <label for="username" class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $warga->username) }}" required>
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Input No HP -->
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label fw-semibold">Nomor WhatsApp / HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $warga->no_hp) }}">
                        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Input Password (Opsional) -->
                    <div class="col-md-6">
                        <label for="password" class="form-label fw-semibold">Password Baru <span class="text-muted small">(Opsional)</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Isi hanya jika ingin mereset password warga.</small>
                    </div>
                </div>

                <hr class="my-4 text-muted">
                
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Perbarui Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection