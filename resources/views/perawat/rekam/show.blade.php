@extends('layouts.lte.main')
@section('title','Detail Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Detail Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('perawat.rekam.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h4 class="fw-bold">Pasien: {{ $rekam->pet->nama }}</h4>

        <p><b>Anamnesa:</b> {{ $rekam->anamnesa }}</p>
        <p><b>Temuan Klinis:</b> {{ $rekam->temuan_klinis }}</p>
        <p><b>Diagnosa:</b> {{ $rekam->diagnosa }}</p>

        <h5 class="mt-4">Tindakan:</h5>
        @foreach($rekam->detail as $d)
            <div class="border rounded p-2 mb-2">
                <b>{{ $d->kode->kode }}</b> — {{ $d->kode->deskripsi_tindakan_terapi }}<br>
                <small class="text-muted">Detail: {{ $d->detail }}</small>
            </div>
        @endforeach
    </div>
</div>
@endsection
