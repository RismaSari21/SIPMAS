@extends('layouts.app')

@section('title', 'Profil')
@section('page_title', 'Profil Saya')
@section('breadcrumb', 'Kelola profil dan ubah password')

@section('content')
<div class="row g-4">
    <div class="col-lg-7">
        <div class="content-card p-4">
            <h5 class="fw-bold mb-3">Informasi Profil</h5>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name" value="{{ old('name', $user->name) }}" required></div>
                <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
                <div class="mb-3"><label class="form-label">Nomor HP</label><input class="form-control" name="phone" value="{{ old('phone', $user->phone) }}"></div>
                <div class="mb-3"><label class="form-label">Alamat</label><textarea class="form-control" name="address" rows="3">{{ old('address', $user->address) }}</textarea></div>
                <div class="mb-3"><label class="form-label">Foto Profil</label><input class="form-control" type="file" name="photo" accept="image/*"></div>
                <button class="btn btn-coral">Simpan Profil</button>
            </form>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="content-card p-4 mb-4">
            <h5 class="fw-bold mb-3">Ubah Password</h5>
            @include('profile.partials.update-password-form')
        </div>
        <div class="content-card p-4">
            <h5 class="fw-bold mb-3 text-danger">Hapus Akun</h5>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
