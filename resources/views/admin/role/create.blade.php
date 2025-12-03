@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Role</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.role.index') }}">Role</a>
            </li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Periksa kembali input Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">Form Tambah Role</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf

                {{-- NAMA ROLE --}}
                <div class="mb-3">
                    <label class="form-label">Nama Role</label>
                    <input type="text"
                           class="form-control @error('nama_role') is-invalid @enderror"
                           name="nama_role"
                           placeholder="Contoh: Admin, Dokter, Perawat"
                           value="{{ old('nama_role') }}">

                    @error('nama_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON GROUP --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
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
