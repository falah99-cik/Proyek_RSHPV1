@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h3>Detail Rekam Medis</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pemilik.rekam.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Rekam Medis {{ $rekam->pet->nama }}</h4>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <strong>Anamnesa:</strong>
            <p>{{ $rekam->anamnesa }}</p>
        </div>

        <div class="mb-3">
            <strong>Temuan Klinis:</strong>
            <p>{{ $rekam->temuan_klinis }}</p>
        </div>

        <div class="mb-3">
            <strong>Diagnosa:</strong>
            <p>{{ $rekam->diagnosa }}</p>
        </div>

        <h5 class="mt-4">Tindakan / Terapi</h5>
        <ul>
            @forelse ($rekam->detail as $d)
                <li>{{ $d->kodeTindakan->deskripsi_tindakan_terapi }} — {{ $d->detail }}</li>
            @empty
                <li><i>Tidak ada tindakan</i></li>
            @endforelse
        </ul>

        <a href="{{ route('pemilik.rekam.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>

@endsection
