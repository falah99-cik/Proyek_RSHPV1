@extends('layouts.lte.main')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah User</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Form Tambah User</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama User</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Email User</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
