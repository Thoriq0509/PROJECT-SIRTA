@extends('layouts.admin')

@section('title', 'Profil Admin | SIRTA')

@section('content')

<div class="mb-4">

    <div class="welcome-title">
        Profil Admin
    </div>

    <div class="welcome-text">
        Kelola informasi akun admin SIRTA.
    </div>

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
        Informasi Profil
    </div>


    <form
        action="{{ route('admin.profile.update') }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="mb-3">

            <label for="name" class="form-label">
                Nama
            </label>

            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name', $admin->name) }}"
                required
            >

        </div>


        <div class="mb-3">

            <label for="username" class="form-label">
                Username
            </label>

            <input
                type="text"
                name="username"
                id="username"
                class="form-control"
                value="{{ old('username', $admin->username) }}"
                required
            >

        </div>


        <div class="mb-3">

            <label for="email" class="form-label">
                Email
            </label>

            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                value="{{ old('email', $admin->email) }}"
                required
            >

        </div>


        <div class="mb-3">

            <label for="no_hp" class="form-label">
                No. HP / WhatsApp
            </label>

            <input
                type="text"
                name="no_hp"
                id="no_hp"
                class="form-control"
                value="{{ old('no_hp', $admin->no_hp) }}"
            >

        </div>


        <div class="mb-3">

            <label for="password" class="form-label">
                Password Baru
            </label>

            <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                placeholder="Kosongkan jika tidak ingin mengubah password"
            >

        </div>


        <div class="mb-4">

            <label for="password_confirmation" class="form-label">
                Konfirmasi Password Baru
            </label>

            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="form-control"
                placeholder="Ulangi password baru"
            >

        </div>


        <button
            type="submit"
            class="btn btn-primary"
        >
            <i class="bi bi-save"></i>
            Simpan Perubahan
        </button>

    </form>


    <form
        action="{{ route('logout') }}"
        method="POST"
        class="mt-3 pt-3 border-top"
    >
        @csrf
        <button
            type="submit"
            class="btn btn-danger"
            onclick="return confirm('Yakin ingin logout?')"
        >
            <i class="bi bi-box-arrow-left"></i>
            Logout
        </button>
    </form>

</div>

@endsection