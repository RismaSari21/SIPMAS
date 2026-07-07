@extends('layouts.app')
@section('title','Edit Pengguna')
@section('page_title','Edit Pengguna')
@section('content')<div class="content-card p-4"><form method="POST" action="{{ route('admin.users.update',$user) }}" enctype="multipart/form-data">@csrf @method('PUT') @include('admin.users.form')<button class="btn btn-coral">Update</button><a href="{{ route('admin.users.index') }}" class="btn btn-light border">Batal</a></form></div>@endsection
