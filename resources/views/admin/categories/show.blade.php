@extends('layouts.app')
@section('title','Detail Kategori')
@section('page_title','Detail Kategori')
@section('content')
<div class="content-card p-4"><h4>{{ $category->category_name }}</h4><p class="text-muted">{{ $category->description }}</p><p>Total pengaduan: <strong>{{ $category->complaints_count }}</strong></p><a href="{{ route('admin.categories.index') }}" class="btn btn-light border">Kembali</a></div>
@endsection
