@extends('layouts.lte.main')

@section('title', 'Tambah Temu Dokter')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Tambah Temu Dokter</h3>
        <p class="text-muted mb-0">Masukkan data untuk mendaftarkan pasien ke dokter</p>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <strong>Form Pendaftaran Temu Dokter</strong>
    </div>

    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
            @csrf

            {{-- PET --}}
            <div class="mb-3">
                <label class="form-label">Nama Hewan</label>
                <select name="idpet" class="form-control" required>
                    <option value="">-- Pilih Hewan --</option>
                    @foreach ($pet as $p)
                        <option value="{{ $p->idpet }}">
                            {{ $p->nama }} — {{ $p->pemilik->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- DOKTER --}}
            <div class="mb-3">
                <label class="form-label">Dokter Pemeriksa</label>
                <select name="idrole_user" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokter as $dr)
                        <option value="{{ $dr->idrole_user }}">
                            {{ $dr->user->nama }} — (Dokter)
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>

        </form>

    </div>
</div>

@endsection
