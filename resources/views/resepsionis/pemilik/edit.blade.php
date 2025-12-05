@extends('layouts.lte.main')

@section('title', 'Edit Pemilik')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Edit Pemilik</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.pemilik.index') }}">Pemilik</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
            <form action="{{ route('resepsionis.pemilik.update', data_get($pemilik, 'idpemilik')) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input 
                type="text" 
                class="form-control" 
                value="{{ data_get($pemilik, 'user.nama') }}" 
                disabled>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input 
                type="email" 
                class="form-control" 
                value="{{ data_get($pemilik, 'user.email') }}" 
                disabled>
        </div>

        <div class="mb-3">
            <label>No WA</label>
            <input 
                type="text" 
                name="no_wa" 
                class="form-control" 
                value="{{ data_get($pemilik, 'no_wa') }}">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ data_get($pemilik, 'alamat') }}</textarea>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>
    </div>
</div>
@endsection
