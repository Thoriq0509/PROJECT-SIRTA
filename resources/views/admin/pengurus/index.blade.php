@extends('layouts.admin')

@section('title', 'Data Pengurus | SIRTA')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <div class="welcome-title">
            Data Pengurus
        </div>

        <div class="welcome-text">
            Kelola data pengurus SIRTA.
        </div>

    </div>


    <a href="{{ route('admin.pengurus.create') }}"
       class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>
        Tambah Pengurus

    </a>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


<div class="dashboard-card">

    <div class="dashboard-card-title">
        Data Pengurus
    </div>


    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>Foto</th>
                    <th>Jabatan</th>
                    <th>Nama Pengurus</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($pengurus as $item)

                    <tr>

                        <td>

                            @if($item->foto)

                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama_pengurus }}"
                                    width="55"
                                    height="55"
                                    style="object-fit: cover; border-radius: 8px;"
                                >

                            @else

                                <span class="text-muted">
                                    Tidak ada foto
                                </span>

                            @endif

                        </td>


                        <td>
                            {{ $item->jabatan }}
                        </td>


                        <td>
                            {{ $item->nama_pengurus }}
                        </td>


                        <td>
                            {{ $item->no_telepon }}
                        </td>


                        <td>

                            <a
                                href="{{ route('admin.pengurus.edit', $item) }}"
                                class="btn btn-sm btn-warning"
                            >

                                <i class="bi bi-pencil"></i>
                                Edit

                            </a>


                            <form
                                action="{{ route('admin.pengurus.destroy', $item) }}"
                                method="POST"
                                class="d-inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data pengurus ini?')"
                                >

                                    <i class="bi bi-trash"></i>
                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-4 text-muted">

                            Belum ada data pengurus.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection