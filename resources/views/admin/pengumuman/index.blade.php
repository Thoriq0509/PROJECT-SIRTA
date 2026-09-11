@extends('layouts.admin')

@section('title', 'Kelola Pengumuman | SIRTA')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Kelola Pengumuman</h3>
        <p class="text-muted small mb-0">Daftar pengumuman yang akan ditampilkan ke warga.</p>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Pengumuman
    </a>
</div>

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
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Isi Ringkas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengumumans as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->gambar)
                                @php $extension = strtolower(pathinfo($item->gambar, PATHINFO_EXTENSION)); @endphp
                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Thumbnail" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))
                                    <div class="bg-dark text-white rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;" title="File Video">
                                        <i class="bi bi-play-fill fs-5"></i>
                                    </div>
                                @endif
                            @else
                                <span class="text-muted small fst-italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $item->judul }}</td>
                        <td style="max-width: 250px;">{{ Str::limit($item->isi, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td>
                            @if(isset($item->status) && strtolower($item->status) === 'publish')
                                <span class="badge bg-success">Publish</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.pengumuman.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
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
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada data pengumuman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection