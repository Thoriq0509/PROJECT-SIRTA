<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | SIRTA</title>

<!-- Bootstrap 5 CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --sirta-blue: #1050a2;
        --sirta-blue-hover: #0b3d82;
    }

    body {
        background: linear-gradient(135deg, var(--sirta-blue) 0%, #ffffff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 20px 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .login-card {
        width: 100%;
        max-width: 800px;
        border: none;
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .logo-section {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Ukuran logo diperbesar agar proporsional di sisi kiri */
    .logo-img {
        max-width: 180px;
        width: 100%;
        height: auto;
        object-fit: contain;
    }

    .form-control:focus {
        border-color: var(--sirta-blue);
        box-shadow: 0 0 0 0.25rem rgba(16, 80, 162, 0.25);
    }

    .btn-login {
        background-color: var(--sirta-blue);
        border-color: var(--sirta-blue);
        font-weight: 500;
        padding: 0.8rem;
        border-radius: 8px;
    }

    .btn-login:hover {
        background-color: var(--sirta-blue-hover);
        border-color: var(--sirta-blue-hover);
    }
</style>

</head>

<body>

<div class="container d-flex justify-content-center px-3">

    <div class="card login-card bg-white p-4 p-md-5">

        <div class="row g-4 align-items-center">

            <!-- SISI KIRI: Logo -->
            <div class="col-md-5 logo-section text-center pe-md-4">

                <img
                    class="logo-img"
                    src="{{ asset('../images/logo-sirta.jpg ') }}"
                    alt="Logo SIRTA">

            </div>


            <!-- SISI KANAN: Form Login -->
            <div class="col-md-7 ps-md-4">

                <form action="{{ route('login.process') }}" method="POST">

                    @csrf

                    <!-- Error Login -->
                    @if ($errors->has('login'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('login') }}
                        </div>
                    @endif


                    <!-- Floating Input Email/Username -->
                    <div class="form-floating mb-3">

                        <input
                            type="text"
                            class="form-control @error('login') is-invalid @enderror"
                            id="floatingInput"
                            name="login"
                            value="{{ old('login') }}"
                            placeholder="Masukkan Username atau Email"
                            required>

                        <label for="floatingInput" class="text-muted">
                            Username atau Email
                        </label>

                    </div>


                    <!-- Floating Input Password -->
                    <div class="form-floating mb-4">

                        <input
                            type="password"
                            class="form-control"
                            id="floatingPassword"
                            name="password"
                            placeholder="Password"
                            required>

                        <label for="floatingPassword" class="text-muted">
                            Password
                        </label>

                    </div>


                    <!-- Tombol Login -->
                    <button
                        class="btn btn-primary btn-login w-100"
                        type="submit">
                        Masuk
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


<!-- Bootstrap 5 JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
