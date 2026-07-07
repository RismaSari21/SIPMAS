@extends('layouts.app')
@section('title','Tambah Pengguna')
@section('page_title','Tambah Pengguna')
@section('content')<div class="content-card p-4"><form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">@csrf @include('admin.users.form')<button class="btn btn-coral">Simpan</button><a href="{{ route('admin.users.index') }}" class="btn btn-light border">Batal</a></form></div>@endsection
