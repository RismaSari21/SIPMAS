@extends('layouts.guest')
@section('title','Lupa Password - SIPMAS')
@section('content')
<h1 class="h4 fw-bold text-center mb-3">Lupa Password</h1><p class="text-muted">Masukkan email Anda, sistem akan mengirim link reset password.</p><form method="POST" action="{{ route('password.email') }}">@csrf<div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus></div><button class="btn btn-coral w-100">Kirim Link Reset</button></form>
@endsection
