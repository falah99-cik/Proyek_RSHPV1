@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Edit Ras Hewan</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.ras_hewan.index') }}">Ras Hewan</a>
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
            <h5 class="mb-0">Form Edit Ras Hewan</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.ras_hewan.update', $ras->idras_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Ras --}}
                <div class="mb-3">
                    <label class="form-label">Nama Ras Hewan</label>
                    <input 
                        type="text" 
                        name="nama_ras"
                        class="form-control @error('nama_ras') is-invalid @enderror"
                        value="{{ old('nama_ras', $ras->nama_ras) }}"
                    >

                    @error('nama_ras')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Hewan --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Hewan</label>
                    <select 
                        name="idjenis_hewan" 
                        class="form-control @error('idjenis_hewan') is-invalid @enderror"
                    >
                        <option value="">-- Pilih Jenis Hewan --</option>

                        @foreach ($jenisHewan as $j)
                            <option 
                                value="{{ $j->idjenis_hewan }}"
                                {{ old('idjenis_hewan', $ras->idjenis_hewan) == $j->idjenis_hewan ? 'selected' : '' }}
                            >
                                {{ $j->nama_jenis_hewan }}
                            </option>
                        @endforeach

                    </select>

                    @error('idjenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.ras_hewan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Perbarui
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
