@extends('layouts.guest')
@section('title','Verifikasi Email - SIPMAS')
@section('content')
<h1 class="h4 fw-bold text-center mb-3">Verifikasi Email</h1><p class="text-muted">Silakan cek email Anda untuk link verifikasi.</p><form method="POST" action="{{ route('verification.send') }}">@csrf<button class="btn btn-coral w-100 mb-2">Kirim Ulang Email Verifikasi</button></form><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-light border w-100">Logout</button></form>
@endsection
