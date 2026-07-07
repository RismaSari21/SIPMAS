@extends('layouts.guest')

@section('title', 'Login - SIPMAS')

@section('content')
    <h1 class="h3 fw-bold text-center mb-1">Masuk</h1>
    <p class="text-muted text-center mb-4">Gunakan akun SIPMAS Anda.</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input id="remember" class="form-check-input" type="checkbox" name="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <a href="{{ route('password.request') }}" class="small">Lupa password?</a>
        </div>
        <button class="btn btn-coral w-100" type="submit">Login</button>
        <p class="text-center mt-3 mb-0">Belum punya akun? <a href="{{ route('register') }}">Registrasi</a></p>
    </form>
@endsection
