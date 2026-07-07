@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Admin')
@section('breadcrumb', 'Ringkasan statistik pengaduan masyarakat')

@section('content')
<div class="row g-3 mb-4">
    @foreach([
        ['Total Pengguna', $totalUsers, 'bi-people'], ['Total Pengaduan', $totalComplaints, 'bi-inbox'], ['Hari Ini', $todayComplaints, 'bi-calendar-day'], ['Menunggu', $waiting, 'bi-hourglass-split'], ['Diproses', $process, 'bi-gear'], ['Selesai', $done, 'bi-check2-circle'], ['Ditolak', $rejected, 'bi-x-circle']
    ] as [$label, $value, $icon])
        <div class="col-6 col-xl-3"><div class="stat-card p-3 h-100 d-flex gap-3 align-items-center"><span class="stat-icon"><i class="bi {{ $icon }}"></i></span><div><div class="h3 fw-bold mb-0">{{ $value }}</div><div class="text-muted small">{{ $label }}</div></div></div></div>
    @endforeach
</div>
<div class="row g-4 mb-4">
    <div class="col-lg-7"><div class="content-card p-4"><h5 class="fw-bold">Statistik Pengaduan per Bulan</h5><canvas id="monthlyChart" height="140"></canvas></div></div>
    <div class="col-lg-5"><div class="content-card p-4"><h5 class="fw-bold">Pengaduan per Kategori</h5><canvas id="categoryChart" height="190"></canvas></div></div>
    <div class="col-12"><div class="content-card p-4"><h5 class="fw-bold">Pengaduan per Provinsi</h5><canvas id="provinceChart" height="90"></canvas></div></div>
</div>
<div class="content-card p-4">
    <h5 class="fw-bold mb-3">Pengaduan Terbaru</h5>
    <div class="table-responsive"><table class="table table-hover"><thead><tr><th>Judul</th><th>Pelapor</th><th>Kategori</th><th>Status</th><th>Tanggal</th></tr></thead><tbody>
    @forelse($latestComplaints as $complaint)<tr><td><a href="{{ route('admin.complaints.show', $complaint) }}">{{ $complaint->title }}</a></td><td>{{ $complaint->user->name }}</td><td>{{ $complaint->category->category_name }}</td><td>@include('partials.status-badge', ['status' => $complaint->status])</td><td>{{ $complaint->complaint_date->format('d/m/Y') }}</td></tr>@empty<tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>@endforelse
    </tbody></table></div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const palette = window.chartPalette;
    new Chart(document.getElementById('monthlyChart'), {type:'line', data:{labels:@json($monthlyLabels), datasets:[{label:'Pengaduan', data:@json($monthlyData), borderColor:'#ff6f61', backgroundColor:'rgba(255,111,97,.14)', fill:true, tension:.35}]}, options:{plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}});
    new Chart(document.getElementById('categoryChart'), {type:'bar', data:{labels:@json($categoryLabels), datasets:[{label:'Pengaduan', data:@json($categoryData), backgroundColor:palette}]}, options:{plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}});
    new Chart(document.getElementById('provinceChart'), {type:'bar', data:{labels:@json($provinceLabels), datasets:[{label:'Pengaduan', data:@json($provinceData), backgroundColor:'#d8a7b1'}]}, options:{indexAxis:'y', plugins:{legend:{display:false}}, scales:{x:{beginAtZero:true}}}});
});
</script>
@endpush
