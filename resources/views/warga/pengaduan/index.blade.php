@extends('layouts.warga') <!-- Sesuaikan dengan layout warga kamu -->

@section('title', 'Dashboard Warga - Pengaduan | SIRTA')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <div class="welcome-title">Dashboard Masyarakat</div>
        <div class="welcome-text">Kelola dan pantau status pengaduan warga Anda di lingkungan RT.</div>
    </div>
    <a href="{{ route('warga.pengaduan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Buat Pengaduan Baru
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="dashboard-card">
    <div class="dashboard-card-title">Daftar Pengaduan Saya</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Bukti</th>
                    <th>Isi Pengaduan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="badge bg-secondary text-uppercase">{{ $item->kategori ?? 'Umum' }}</span>
                    </td>
                    <td>
                        @if($item->bukti)
                            @php
                                $extension = strtolower(pathinfo($item->bukti, PATHINFO_EXTENSION));
                                $fileUrl = asset('storage/' . $item->bukti);
                            @endphp
                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                <a href="{{ $fileUrl }}" target="_blank">
                                    <img src="{{ $fileUrl }}" alt="Bukti" width="60" height="60" style="object-fit: cover; border-radius: 6px;">
                                </a>
                            @else
                                <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat File</a>
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td style="max-width: 250px;">{{ Str::limit($item->isi_pengaduan, 50) }}</td>
                    <td>{{ isset($item->tanggal_pengaduan) ? \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('d-m-Y') : '-' }}</td>
                    <td>
                        @if($item->status === 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($item->status === 'diproses')
                            <span class="badge bg-info text-dark">Diproses</span>
                        @else
                            <span class="badge bg-warning text-dark">Diajukan</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            @if($item->status !== 'selesai' && $item->status !== 'diproses')
                                <a href="{{ route('warga.pengaduan.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Edit Pengaduan">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('warga.pengaduan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengaduan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Pengaduan">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small fst-italic">Terkunci (Diproses/Selesai)</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">Belum ada pengaduan yang Anda ajukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection