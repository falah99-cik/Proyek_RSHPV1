@extends('layouts.lte.main')

@section('content-header')

<div class="container-fluid px-4 pt-2 mt-3">

<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Jenis Hewan</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.jenis_hewan.index') }}">Jenis Hewan</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Tambah Jenis Hewan</h5>
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali input Anda:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jenis_hewan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Jenis Hewan</label>
                <input type="text" name="nama_jenis_hewan"
                       class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                       placeholder="Contoh: Anjing, Kucing, Sapi"
                       value="{{ old('nama_jenis_hewan') }}">

                @error('nama_jenis_hewan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.jenis_hewan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
