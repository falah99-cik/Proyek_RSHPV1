@extends('layouts.lte.main')
@section('title','Dashboard Resepsionis')

@section('content-header')
<div class="row">
    <div class="col-12">
        <h3>Dashboard Resepsionis</h3>
        <p class="text-muted">Ringkasan pelayanan hari ini</p>
    </div>
</div>
@endsection

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalAntrian }}</h3>
                <p>Antrian Hari Ini</p>
            </div>
            <div class="icon"><i class="fas fa-list"></i></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $antrianAktif->count() }}</h3>
                <p>Menunggu Pemeriksaan</p>
            </div>
            <div class="icon"><i class="fas fa-paw"></i></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $todayRegistrations->no_urut ?? '-' }}</h3>
                <p>Pendaftaran Baru</p>
            </div>
            <div class="icon"><i class="fas fa-user-plus"></i></div>
        </div>
    </div>

</div>

{{-- TABEL ANTRIAN TERBARU --}}
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <strong>Antrian Terbaru</strong>
    </div>

    <div class="card-body table-responsive">
        @if($recentAntrian->isEmpty())
            <p class="text-center text-muted">Belum ada antrian hari ini</p>
        @else
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No. Antrian</th>
                    <th>Hewan</th>
                    <th>Pemilik</th>
                    <th>Dokter</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentAntrian as $a)
                <tr>
                    <td>{{ $a->no_urut }}</td>
                    <td>{{ $a->pet->nama }}</td>
                    <td>{{ $a->pet->pemilik->user->nama }}</td>
                    <td>{{ $a->roleUser->user->nama }}</td>
                    <td>{{ $a->waktu_daftar }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection
