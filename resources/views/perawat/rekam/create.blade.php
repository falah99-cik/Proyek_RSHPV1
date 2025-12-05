@extends('layouts.lte.main')
@section('title','Tambah Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Detail Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('perawat.rekam.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h5 class="card-title mb-0">Form Tambah Rekam Medis</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('perawat.rekam.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pasien</label>
                <select name="idpet" class="form-control">
                    @foreach($pasien as $p)
                    <option value="{{ $p->idpet }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Anamnesa</label>
                <textarea name="anamnesa" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Temuan Klinis</label>
                <textarea name="temuan_klinis" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea name="diagnosa" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kode Tindakan Terapi</label>
                <select name="idkode_tindakan_terapi" class="form-control">
                    <option value="">-- Opsional --</option>
                    @foreach($tindakan as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}">
                        {{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Detail Tindakan</label>
                <textarea name="detail" class="form-control"></textarea>
            </div>

            <button class="btn btn-success mt-3">
                <i class="bi bi-check-circle"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
