@extends('layouts.admin')

@section('title', 'Dokumentasi | SIRTA')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <div class="welcome-title">
            Dokumentasi
        </div>

        <div class="welcome-text">
            Kelola foto dan video dokumentasi kegiatan SIRTA.
        </div>

    </div>

    <a href="{{ route('admin.dokumentasi.create') }}"
       class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>
        Tambah Dokumentasi

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


<div class="dashboard-card">

    <div class="dashboard-card-title">
        Data Dokumentasi
    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>
                    <th>File</th>
                    <th>Judul Dokumentasi</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Google Drive</th>
                    <th>Aksi</th>
                </tr>

            </thead>


            <tbody>

                @forelse($dokumentasi as $item)

                    <tr>

                        <td>

                            @if($item->file)

                                @php
                                    $extension = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))

                                    <img
                                        src="{{ asset('storage/' . $item->file) }}"
                                        alt="{{ $item->judul_dokumentasi }}"
                                        width="70"
                                        height="70"
                                        style="object-fit: cover; border-radius: 8px;"
                                    >

                                @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))

                                    <video
                                        width="100"
                                        height="70"
                                        controls
                                        style="object-fit: cover; border-radius: 8px;"
                                    >
                                        <source src="{{ asset('storage/' . $item->file) }}">
                                        Browser tidak mendukung video.
                                    </video>

                                @else

                                    <span class="text-muted">
                                        File
                                    </span>

                                @endif

                            @else

                                <span class="text-muted">
                                    Tidak ada file
                                </span>

                            @endif

                        </td>


                        <td>
                            {{ $item->judul_dokumentasi }}
                        </td>


                        <td>
                            {{ isset($item->tanggal) ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') : '-' }}
                        </td>


                        <td>
                            {{ $item->deskripsi ?? '-' }}
                        </td>


                        <td>

                            @if($item->link_google_drive)

                                <a
                                    href="{{ $item->link_google_drive }}"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="bi bi-google"></i>
                                    Buka
                                </a>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        <td>

                            <a
                                href="{{ route('admin.dokumentasi.edit', $item) }}"
                                class="btn btn-sm btn-warning"
                            >
                                <i class="bi bi-pencil"></i>
                                Edit
                            </a>


                            <form
                                action="{{ route('admin.dokumentasi.destroy', $item) }}"
                                method="POST"
                                class="d-inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus dokumentasi ini?')"
                                >
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada dokumentasi.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection