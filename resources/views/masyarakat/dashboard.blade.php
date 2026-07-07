@extends('layouts.app')

@section('title', 'Dashboard Masyarakat')
@section('page_title', 'Dashboard Masyarakat')
@section('breadcrumb', 'Ringkasan pengaduan saya')

@section('content')
<div class="row g-3 mb-4">
    @foreach([
        ['Total Pengaduan Saya', $total, 'bi-inbox'], ['Menunggu Verifikasi', $waiting, 'bi-hourglass-split'], ['Diproses', $process, 'bi-gear'], ['Selesai', $done, 'bi-check2-circle'], ['Ditolak', $rejected, 'bi-x-circle']
    ] as [$label, $value, $icon])
        <div class="col-6 col-xl"><div class="stat-card p-3 h-100"><span class="stat-icon mb-3"><i class="bi {{ $icon }}"></i></span><div class="h3 fw-bold">{{ $value }}</div><div class="text-muted small">{{ $label }}</div></div></div>
    @endforeach
</div>
<div class="d-flex justify-content-between align-items-center mb-3"><h5 class="fw-bold mb-0">Riwayat Pengaduan Terbaru</h5><a class="btn btn-coral" href="{{ route('masyarakat.complaints.create') }}"><i class="bi bi-plus-circle me-1"></i>Buat Pengaduan</a></div>
<div class="content-card p-4"><div class="table-responsive"><table class="table table-hover"><thead><tr><th>Judul</th><th>Kategori</th><th>Status</th><th>Tanggal</th><th></th></tr></thead><tbody>
@forelse($latestComplaints as $complaint)<tr><td>{{ $complaint->title }}</td><td>{{ $complaint->category->category_name }}</td><td>@include('partials.status-badge', ['status' => $complaint->status])</td><td>{{ $complaint->complaint_date->format('d/m/Y') }}</td><td><a class="btn btn-sm btn-outline-secondary" href="{{ route('masyarakat.complaints.show', $complaint) }}">Detail</a></td></tr>@empty<tr><td colspan="5" class="text-center text-muted">Belum ada pengaduan.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
