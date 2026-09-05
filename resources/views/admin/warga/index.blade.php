@extends('layouts.admin')

@section('title', 'Kelola Warga | SIRTA')

@section('content')
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Kelola Data Warga</h3>
            <p class="text-muted small mb-0">Daftar akun warga yang terdaftar di sistem SIRTA.</p>
        </div>
        <a href="{{ route('admin.warga.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah Warga
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Username</th>
                            <th>No WhatsApp</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wargas as $index => $warga)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-medium">{{ $warga->name }}</td>
                            <td>{{ $warga->nik ?? '-' }}</td>
                            <td>{{ $warga->username }}</td>
                            <td>{{ $warga->no_hp ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.warga.edit', $warga->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <!-- Tombol Delete -->
                                    <form action="{{ route('admin.warga.destroy', $warga->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun warga ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data akun warga.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection