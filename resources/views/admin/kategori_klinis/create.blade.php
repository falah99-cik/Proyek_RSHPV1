@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Kategori Klinis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.kategori_klinis.index') }}">Kategori Klinis</a>
            </li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">Form Tambah Kategori Klinis</h5>
        </div>

        <div class="card-body">

            {{-- Error Validation --}}
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

            {{-- FORM --}}
            <form action="{{ route('admin.kategori_klinis.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Kategori Klinis</label>
                    <input type="text"
                           name="nama_kategori_klinis"
                           class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                           placeholder="Contoh: Terapi, Pemeriksaan, Tindakan"
                           value="{{ old('nama_kategori_klinis') }}">

                    @error('nama_kategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
