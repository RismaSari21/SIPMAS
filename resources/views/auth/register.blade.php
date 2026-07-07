@extends('layouts.guest')

@section('title', 'Registrasi - SIPMAS')

@section('content')
    <h1 class="h3 fw-bold text-center mb-1">Registrasi</h1>
    <p class="text-muted text-center mb-4">Daftar sebagai masyarakat untuk membuat pengaduan.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3"><label class="form-label" for="name">Nama</label><input id="name" class="form-control" name="name" value="{{ old('name') }}" required></div>
        <div class="mb-3"><label class="form-label" for="email">Email</label><input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required></div>
        <div class="mb-3"><label class="form-label" for="phone">Nomor HP</label><input id="phone" class="form-control" name="phone" value="{{ old('phone') }}"></div>
        <div class="mb-3"><label class="form-label" for="address">Alamat</label><textarea id="address" class="form-control" name="address" rows="2">{{ old('address') }}</textarea></div>
        <div class="mb-3"><label class="form-label" for="password">Password</label><input id="password" class="form-control" type="password" name="password" required></div>
        <div class="mb-4"><label class="form-label" for="password_confirmation">Konfirmasi Password</label><input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required></div>
        <button class="btn btn-coral w-100" type="submit">Daftar</button>
        <p class="text-center mt-3 mb-0">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </form>
@endsection
