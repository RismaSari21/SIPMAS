@extends('layouts.app')
@section('title','Ubah Status Pengaduan')
@section('page_title','Ubah Status Pengaduan')
@section('content')
<div class="content-card p-4"><h4 class="fw-bold">{{ $complaint->title }}</h4><p class="text-muted">{{ $complaint->user->name }} • {{ $complaint->category->category_name }}</p><form method="POST" action="{{ route('admin.complaints.update',$complaint) }}">@csrf @method('PUT')<div class="mb-3"><label class="form-label">Status</label><select class="form-select" name="status">@foreach($statuses as $status)<option value="{{ $status }}" @selected($complaint->status===$status)>{{ $status }}</option>@endforeach</select></div><div class="mb-3"><label class="form-label">Tanggapan Admin</label><textarea class="form-control" name="response" rows="5" placeholder="Tambahkan catatan/tanggapan untuk masyarakat"></textarea></div><button class="btn btn-coral">Simpan</button><a class="btn btn-light border" href="{{ route('admin.complaints.show',$complaint) }}">Batal</a></form></div>
@endsection
