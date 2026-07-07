@extends('layouts.guest')
@section('title','Reset Password - SIPMAS')
@section('content')
<h1 class="h4 fw-bold text-center mb-3">Reset Password</h1><form method="POST" action="{{ route('password.store') }}">@csrf<input type="hidden" name="token" value="{{ $request->route('token') }}"><div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}" required></div><div class="mb-3"><label class="form-label">Password Baru</label><input class="form-control" type="password" name="password" required></div><div class="mb-3"><label class="form-label">Konfirmasi Password</label><input class="form-control" type="password" name="password_confirmation" required></div><button class="btn btn-coral w-100">Reset Password</button></form>
@endsection
