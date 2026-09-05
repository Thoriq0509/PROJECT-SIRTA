<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Warga | SIRTA')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0d47a1; /* Warna biru persis seperti admin */
            --sidebar-hover: #1565c0;
            --sidebar-active: #1976d2;
            --body-bg: #f4f6f9;
        }

        body {
            background-color: var(--body-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* SIDEBAR STYLING */
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            background: var(--sidebar-bg);
            color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
        }

        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
            padding: 2px;
        }

        .menu-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 10px;
            margin-top: 15px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.85);
            padding: 11px 15px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 5px;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .sidebar-menu a:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }

        .sidebar-menu a.active {
            background: var(--sidebar-active);
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .sidebar-menu a i {
            font-size: 1.1rem;
        }

        /* MAIN CONTENT & TOPBAR */
        .main-content {
            margin-left: 260px;
            padding: 25px;
        }

        .topbar {
            background: #ffffff;
            padding: 12px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .user-profile-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            padding: 6px 12px;
            border-radius: 30px;
            border: 1px solid #eee;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: #e3f2fd;
            color: var(--sidebar-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* CARD STYLING */
        .dashboard-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
            margin-bottom: 20px;
            border: none;
        }

        .dashboard-card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .welcome-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .welcome-text {
            color: #7f8c8d;
            font-size: 0.95rem;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: 0.3s ease-in-out;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR WARGA -->
    <div class="sidebar" id="sidebar">
        <a href="{{ route('warga.pengaduan.index') }}" class="sidebar-brand">
            <img src="{{ asset('images/logo-sirta.jpg') }}" alt="Logo SIRTA" onerror="this.style.display='none'">
            <span>SIRTA Warga</span>
        </a>

        <div class="sidebar-menu flex-grow-1">
            <div class="menu-title">Menu Utama</div>
            
            <a href="{{ route('warga.pengaduan.index') }}" class="{{ request()->routeIs('warga.pengaduan*') ? 'active' : '' }}">
                <i class="bi bi-chat-left-text-fill"></i>
                <span>Pengaduan Warga</span>
            </a>

            <div class="menu-title">Pengaturan</div>
            
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </div>

        <!-- Hidden Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- TOPBAR -->
        <div class="topbar">
            <div class="fw-bold text-secondary" style="font-size: 1.05rem;">Panel Masyarakat</div>
            <div class="user-profile-badge">
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="d-flex flex-column text-end" style="line-height: 1.2;">
                    <span class="fw-bold" style="font-size: 0.9rem; color: #333;">{{ auth()->user()->name ?? 'Warga' }}</span>
                    <span class="text-muted" style="font-size: 0.75rem;">Masyarakat</span>
                </div>
            </div>
        </div>

        <!-- CONTENT SECTION -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>