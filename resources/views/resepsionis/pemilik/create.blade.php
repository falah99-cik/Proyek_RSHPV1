@extends('layouts.lte.main')

@section('title', 'Tambah Pemilik')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Tambah Pemilik</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.pemilik.index') }}">Pemilik</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label>No WA</label>
                <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa') }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" value="{{ old('alamat') }}"></textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
