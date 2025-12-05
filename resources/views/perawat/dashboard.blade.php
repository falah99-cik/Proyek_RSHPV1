@extends('layouts.lte.main')

@section('title', 'Dashboard Perawat')
@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Dashboard Perawat</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

</div>
@endsection

@section('content')

<div class="row">

    <!-- Box: Total Pasien -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ \App\Models\Pet::count() }}</h3>
                <p>Jumlah Pasien (Pet)</p>
            </div>
            <div class="icon">
                <i class="fas fa-paw"></i>
            </div>
            <a href="{{ route('perawat.pasien.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box: Total Rekam Medis -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ \App\Models\RekamMedis::count() }}</h3>
                <p>Rekam Medis Tercatat</p>
            </div>
            <div class="icon">
                <i class="fas fa-notes-medical"></i>
            </div>
            <a href="{{ route('perawat.rekam.index') }}" class="small-box-footer">
                Lihat Rekam Medis <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Box: Total Tindakan -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ \App\Models\DetailRekamMedis::count() }}</h3>
                <p>Total Tindakan Terapi</p>
            </div>
            <div class="icon">
                <i class="fas fa-syringe"></i>
            </div>
            <a href="{{ route('perawat.rekam.index') }}" class="small-box-footer">
                Lihat Tindakan <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<div class="row">

    <!-- Card: Menu Cepat -->
    <div class="col-lg-6">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Menu Cepat</h3>
            </div>
            <div class="card-body">

                <a href="{{ route('perawat.rekam.create') }}" class="btn btn-info w-100 mb-2">
                    <i class="fas fa-plus-circle"></i> Tambah Rekam Medis
                </a>

                <a href="{{ route('perawat.pasien.index') }}" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-paw"></i> Lihat Data Pasien
                </a>

                <a href="{{ route('perawat.profil.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-user"></i> Profil Saya
                </a>

            </div>
        </div>
    </div>

    <!-- Card: Aktivitas Terbaru -->
    <div class="col-lg-6">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Aktivitas Terbaru</h3>
            </div>
            <div class="card-body">
                @php
                    $recent = \App\Models\RekamMedis::with('pet')
                            ->latest()
                            ->limit(5)
                            ->get();
                @endphp

                @if($recent->count() == 0)
                    <p class="text-muted">Belum ada rekam medis yang dicatat.</p>
                @else
                    <ul class="list-group">
                        @foreach($recent as $r)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $r->pet->nama }}</strong><br>
                                <small>{{ $r->created_at }}</small>
                            </div>
                            <a href="{{ route('perawat.rekam.show', $r->idrekam_medis) }}"
                               class="btn btn-sm btn-success">
                                Detail
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
