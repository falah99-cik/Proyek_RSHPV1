@extends('layouts.lte.main')
@section('title', 'Dashboard Perawat')

@section('content-header')
<div class="row">
    <div class="col-12">
        <h3 class="mb-0">Dashboard Perawat</h3>
        <p class="text-muted">Ringkasan aktivitas dan status pelayanan hari ini</p>
    </div>
</div>
@endsection

@section('content')
@if(session('perawat_profile_incomplete'))
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <div>
            <strong>Profil belum lengkap.</strong>
            Silakan lengkapi identitas perawat terlebih dahulu.
        </div>
        <a href="{{ route('perawat.profil.create') }}"
           class="btn btn-sm btn-warning">
            Lengkapi Profil
        </a>
    </div>
@endif

<div class="row">

    <!-- Antrian aktif -->
    <div class="col-md-4">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $antrian }}</h3>
                <p>Antrian Menunggu Pemeriksaan</p>
            </div>
            <div class="icon">
                <i class="fas fa-notes-medical"></i>
            </div>
        </div>
    </div>

    <!-- Total Rekam Medis -->
    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalRm }}</h3>
                <p>Total Rekam Medis</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-medical"></i>
            </div>
        </div>
    </div>

    <!-- Pasien dengan RM -->
    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $pasienRm }}</h3>
                <p>Pasien Memiliki Rekam Medis</p>
            </div>
            <div class="icon">
                <i class="fas fa-paw"></i>
            </div>
        </div>
    </div>
</div>


<!-- ANTRIAN DOKTER -->
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Antrian Pasien Hari Ini</strong>
    </div>

    <div class="card-body table-responsive">
        @if($listAntrian->isEmpty())
            <p class="text-center text-muted">Belum ada pasien dalam antrian.</p>
        @else
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No. Urut</th>
                    <th>Nama Hewan</th>
                    <th>Pemilik</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listAntrian as $a)
                <tr>
                    <td>{{ $a->no_urut }}</td>
                    <td>{{ $a->pet->nama }}</td>
                    <td>{{ $a->pet->pemilik->user->nama }}</td>
                    <td>{{ $a->waktu_daftar }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>


<!-- REKAM MEDIS TERBARU -->
<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white">
        <strong>Rekam Medis Terbaru</strong>
    </div>

    <div class="card-body table-responsive">
        @if($recentRm->isEmpty())
            <p class="text-center text-muted">Belum ada rekam medis terbaru.</p>
        @else
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Hewan</th>
                    <th>Dokter Pemeriksa</th>
                    <th>Tanggal</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRm as $rm)
                <tr>
                    <td>{{ $rm->pet->nama }}</td>
                    <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                    <td>{{ $rm->created_at }}</td>
                    <td>{{ $rm->diagnosa ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection
