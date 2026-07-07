@extends('layouts.app')
@section('title','Edit Pengaduan')
@section('page_title','Edit Pengaduan')
@section('content')<div class="content-card p-4"><form method="POST" action="{{ route('masyarakat.complaints.update',$complaint) }}" enctype="multipart/form-data">@csrf @method('PUT') @include('masyarakat.complaints.form')<button class="btn btn-coral">Update Pengaduan</button><a href="{{ route('masyarakat.complaints.show',$complaint) }}" class="btn btn-light border">Batal</a></form></div>@endsection
