@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Pemilik</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.pemilik.index') }}">Pemilik</a>
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
            <h4 class="mb-0">Form Edit Pemilik</h4>
        </div>

        <div class="card-body">

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali input Anda:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama User (readonly) --}}
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        value="{{ $pemilik->user->nama }}"
                        readonly
                    >
                </div>

                {{-- Nomor WA --}}
                <div class="mb-3">
                    <label class="form-label">Nomor WA</label>
                    <input 
                        type="text" 
                        name="no_wa" 
                        class="form-control @error('no_wa') is-invalid @enderror"
                        value="{{ old('no_wa', $pemilik->no_wa) }}"
                        placeholder="08xxxx"
                    >
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea 
                        name="alamat" 
                        class="form-control @error('alamat') is-invalid @enderror"
                        rows="3"
                    >{{ old('alamat', $pemilik->alamat) }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">

                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Update
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection
