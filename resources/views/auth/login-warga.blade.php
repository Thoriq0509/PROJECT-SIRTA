<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Warga | SIRTA</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
            <div class="col-md-5 logo-section text-center pe-md-4 border-end-md">
                <img class="logo-img" src="{{ asset('images/logo-sirta.jpg') }}" alt="Logo SIRTA">
            </div>

            <!-- SISI KANAN: Form Login Warga -->
            <div class="col-md-7 ps-md-4">
                
                <!-- Judul Form -->
                <div class="text-center text-md-start mb-4">
                    <h4 class="fw-bold mb-1" style="color: var(--sirta-blue);">Login Warga</h4>
                    <p class="text-muted small">Silakan masuk untuk layanan pengaduan</p>
                </div>

                <!-- Notifikasi Error -->
                @if ($errors->has('login'))
                    <div class="alert alert-danger py-2 small" role="alert">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <!-- Form Login Warga -->
                <form action="{{ route('login.warga.process') }}" method="POST">
                    @csrf

                    <!-- Floating Input NIK / Username -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('login') is-invalid @enderror" id="floatingInput" name="login" value="{{ old('login') }}" placeholder="Masukkan NIK atau Username" required autofocus>
                        <label for="floatingInput" class="text-muted">NIK atau Username</label>
                    </div>

                    <!-- Floating Input Password -->
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                        <label for="floatingPassword" class="text-muted">Password</label>
                    </div>

                    <!-- Tombol Login -->
                    <button class="btn btn-primary btn-login w-100 mb-3" type="submit">
                        Masuk
                    </button>
                    
                    <!-- Area Informasi Warga -->
                    <div class="text-center pt-3 mt-2 border-top">
                        <p class="text-muted small mb-3">
                            <i class="bi bi-info-circle me-1"></i> Belum memiliki akun? Silakan hubungi Admin / RT.
                        </p>
                        
                        <div class="mt-1">
                            <a href="{{ url('/') }}" class="text-muted small text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap 5 JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>