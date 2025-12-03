@extends('layouts.lte.main')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Kategori</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Form Tambah Kategori</h5>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa input Anda:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori"
                           class="form-control @error('nama_kategori') is-invalid @enderror"
                           placeholder="Contoh: Vaksinasi, Diagnostik"
                           value="{{ old('nama_kategori') }}">

                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
