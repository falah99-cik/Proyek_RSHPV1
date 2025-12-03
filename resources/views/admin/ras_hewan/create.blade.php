@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Ras Hewan</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.ras_hewan.index') }}">Ras Hewan</a>
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
            <h5 class="mb-0">Form Tambah Ras Hewan</h5>
        </div>

        <div class="card-body">

            {{-- ERROR MESSAGE --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Periksa input Anda!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif


            <form action="{{ route('admin.ras_hewan.store') }}" method="POST">
                @csrf

                {{-- NAMA RAS --}}
                <div class="mb-3">
                    <label class="form-label">Nama Ras Hewan</label>
                    <input type="text"
                           name="nama_ras"
                           class="form-control @error('nama_ras') is-invalid @enderror"
                           placeholder="Contoh: Persia, Anggora, Bulldog"
                           value="{{ old('nama_ras') }}">

                    @error('nama_ras')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JENIS HEWAN --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Hewan</label>
                    <select name="idjenis_hewan"
                            class="form-control @error('idjenis_hewan') is-invalid @enderror">
                        <option value="">-- Pilih Jenis Hewan --</option>

                        @foreach ($jenisHewan as $item)
                            <option value="{{ $item->idjenis_hewan }}"
                                {{ old('idjenis_hewan') == $item->idjenis_hewan ? 'selected' : '' }}>
                                {{ $item->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>

                    @error('idjenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON GROUP --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('admin.ras_hewan.index') }}" class="btn btn-secondary">
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
