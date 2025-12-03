@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Kode Tindakan Terapi</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.tindakan.index') }}">Tindakan Terapi</a>
            </li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong> Periksa kembali input Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <h5 class="mb-0">Form Tambah Kode Tindakan Terapi</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.tindakan.store') }}" method="POST">
                @csrf

                {{-- KODE TINDAKAN --}}
                <div class="mb-3">
                    <label class="form-label">Kode Tindakan</label>
                    <input type="text"
                           name="kode"
                           class="form-control @error('kode') is-invalid @enderror"
                           placeholder="Contoh: T-001"
                           value="{{ old('kode') }}">

                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Tindakan</label>
                    <textarea name="deskripsi_tindakan_terapi"
                              rows="3"
                              class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                              placeholder="Penjelasan tindakan terapinya...">{{ old('deskripsi_tindakan_terapi') }}</textarea>

                    @error('deskripsi_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="idkategori"
                            class="form-control @error('idkategori') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategori as $item)
                            <option value="{{ $item->idkategori }}"
                                {{ old('idkategori') == $item->idkategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                    @error('idkategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI KLINIS --}}
                <div class="mb-3">
                    <label class="form-label">Kategori Klinis</label>
                    <select name="idkategori_klinis"
                            class="form-control @error('idkategori_klinis') is-invalid @enderror">
                        <option value="">-- Pilih Kategori Klinis --</option>

                        @foreach ($kategoriKlinis as $item)
                            <option value="{{ $item->idkategori_klinis }}"
                                {{ old('idkategori_klinis') == $item->idkategori_klinis ? 'selected' : '' }}>
                                {{ $item->nama_kategori_klinis }}
                            </option>
                        @endforeach
                    </select>

                    @error('idkategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON GROUP --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('admin.tindakan.index') }}" class="btn btn-secondary">
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
