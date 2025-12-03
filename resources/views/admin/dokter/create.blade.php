@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Dokter</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Dokter</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>

</div>
@endsection


@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Form Tambah Dokter</h4>
        </div>

        <div class="card-body">

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Periksa kembali input anda.</strong>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.dokter.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- Alamat --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                               value="{{ old('alamat') }}" required>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- No HP --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp') }}" required>
                        @error('no_hp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Bidang Dokter --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bidang Dokter</label>
                        <input type="text" name="bidang_dokter" class="form-control @error('bidang_dokter') is-invalid @enderror"
                               value="{{ old('bidang_dokter') }}" required>
                        @error('bidang_dokter')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Pilih User --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Pilih User</label>
                        <select name="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                            <option value="">-- Pilih User --</option>

                            @foreach($user as $u)
                                <option value="{{ $u->iduser }}"
                                        {{ old('id_user') == $u->iduser ? 'selected' : '' }}>
                                    {{ $u->nama }} — {{ $u->email }}
                                </option>
                            @endforeach

                        </select>
                        @error('id_user')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
