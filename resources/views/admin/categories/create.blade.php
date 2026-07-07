@extends('layouts.app')
@section('title','Tambah Kategori')
@section('page_title','Tambah Kategori')
@section('content')
<div class="content-card p-4"><form method="POST" action="{{ route('admin.categories.store') }}">@csrf @include('admin.categories.form')<button class="btn btn-coral">Simpan</button><a href="{{ route('admin.categories.index') }}" class="btn btn-light border">Batal</a></form></div>
@endsection
