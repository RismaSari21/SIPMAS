@extends('layouts.app')
@section('title','Buat Pengaduan')
@section('page_title','Buat Pengaduan')
@section('breadcrumb','Lengkapi data pengaduan dan titik lokasi')
@section('content')<div class="content-card p-4"><form method="POST" action="{{ route('masyarakat.complaints.store') }}" enctype="multipart/form-data">@csrf @include('masyarakat.complaints.form')<button class="btn btn-coral">Kirim Pengaduan</button><a href="{{ route('masyarakat.complaints.index') }}" class="btn btn-light border">Batal</a></form></div>@endsection
