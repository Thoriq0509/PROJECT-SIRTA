@extends('layouts.admin')

@section('title', 'Jadwal Kegiatan | SIRTA')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <div class="welcome-title">
            Jadwal Kegiatan
        </div>

        <div class="welcome-text">
            Kelola jadwal kegiatan SIRTA.
        </div>

    </div>

    <a href="{{ route('admin.kegiatan.create') }}"
       class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>
        Tambah Kegiatan

    </a>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger">

        @foreach($errors->all() as $error)

            <div>
                {{ $error }}
            </div>

        @endforeach

    </div>

@endif


<!-- DATA KEGIATAN -->
<div class="dashboard-card">

    <div class="dashboard-card-title">
        Data Jadwal Kegiatan
    </div>


    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>


            <tbody>

                @forelse($kegiatan as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->nama_kegiatan }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}
                        </td>

                        <td>
                            {{ $item->lokasi }}
                        </td>

                        <td>

                            @if($item->status === 'akan datang')

                                <span class="badge bg-primary">
                                    Akan Datang
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Selesai
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.kegiatan.edit', $item) }}"
                               class="btn btn-sm btn-warning">

                                <i class="bi bi-pencil"></i>
                                Edit

                            </a>


                            <form action="{{ route('admin.kegiatan.destroy', $item) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">

                                    <i class="bi bi-trash"></i>
                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada jadwal kegiatan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection