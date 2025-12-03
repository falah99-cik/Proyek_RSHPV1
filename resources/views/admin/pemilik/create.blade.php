@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Pemilik</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.pemilik.index') }}">Pemilik</a>
            </li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Periksa kembali input Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">Form Tambah Pemilik</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.pemilik.store') }}" method="POST">
                @csrf

                {{-- PILIH USER --}}
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

                {{-- NOMOR WA --}}
                <div class="mb-3">
                    <label class="form-label">Nomor WA</label>
                    <input type="text"
                           class="form-control @error('no_wa') is-invalid @enderror"
                           name="no_wa"
                           placeholder="08xxxxxxxxxx"
                           value="{{ old('no_wa') }}">
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ALAMAT --}}
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                              name="alamat"
                              rows="3"
                              placeholder="Masukkan alamat lengkap...">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
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
