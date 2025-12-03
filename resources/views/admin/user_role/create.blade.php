@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Tambah User Role</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.user_role.index') }}">User Role</a>
            </li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Validation Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Periksa kembali input Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">Form Tambah User Role</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.user_role.store') }}" method="POST">
                @csrf

                {{-- USER --}}
                <div class="mb-3">
                    <label class="form-label">Pilih User</label>
                    <select class="form-control @error('iduser') is-invalid @enderror" name="iduser">
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->iduser }}" {{ old('iduser') == $u->iduser ? 'selected' : '' }}>
                                {{ $u->nama }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>

                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Role</label>
                    <select class="form-control @error('idrole') is-invalid @enderror" name="idrole">
                        <option value="">-- Pilih Role --</option>
                        @foreach ($role as $r)
                            <option value="{{ $r->idrole }}" {{ old('idrole') == $r->idrole ? 'selected' : '' }}>
                                {{ $r->nama_role }}
                            </option>
                        @endforeach
                    </select>

                    @error('idrole')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>

                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON GROUP --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.user_role.index') }}" class="btn btn-secondary">
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
