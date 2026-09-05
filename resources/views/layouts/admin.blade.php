<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIRTA')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    <!-- SIDEBAR UTAMA (Terpusat di Layout) -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-sirta.jpg') }}" alt="Logo SIRTA" class="sidebar-logo">
            <span>SIRTA</span>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.pengumuman.index') }}" class="{{ request()->routeIs('admin.pengumuman*') ? 'active' : '' }}">
                <i class="bi bi-megaphone-fill"></i>
                <span>Pengumuman</span>
            </a>

            <a href="{{ route('admin.kegiatan.index') }}" class="{{ request()->routeIs('admin.kegiatan*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event-fill"></i>
                <span>Jadwal Kegiatan</span>
            </a>

            <a href="{{ route('admin.pengurus.index') }}" class="{{ request()->routeIs('admin.pengurus*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Pengurus</span>
            </a>

            <a href="{{ route('admin.warga.index') }}" class="{{ request()->routeIs('admin.warga*') ? 'active' : '' }}">
                <i class="bi bi-person-lines-fill"></i>
                <span>Kelola Warga</span>
            </a>

            <a href="{{ route('admin.dokumentasi.index') }}" class="{{ request()->routeIs('admin.dokumentasi*') ? 'active' : '' }}">
                <i class="bi bi-images"></i>
                <span>Dokumentasi</span>
            </a>

            <a href="{{ route('admin.pengaduan.index') }}" class="{{ request()->routeIs('admin.pengaduan*') ? 'active' : '' }}">
                <i class="bi bi-chat-left-text-fill"></i>
                <span>Pengaduan Warga</span>
            </a>

            <div class="menu-title mt-4">Pengaturan</div>

            <a href="{{ route('admin.profile.index') }}" class="{{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i>
                <span>Profil Admin</span>
            </a>
        </div>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- OVERLAY MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="main-content">

        <!-- TOPBAR UTAMA -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-2">
                <button class="mobile-menu" id="mobileMenu">
                    <i class="bi bi-list"></i>
                </button>
                <div class="topbar-title">Panel Admin</div>
            </div>

            <div class="admin-profile">
                <div class="admin-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <div class="admin-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="admin-role">{{ ucfirst(auth()->user()->role ?? 'admin') }}</div>
                </div>
            </div>
        </div>

        <!-- ISI KONTEN DINAMIS -->
        <div class="content">
            @yield('content')
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SIDEBAR MOBILE SCRIPT -->
    <script>
        const mobileMenu = document.getElementById("mobileMenu");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");

        if (mobileMenu && sidebar && overlay) {
            mobileMenu.addEventListener("click", function () {
                sidebar.classList.toggle("show");
                overlay.classList.toggle("show");
            });

            overlay.addEventListener("click", function () {
                sidebar.classList.remove("show");
                overlay.classList.remove("show");
            });
        }
    </script>

</body>

</html>