<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name','SIPMAS'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css','resources/js/app.js'])

    @stack('styles')
</head>
<body>

<div class="app-shell">

    {{-- =========================
        SIDEBAR DESKTOP
    ==========================--}}
    <aside class="sidebar p-3 d-none d-lg-block">

        <div class="d-flex align-items-center gap-2 mb-4 px-2">
            <div class="stat-icon bg-white text-coral">
                <i class="bi bi-megaphone-fill"></i>
            </div>

            <div>
                <div class="fw-bold fs-5">SIPMAS</div>
                <small class="text-white-50">Sistem Pengaduan Masyarakat</small>
            </div>
        </div>

        <nav class="nav flex-column">

            @if(auth()->user()->isAdmin())

                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>

                <a class="nav-link {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}"
                    href="{{ route('admin.complaints.index') }}">
                    <i class="bi bi-inbox me-2"></i>
                    Kelola Pengaduan
                </a>

                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                    href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags me-2"></i>
                    Kelola Kategori
                </a>

                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people me-2"></i>
                    Kelola Pengguna
                </a>

                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                    href="{{ route('admin.reports.index') }}">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Laporan
                </a>

            @else

                <a class="nav-link {{ request()->routeIs('masyarakat.dashboard') ? 'active' : '' }}"
                    href="{{ route('masyarakat.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>

                <a class="nav-link {{ request()->routeIs('masyarakat.complaints.create') ? 'active' : '' }}"
                    href="{{ route('masyarakat.complaints.create') }}">
                    <i class="bi bi-plus-circle me-2"></i>
                    Buat Pengaduan
                </a>

                <a class="nav-link {{ request()->routeIs('masyarakat.complaints.*') ? 'active' : '' }}"
                    href="{{ route('masyarakat.complaints.index') }}">
                    <i class="bi bi-clock-history me-2"></i>
                    Pengaduan Saya
                </a>

            @endif

            <hr class="border-white border-opacity-25">

            <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                href="{{ route('profile.edit') }}">
                <i class="bi bi-person me-2"></i>
                Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>

        </nav>

    </aside>


    {{-- =========================
        SIDEBAR MOBILE
    ==========================--}}

    <div class="offcanvas offcanvas-start sidebar text-white"
         tabindex="-1"
         id="mobileSidebar">

        <div class="offcanvas-header border-bottom border-secondary">

            <h5 class="offcanvas-title fw-bold">
                SIPMAS
            </h5>
            <small class="text-white-50">Sistem Pengaduan Masyarakat</small>

            <button
                type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas">
            </button>

        </div>

        <div class="offcanvas-body">

            <nav class="nav flex-column">

                @if(auth()->user()->isAdmin())

                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>

                    <a class="nav-link {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}"
                        href="{{ route('admin.complaints.index') }}">
                        <i class="bi bi-inbox me-2"></i>
                        Kelola Pengaduan
                    </a>

                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                        href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-tags me-2"></i>
                        Kelola Kategori
                    </a>

                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people me-2"></i>
                        Kelola Pengguna
                    </a>

                    <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                        href="{{ route('admin.reports.index') }}">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Laporan
                    </a>

                @else

                    <a class="nav-link {{ request()->routeIs('masyarakat.dashboard') ? 'active' : '' }}"
                        href="{{ route('masyarakat.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>

                    <a class="nav-link {{ request()->routeIs('masyarakat.complaints.create') ? 'active' : '' }}"
                        href="{{ route('masyarakat.complaints.create') }}">
                        <i class="bi bi-plus-circle me-2"></i>
                        Buat Pengaduan
                    </a>

                    <a class="nav-link {{ request()->routeIs('masyarakat.complaints.*') ? 'active' : '' }}"
                        href="{{ route('masyarakat.complaints.index') }}">
                        <i class="bi bi-clock-history me-2"></i>
                        Pengaduan Saya
                    </a>

                @endif

                <hr class="border-white border-opacity-25">

                <a class="nav-link"
                    href="{{ route('profile.edit') }}">
                    <i class="bi bi-person me-2"></i>
                    Profil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>

            </nav>

        </div>

    </div>


    {{-- =========================
        MAIN CONTENT
    ==========================--}}
    <div class="main-content">

        <header class="topbar sticky-top px-4 py-3 d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">

                {{-- Tombol Menu Mobile --}}
                <button
                    class="btn btn-outline-secondary d-lg-none me-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileSidebar">

                    <i class="bi bi-list fs-4"></i>

                </button>

                <div>
                    <h1 class="h4 fw-bold mb-0">
                        @yield('page_title','Dashboard')
                    </h1>

                    <small class="text-muted">
                        @yield('breadcrumb')
                    </small>
                </div>

            </div>

            {{-- Profil --}}
            <div class="text-center">

                <a href="{{ route('profile.edit') }}" class="text-decoration-none">

                    @if(auth()->user()->photo)

                        <img
                            src="{{ Storage::url(auth()->user()->photo) }}"
                            class="rounded-circle shadow border"
                            width="80"
                            height="80"
                            style="object-fit:cover;">

                    @else

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=7C4D5C&color=fff&size=200"
                            class="rounded-circle shadow border"
                            width="80"
                            height="80">

                    @endif

                </a>

                <div class="fw-bold fs-5 mt-2">
                    {{ auth()->user()->name }}
                </div>

                <div class="text-muted">
                    {{ ucfirst(auth()->user()->role) }}
                </div>

            </div>

        </header>

        <main class="p-4">

            @include('partials.alerts')

            @yield('content')

        </main>

        <footer class="px-4 pb-4 text-muted small">
            © {{ date('Y') }} SIPMAS. By Risma Kumala Sari Powered by Laravel 12, Bootstrap 5, and Leaflet.
        </footer>

    </div>

</div>

@stack('scripts')

</body>
</html>