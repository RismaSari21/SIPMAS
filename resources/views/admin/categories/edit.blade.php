@extends('layouts.app')
@section('title','Edit Kategori')
@section('page_title','Edit Kategori')
@section('content')
<div class="content-card p-4"><form method="POST" action="{{ route('admin.categories.update',$category) }}">@csrf @method('PUT') @include('admin.categories.form')<button class="btn btn-coral">Update</button><a href="{{ route('admin.categories.index') }}" class="btn btn-light border">Batal</a></form></div>
@endsection
