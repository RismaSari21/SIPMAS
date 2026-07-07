<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPMAS - Sistem Pengaduan Masyarakat</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">

    <div class="container py-2">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-coral" href="#">
            <i class="bi bi-megaphone-fill me-2"></i>
            SIPMAS
        </a>


        <!-- Tombol Mobile -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu"
                aria-controls="mobileMenu">

            <span class="navbar-toggler-icon"></span>

        </button>



        <!-- Menu Desktop -->
        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ms-auto me-3">

                <li class="nav-item">
                    <a class="nav-link" href="#tentang">
                        Tentang
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#cara">
                        Cara Menggunakan
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#kategori">
                        Kategori
                    </a>
                </li>

            </ul>



            <div class="d-flex gap-2">

                <a class="btn btn-outline-secondary"
                   href="{{ route('login') }}">
                    Login
                </a>


                <a class="btn btn-coral"
                   href="{{ route('register') }}">
                    Registrasi
                </a>

            </div>


        </div>

    </div>

</nav>




<!-- MENU MOBILE DARI KIRI -->
<div class="offcanvas offcanvas-start"
     tabindex="-1"
     id="mobileMenu"
     aria-labelledby="mobileMenuLabel">


    <div class="offcanvas-header">


        <h5 class="offcanvas-title fw-bold text-coral"
            id="mobileMenuLabel">

            <i class="bi bi-megaphone-fill me-2"></i>
            SIPMAS

        </h5>



        <button type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas">

        </button>


    </div>



    <div class="offcanvas-body">


        <ul class="navbar-nav">


            <li class="nav-item mb-3">

                <a class="nav-link"
                   href="#tentang">

                    <i class="bi bi-info-circle me-2"></i>
                    Tentang

                </a>

            </li>



            <li class="nav-item mb-3">

                <a class="nav-link"
                   href="#cara">

                    <i class="bi bi-question-circle me-2"></i>
                    Cara Menggunakan

                </a>

            </li>


            <li class="nav-item mb-3">

                <a class="nav-link"
                   href="#kategori">

                    <i class="bi bi-grid me-2"></i>
                    Kategori

                </a>

            </li>


        </ul>



        <hr>



        <div class="d-grid gap-2">


            <a class="btn btn-outline-secondary"
               href="{{ route('login') }}">

                Login

            </a>



            <a class="btn btn-coral"
               href="{{ route('register') }}">

                Registrasi

            </a>


        </div>



    </div>


</div>

<section id="tentang" class="py-5 bg-white"><div class="container"><div class="row g-4 align-items-center"><div class="col-lg-5"><h2 class="fw-bold">Tentang Sistem</h2><p class="text-muted">Aplikasi SaaS untuk mengelola pelaporan fasilitas umum dan pelayanan publik, dilengkapi verifikasi status, peta lokasi, dan laporan admin.</p></div><div class="col-lg-7"><div class="row g-3"><div class="col-md-4"><div class="stat-card p-4 h-100"><i class="bi bi-shield-check fs-2 text-coral"></i><h5 class="mt-3">Terverifikasi</h5><p class="text-muted mb-0">Setiap laporan diproses admin.</p></div></div><div class="col-md-4"><div class="stat-card p-4 h-100"><i class="bi bi-geo-alt fs-2 text-coral"></i><h5 class="mt-3">Berbasis Lokasi</h5><p class="text-muted mb-0">Pilih titik lokasi via peta.</p></div></div><div class="col-md-4"><div class="stat-card p-4 h-100"><i class="bi bi-bar-chart fs-2 text-coral"></i><h5 class="mt-3">Terukur</h5><p class="text-muted mb-0">Dashboard dan laporan statistik.</p></div></div></div></div></div></div></section>

<section id="cara" class="py-5"><div class="container"><h2 class="fw-bold text-center mb-4">Cara Menggunakan Sistem</h2><div class="row g-4"><div class="col-md-4"><div class="content-card p-4 h-100"><span class="stat-icon mb-3">1</span><h5>Registrasi</h5><p class="text-muted">Buat akun masyarakat dengan email aktif.</p></div></div><div class="col-md-4"><div class="content-card p-4 h-100"><span class="stat-icon mb-3">2</span><h5>Kirim Pengaduan</h5><p class="text-muted">Lengkapi kategori, wilayah, peta, foto, dan deskripsi.</p></div></div><div class="col-md-4"><div class="content-card p-4 h-100"><span class="stat-icon mb-3">3</span><h5>Pantau Status</h5><p class="text-muted">Lihat perubahan status dan tanggapan admin.</p></div></div></div></div></section>

<section id="kategori" class="py-5 bg-white"><div class="container"><h2 class="fw-bold text-center mb-4">Kategori Pengaduan</h2><div class="row g-3">@forelse($categories as $category)<div class="col-md-4"><div class="stat-card p-3 h-100"><h5>{{ $category->category_name }}</h5><p class="text-muted mb-0">{{ $category->description }}</p></div></div>@empty<div class="col-12 text-center text-muted">Kategori akan tampil setelah database diisi.</div>@endforelse</div></div></section>

<footer class="py-4 bg-dark text-white">
    <div class="container d-flex flex-wrap justify-content-between gap-2">
        <span>© {{ date('Y') }} SIPMAS</span><span class="text-white-50">By Risma Kumala Sari. Powered by Laravel 12, Bootstrap 5, and Leaflet.</span>
    </div>
    </footer>
</body>
</html>
