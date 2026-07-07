@extends('layouts.guest')
@section('title','Konfirmasi Password - SIPMAS')
@section('content')
<h1 class="h4 fw-bold text-center mb-3">Konfirmasi Password</h1><form method="POST" action="{{ route('password.confirm') }}">@csrf<div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div><button class="btn btn-coral w-100">Konfirmasi</button></form>
@endsection
