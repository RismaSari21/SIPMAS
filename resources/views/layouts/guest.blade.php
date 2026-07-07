<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'SIPMAS'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream">
    <main class="min-vh-100 d-flex align-items-center justify-content-center p-3">
        <div class="content-card p-4 p-md-5" style="max-width: 480px; width: 100%;">
            <a href="{{ route('landing') }}" class="text-decoration-none d-flex align-items-center justify-content-center gap-2 mb-4">
                <span class="stat-icon"><i class="bi bi-megaphone-fill"></i></span>
                <span class="h4 fw-bold text-dark">SIPMAS</span>
                
            </a>
            @include('partials.alerts')
            @yield('content')
            {{ $slot ?? '' }}
        </div>
    </main>
</body>
</html>
