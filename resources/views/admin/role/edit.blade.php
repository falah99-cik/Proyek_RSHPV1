@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Role</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Role</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Role</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.role.update', $role->idrole) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Role</label>
                    <input 
                        type="text" 
                        name="nama_role" 
                        class="form-control @error('nama_role') is-invalid @enderror"
                        value="{{ old('nama_role', $role->nama_role) }}"
                    >

                    @error('nama_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
