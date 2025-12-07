@extends('layouts.lte.main')

@section('title', 'Buat Rekam Medis')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Buat Rekam Medis</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('perawat.temu.index') }}">Temu Dokter</a></li>
            <li class="breadcrumb-item"><a href="{{ route('perawat.rekam.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Buat RM</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('perawat.rekam.store') }}" method="POST">
            @csrf

            <input type="hidden" name="idreservasi_dokter" value="{{ $temu->idreservasi_dokter }}">
            <input type="hidden" name="idpet" value="{{ $temu->idpet }}">

            <div class="mb-3">
                <label>Nama Pet</label>
                <input type="text" class="form-control" value="{{ $temu->pet->nama }}" readonly>
            </div>

            <div class="mb-3">
                <label>Anamnesa</label>
                <textarea name="anamnesa" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Temuan Klinis</label>
                <textarea name="temuan_klinis" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Diagnosa Sementara</label>
                <textarea name="diagnosa" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>

        </form>
    </div>
</div>
@endsection
