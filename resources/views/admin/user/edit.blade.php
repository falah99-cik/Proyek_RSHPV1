@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Edit User</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Form Edit User</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input 
                        type="text" 
                        name="nama" 
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $user->nama) }}"
                        placeholder="Masukkan nama user..."
                    >
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Masukkan email..."
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PASSWORD OPTIONAL --}}
                <div class="mb-3">
                    <label class="form-label">Password (Opsional)</label>
                    <input 
                        type="password" 
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Isi jika ingin mengganti password"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Biarkan kosong jika tidak ingin mengganti password.
                    </small>
                </div>


                {{-- ACTION BUTTONS --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Perbarui User
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
