@extends('layouts.lte.main')

@section('title', 'Dashboard Pemilik')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h3>Dashboard Pemilik</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="row">

    {{-- CARD JUMLAH PET --}}
    <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $jumlahPet }}</h3>
                <p>Total Hewan Peliharaan</p>
            </div>
            <div class="icon">
                <i class="bi bi-paw"></i>
            </div>
            <a href="{{ route('pemilik.profil.index') }}" class="small-box-footer">
                Lihat Pet <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- CARD JADWAL --}}
    <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $jadwalAktif }}</h3>
                <p>Jadwal Temu Dokter Aktif</p>
            </div>
            <div class="icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <a href="{{ route('pemilik.jadwal.index') }}" class="small-box-footer">
                Lihat Jadwal <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- CARD REKAM MEDIS --}}
    <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $rekamTotal }}</h3>
                <p>Total Rekam Medis</p>
            </div>
            <div class="icon">
                <i class="bi bi-journal-medical"></i>
            </div>
            <a href="{{ route('pemilik.rekam.index') }}" class="small-box-footer">
                Lihat Rekam Medis <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

{{-- WELCOME CARD --}}
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Selamat Datang, {{ $pemilik->user->nama }}!</h5>
    </div>

    <div class="card-body">
        <p>
            Anda dapat melihat informasi hewan peliharaan Anda, membuat dan memantau
            jadwal temu dokter, serta melihat riwayat rekam medis secara lengkap.
        </p>
    </div>
</div>

@endsection
