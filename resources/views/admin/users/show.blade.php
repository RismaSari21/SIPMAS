@extends('layouts.app')
@section('title','Detail Pengguna')
@section('page_title','Detail Pengguna')
@section('content')<div class="content-card p-4"><h4>{{ $user->name }}</h4><p>{{ $user->email }}</p><p>Role: {{ ucfirst($user->role) }}</p><p>Total Pengaduan: {{ $user->complaints_count }}</p><a href="{{ route('admin.users.index') }}" class="btn btn-light border">Kembali</a></div>@endsection
