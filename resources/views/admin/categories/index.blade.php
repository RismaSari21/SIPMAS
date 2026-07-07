@extends('layouts.app')
@section('title','Kelola Kategori')
@section('page_title','Kelola Kategori')
@section('breadcrumb','CRUD kategori pengaduan')
@section('content')
<div class="d-flex justify-content-between mb-3"><h5 class="fw-bold">Data Kategori</h5><a class="btn btn-coral" href="{{ route('admin.categories.create') }}">Tambah Kategori</a></div>
<div class="content-card p-4"><div class="table-responsive"><table class="table table-hover" data-datatable><thead><tr><th>Nama</th><th>Deskripsi</th><th>Pengaduan</th><th>Aksi</th></tr></thead><tbody>@foreach($categories as $category)<tr><td>{{ $category->category_name }}</td><td>{{ $category->description }}</td><td>{{ $category->complaints_count }}</td><td class="d-flex gap-2"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.categories.edit',$category) }}">Edit</a><form method="POST" action="{{ route('admin.categories.destroy',$category) }}">@csrf @method('DELETE')<button type="button" onclick="confirmDelete(this.form)" class="btn btn-sm btn-outline-danger">Hapus</button></form></td></tr>@endforeach</tbody></table></div>{{ $categories->links() }}</div>
@endsection
