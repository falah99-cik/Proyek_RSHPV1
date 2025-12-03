@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Pet</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.pet.index') }}">Pet</a>
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
            <h5 class="mb-0">Form Tambah Pet</h5>
        </div>

        <div class="card-body">

            {{-- ERROR MESSAGE --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Periksa input Anda!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('admin.pet.store') }}" method="POST">
                @csrf

                {{-- NAMA PET --}}
                <div class="mb-3">
                    <label class="form-label">Nama Pet</label>
                    <input type="text"
                           class="form-control @error('nama') is-invalid @enderror"
                           name="nama"
                           value="{{ old('nama') }}"
                           placeholder="Contoh: Snowy, Blacky">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TANGGAL LAHIR --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date"
                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                           name="tanggal_lahir"
                           value="{{ old('tanggal_lahir') }}">

                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- WARNA & TANDA --}}
                <div class="mb-3">
                    <label class="form-label">Warna / Tanda</label>
                    <input type="text"
                           class="form-control @error('warna_tanda') is-invalid @enderror"
                           name="warna_tanda"
                           placeholder="Contoh: Putih belang hitam"
                           value="{{ old('warna_tanda') }}">

                    @error('warna_tanda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                            name="jenis_kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                        <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                    </select>

                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- RAS HEWAN --}}
                <div class="mb-3">
                    <label class="form-label">Ras Hewan</label>
                    <select class="form-control @error('idras_hewan') is-invalid @enderror"
                            name="idras_hewan">
                        <option value="">-- Pilih Ras Hewan --</option>
                        @foreach ($ras as $r)
                            <option value="{{ $r->idras_hewan }}"
                                {{ old('idras_hewan') == $r->idras_hewan ? 'selected' : '' }}>
                                {{ $r->nama_ras }} ({{ $r->jenisHewan->nama_jenis_hewan }})
                            </option>
                        @endforeach
                    </select>

                    @error('idras_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PEMILIK --}}
                <div class="mb-3">
                    <label class="form-label">Pemilik</label>
                    <select class="form-control @error('idpemilik') is-invalid @enderror"
                            name="idpemilik">
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach ($pemilik as $p)
                            <option value="{{ $p->idpemilik }}"
                                {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                {{ $p->user->nama }}
                            </option>
                        @endforeach
                    </select>

                    @error('idpemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON GROUP --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
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
