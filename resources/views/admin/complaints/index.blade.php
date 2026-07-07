@extends('layouts.app')
@section('title','Kelola Pengaduan')
@section('page_title','Kelola Pengaduan')
@section('breadcrumb','Verifikasi, proses, dan tanggapi pengaduan masyarakat')
@section('content')
<div class="content-card p-4 mb-3">
    <form class="row g-2">
        <div class="col-md-3"><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari pengaduan"></div>
        <div class="col-md-2"><select class="form-select" name="category_id"><option value="">Kategori</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>{{ $category->category_name }}</option>@endforeach</select></div>
        <div class="col-md-2"><select class="form-select" name="status"><option value="">Status</option>@foreach($statuses as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>@endforeach</select></div>
        <div class="col-md-2"><input class="form-control" type="date" name="date_from" value="{{ request('date_from') }}"></div>
        <div class="col-md-2"><input class="form-control" type="date" name="date_to" value="{{ request('date_to') }}"></div>
        <div class="col-md-1"><button class="btn btn-coral w-100">Filter</button></div>
    </form>
</div>
<div class="content-card p-4">
    <div class="table-responsive"><table class="table table-hover"><thead><tr><th>Judul</th><th>Pelapor</th><th>Kategori</th><th>Lokasi</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>
        @forelse($complaints as $complaint)
            <tr><td>{{ $complaint->title }}</td><td>{{ $complaint->user->name }}</td><td>{{ $complaint->category->category_name }}</td><td>{{ $complaint->regency_name }}, {{ $complaint->province_name }}</td><td>@include('partials.status-badge',['status'=>$complaint->status])</td><td>{{ $complaint->complaint_date->format('d/m/Y') }}</td><td class="d-flex gap-2"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.complaints.show',$complaint) }}">Detail</a><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.complaints.edit',$complaint) }}">Status</a><form method="POST" action="{{ route('admin.complaints.destroy',$complaint) }}">@csrf @method('DELETE')<button type="button" onclick="confirmDelete(this.form)" class="btn btn-sm btn-outline-danger">Hapus</button></form></td></tr>
        @empty<tr><td colspan="7" class="text-center text-muted">Belum ada pengaduan.</td></tr>@endforelse
    </tbody></table></div>{{ $complaints->links() }}
</div>
@endsection
