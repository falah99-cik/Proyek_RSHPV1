@extends('layouts.lte.main')

@section('title', 'Tambah Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.rekam_medis.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>

</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.rekam_medis.store') }}" method="POST">
                @csrf

                {{-- PET --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Pet</label>
                    <select class="form-control" name="idpet" required>
                        <option value="">-- Pilih Pet --</option>
                        @foreach ($pet as $p)
                            <option value="{{ $p->idpet }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- DOKTER --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Dokter Pemeriksa</label>
                    <select class="form-control" name="dokter_pemeriksa" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach ($dokter as $d)
                            <option value="{{ $d->idrole_user }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- TEMU DOKTER --}}
                <div class="mb-3">
                    <label class="form-label">Nomor Urut Temu Dokter</label>
                    <select class="form-control" name="idreservasi_dokter" required>
                        <option value="">-- Pilih Nomor Urut --</option>
                        @foreach ($temu as $t)
                            <option value="{{ $t->idreservasi_dokter }}">
                                {{ $t->no_urut }} - ({{ $t->idpet }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ANAMNESA --}}
                <div class="mb-3">
                    <label class="form-label">Anamnesa</label>
                    <textarea class="form-control" name="anamnesa" rows="3" required></textarea>
                </div>

                {{-- TEMUAN KLINIS --}}
                <div class="mb-3">
                    <label class="form-label">Temuan Klinis</label>
                    <textarea class="form-control" name="temuan_klinis" rows="3" required></textarea>
                </div>

                {{-- DIAGNOSA --}}
                <div class="mb-3">
                    <label class="form-label">Diagnosa</label>
                    <textarea class="form-control" name="diagnosa" rows="3" required></textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.rekam_medis.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
