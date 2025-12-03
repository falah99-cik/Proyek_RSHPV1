@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Kategori Klinis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.kategori_klinis.index') }}">Kategori Klinis</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Form Edit Kategori Klinis</h5>
        </div>

        <div class="card-body">

            <form 
                action="{{ route('admin.kategori_klinis.update', $kategoriKlinis->idkategori_klinis) }}" 
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kategori Klinis</label>

                    <input 
                        type="text" 
                        name="nama_kategori_klinis" 
                        class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                        value="{{ old('nama_kategori_klinis', $kategoriKlinis->nama_kategori_klinis) }}"
                        placeholder="Contoh: Bedah Minor, Diagnostik Klinis"
                    >

                    @error('nama_kategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.kategori_klinis.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Perbarui
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
