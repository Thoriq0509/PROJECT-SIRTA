<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRTA | RT Kampung Tarate</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Public -->
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- ========================================== -->
    <!-- NAVBAR -->
    <!-- ========================================== -->
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#beranda">
                <img src="{{ asset('images/logo-sirta.jpg') }}" alt="Logo SIRTA" style="width: 40px;">
                <span class="fw-bold fs-5 text-dark">
                    SIRTA
                    <span class="text-primary fs-6">RT Kampung Tarate</span>
                </span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pengumuman">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kegiatan">Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pengurus">Pengurus</a></li>
                    <li class="nav-item"><a class="nav-link" href="#dokumentasi">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pengaduan">Pengaduan</a></li>
                    <li class="nav-item ms-lg-2">
                        <!-- Route Login Admin -->
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-person-badge"></i> Login Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- ========================================== -->
    <!-- HERO -->
    <!-- ========================================== -->
    <section id="beranda" class="hero-section text-center text-lg-start mt-5 pt-5">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-semibold">
                        Sistem Informasi RT Kampung Tarate
                    </span>
                    <h1 class="display-5 fw-bold mb-3">Selamat Datang di Portal Warga SIRTA</h1>
                    <p class="lead text-white mb-4">
                        Pusat informasi kegiatan lingkungan, transparansi data pengurus, galeri dokumentasi,
                        dan layanan pengaduan warga Kampung Tarate yang cepat dan transparan.
                    </p>
                    <a href="#pengaduan" class="btn btn-primary fw-semibold btn-lg rounded-pill px-4 shadow-sm">
                        <i class="bi bi-chat-left-text-fill me-2"></i> Buat Pengaduan
                    </a>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    <div class="p-4 bg-white rounded-4 shadow-lg d-inline-block">
                        <img src="{{ asset('images/logo-sirta.jpg') }}" alt="Logo SIRTA Banner" class="img-fluid" style="max-height: 220px;">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================== -->
    <!-- KONTEN -->
    <!-- ========================================== -->
    <div class="container my-5">

        <!-- ========================================== -->
        <!-- PENGUMUMAN -->
        <!-- ========================================== -->
        <section id="pengumuman" class="mb-5 pt-4">
            <h3 class="section-title fw-bold mb-4">Pengumuman & Informasi</h3>
            
            @php
                // Filter: Hanya menampilkan pengumuman yang statusnya 'publish'
                $activePengumuman = collect($pengumuman)->filter(function($item) {
                    return isset($item->status) && strtolower($item->status) === 'publish';
                })->values();
            @endphp

            <div class="row g-4">
                @forelse($activePengumuman->take(4) as $item)
                    <div class="col-md-6">
                        <div class="card card-custom h-100 border-0 shadow-sm overflow-hidden">
                            
                            {{-- THUMBNAIL GAMBAR / VIDEO DI BAGIAN ATAS CARD (OPSIONAL) --}}
                            @if($item->gambar)
                                @php $extension = strtolower(pathinfo($item->gambar, PATHINFO_EXTENSION)); @endphp
                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                                @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))
                                    <video class="w-100" style="height: 200px; object-fit: cover;" controls>
                                        <source src="{{ asset('storage/' . $item->gambar) }}">
                                    </video>
                                @endif
                            @endif

                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold">Informasi</span>
                                    <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</small>
                                </div>
                                <h5 class="fw-bold mb-2 text-dark">{{ $item->judul }}</h5>
                                @if(isset($item->isi))
                                    <p class="text-secondary small mb-0">{{ $item->isi }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><div class="card p-4 text-center"><p class="text-muted mb-0">Belum ada pengumuman publish saat ini.</p></div></div>
                @endforelse
            </div>

            @if($activePengumuman->count() > 4)
                <div class="collapse" id="collapsePengumuman">
                    <div class="row g-4 mt-1">
                        @foreach($activePengumuman->skip(4) as $item)
                            <div class="col-md-6">
                                <div class="card card-custom h-100 border-0 shadow-sm overflow-hidden">
                                    
                                    @if($item->gambar)
                                        @php $extension = strtolower(pathinfo($item->gambar, PATHINFO_EXTENSION)); @endphp
                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                                        @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))
                                            <video class="w-100" style="height: 200px; object-fit: cover;" controls>
                                                <source src="{{ asset('storage/' . $item->gambar) }}">
                                            </video>
                                        @endif
                                    @endif

                                    <div class="card-body p-4 d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold">Informasi</span>
                                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</small>
                                        </div>
                                        <h5 class="fw-bold mb-2 text-dark">{{ $item->judul }}</h5>
                                        @if(isset($item->isi))
                                            <p class="text-secondary small mb-0">{{ $item->isi }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary rounded-pill px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengumuman" aria-expanded="false" aria-controls="collapsePengumuman">
                        Lihat Selengkapnya <i class="bi bi-chevron-down"></i>
                    </button>
                </div>
            @endif
        </section>


        <!-- ========================================== -->
        <!-- KEGIATAN -->
        <!-- ========================================== -->
        <section id="kegiatan" class="mb-5 pt-4">
            <h3 class="section-title fw-bold mb-4">Jadwal Kegiatan Warga</h3>

            @php
                // Filter: Hanya menampilkan kegiatan yang status finalnya BUKAN 'Selesai' 
                // (Mendukung otomatis maupun override paksa oleh admin)
                $activeKegiatan = collect($kegiatan)->filter(function($item) {
                    return isset($item->status_final) && strtolower($item->status_final) !== 'selesai';
                })->values();
            @endphp

            <div class="card card-custom p-4 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Agenda Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Waktu Pelaksanaan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @forelse($activeKegiatan->take(3) as $item)
                                <tr>
                                    <td class="fw-bold text-primary">{{ $item->nama_kegiatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                    <td>{{ $item->waktu_pelaksanaan }} {{ $item->jam_selesai ? '- ' . $item->jam_selesai : '' }} WIB</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>
                                        @php $status = $item->status_final; @endphp
                                        @if($status == 'Berlangsung')
                                            <span class="badge bg-success">Berlangsung</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Mendatang</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted py-3">Belum ada jadwal kegiatan aktif saat ini.</td></tr>
                            @endforelse
                        </tbody>

                        @if($activeKegiatan->count() > 3)
                            <tbody class="collapse" id="collapseKegiatan">
                                @foreach($activeKegiatan->skip(3) as $item)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $item->nama_kegiatan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                        <td>{{ $item->waktu_pelaksanaan }} {{ $item->jam_selesai ? '- ' . $item->jam_selesai : '' }} WIB</td>
                                        <td>{{ $item->lokasi }}</td>
                                        <td>
                                            @php $status = $item->status_final; @endphp
                                            @if($status == 'Berlangsung')
                                                <span class="badge bg-success">Berlangsung</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Mendatang</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>

                @if($activeKegiatan->count() > 3)
                    <div class="text-center mt-3">
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKegiatan">
                            Lihat Selengkapnya <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                @endif
            </div>
        </section>


        <!-- ========================================== -->
        <!-- PENGURUS -->
        <!-- ========================================== -->
        <section id="pengurus" class="mb-5 pt-4">
            <h3 class="section-title fw-bold mb-4">Struktur Pengurus RT/RW</h3>

            @if(collect($pengurus)->isEmpty())
                <div class="card p-4 text-center shadow-sm"><p class="text-muted mb-0">Belum ada data pengurus.</p></div>
            @else
                <div id="carouselPengurus" class="carousel slide pb-5" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $pengurusChunks = collect($pengurus)->chunk(3);
                        @endphp

                        @foreach($pengurusChunks as $index => $chunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row row-cols-1 row-cols-md-3 g-4 px-2">
                                    @foreach($chunk as $item)
                                        <div class="col">
                                            <div class="card card-custom text-center p-4 h-100 shadow-sm border-0">
                                                @if($item->foto)
                                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                                         class="rounded-circle mx-auto mb-3 shadow-sm border border-2 border-primary border-opacity-25" 
                                                         alt="{{ $item->nama_pengurus }}" style="width: 100px; height: 100px; object-fit: cover;">
                                                @else
                                                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light text-primary shadow-sm border border-2 border-primary border-opacity-25" 
                                                         style="width: 100px; height: 100px;">
                                                        <i class="bi bi-person-fill fs-1"></i>
                                                    </div>
                                                @endif

                                                <span class="badge bg-primary bg-opacity-10 text-primary mb-2 mx-auto fw-semibold">
                                                    {{ strtoupper($item->jabatan) }}
                                                </span>
                                                <h5 class="fw-bold mb-1">{{ $item->nama_pengurus }}</h5>

                                                @if($item->no_telepon)
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_telepon) }}" target="_blank" class="btn btn-outline-success btn-sm rounded-pill mt-auto">
                                                        <i class="bi bi-whatsapp"></i> Hubungi
                                                    </a>
                                                @else
                                                    <span class="text-muted small mt-auto"><i class="bi bi-telephone-x"></i> Kontak tidak tersedia</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($pengurusChunks->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPengurus" data-bs-slide="prev" style="width: 5%;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPengurus" data-bs-slide="next" style="width: 5%;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @endif
        </section>


        <!-- ========================================== -->
        <!-- DOKUMENTASI -->
        <!-- ========================================== -->
        <section id="dokumentasi" class="mb-5 pt-4">
            <h3 class="section-title fw-bold mb-4">Galeri Dokumentasi Kegiatan</h3>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse(collect($dokumentasi)->take(3) as $item)
                    <div class="col">
                        <div class="card card-custom overflow-hidden h-100 shadow-sm">
                            @if($item->file)
                                @php $extension = strtolower(pathinfo($item->file, PATHINFO_EXTENSION)); @endphp
                                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                    <img src="{{ asset('storage/' . $item->file) }}" class="card-img-top dokumentasi-img" alt="{{ $item->judul_dokumentasi }}" style="height: 200px; object-fit: cover;">
                                @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))
                                    <video class="dokumentasi-video w-100" style="height: 200px; object-fit: cover;" controls>
                                        <source src="{{ asset('storage/' . $item->file) }}">
                                    </video>
                                @endif
                            @endif

                            <div class="card-body">
                                <h6 class="fw-bold mb-1 text-primary">{{ $item->judul_dokumentasi }}</h6>
                                <p class="text-muted small mb-2"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</p>
                                @if($item->deskripsi) <p class="text-secondary small">{{ $item->deskripsi }}</p> @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><div class="card p-4 text-center"><p class="text-muted mb-0">Belum ada dokumentasi.</p></div></div>
                @endforelse
            </div>

            @if(collect($dokumentasi)->count() > 3)
                <div class="collapse" id="collapseDokumentasi">
                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
                        @foreach(collect($dokumentasi)->skip(3) as $item)
                             <div class="col">
                                <div class="card card-custom overflow-hidden h-100 shadow-sm">
                                    @if($item->file)
                                        @php $extension = strtolower(pathinfo($item->file, PATHINFO_EXTENSION)); @endphp
                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                            <img src="{{ asset('storage/' . $item->file) }}" class="card-img-top dokumentasi-img" alt="{{ $item->judul_dokumentasi }}" style="height: 200px; object-fit: cover;">
                                        @elseif(in_array($extension, ['mp4', 'mov', 'avi', 'mkv']))
                                            <video class="dokumentasi-video w-100" style="height: 200px; object-fit: cover;" controls>
                                                <source src="{{ asset('storage/' . $item->file) }}">
                                            </video>
                                        @endif
                                    @endif
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-1 text-primary">{{ $item->judul_dokumentasi }}</h6>
                                        <p class="text-muted small mb-2"><i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary rounded-pill px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDokumentasi">
                        Lihat Selengkapnya <i class="bi bi-chevron-down"></i>
                    </button>
                </div>
            @endif
        </section>


        <!-- ========================================== -->
        <!-- PENGADUAN -->
        <!-- ========================================== -->
        <section id="pengaduan" class="pt-4 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-custom p-5 text-center shadow">
                        <div class="mb-4">
                            <i class="bi bi-shield-lock text-primary" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Layanan Pengaduan Warga</h3>
                        <p class="text-muted mb-4 px-md-5">
                            Punya keluhan, saran, atau laporan fasilitas umum yang rusak di Kampung Tarate? 
                            Untuk mengirim pengaduan dan mencegah pesan spam, <strong>diperlukan Login Akun Warga</strong>.
                        </p>
                        
                        <div>
                            <!-- Route Login Warga -->
                            <a href="{{ route('login.warga') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-2 shadow-sm">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login Warga untuk Pengaduan
                            </a>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <p class="text-muted small mb-0">
                                Belum memiliki akun warga? 
                                <a href="{{ route('login.warga') }}" class="fw-bold text-decoration-none">Daftar di sini</a>. 
                                Akun Anda akan ditinjau dan disetujui oleh Admin.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>


    <!-- ========================================== -->
    <!-- FOOTER -->
    <!-- ========================================== -->
    <footer class="text-center bg-dark text-white py-4 mt-auto">
        <div class="container">
            <p class="mb-1 fw-bold">Sistem Informasi RT Kampung Tarate (SIRTA)</p>
            <p class="small text-white-50 mb-0">&copy; {{ date('Y') }} RT Kampung Tarate. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>