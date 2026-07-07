@extends('layouts.app')
@section('title','Kelola Pengguna')
@section('page_title','Kelola Pengguna')
@section('content')
<div class="d-flex justify-content-between mb-3"><h5 class="fw-bold">Data Pengguna</h5><a class="btn btn-coral" href="{{ route('admin.users.create') }}">Tambah Pengguna</a></div>
<div class="content-card p-4"><div class="table-responsive"><table class="table table-hover" data-datatable><thead><tr><th>Nama</th><th>Email</th><th>HP</th><th>Role</th><th>Aksi</th></tr></thead><tbody>@foreach($users as $user)<tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->phone ?? '-' }}</td><td><span class="badge text-bg-light border">{{ ucfirst($user->role) }}</span></td><td class="d-flex gap-2"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.users.edit',$user) }}">Edit</a><form method="POST" action="{{ route('admin.users.destroy',$user) }}">@csrf @method('DELETE')<button type="button" onclick="confirmDelete(this.form)" class="btn btn-sm btn-outline-danger">Hapus</button></form></td></tr>@endforeach</tbody></table></div>{{ $users->links() }}</div>
@endsection
