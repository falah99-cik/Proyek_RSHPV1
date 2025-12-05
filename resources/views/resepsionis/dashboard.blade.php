@extends('layouts.lte.main')

@section('title', 'Dashboard Resepsionis')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Dashboard Resepsionis</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

{{-- STATISTIC CARDS --}}
<div class="row">

    {{-- Total Pemilik --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ data_get($count, 'pemilik', 0) }}</h3>
                <p>Total Pemilik</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    {{-- Total Pet --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ data_get($count, 'pet', 0) }}</h3>
                <p>Total Hewan Terdaftar</p>
            </div>
            <div class="icon">
                <i class="fas fa-paw"></i>
            </div>
        </div>
    </div>

    {{-- Total Antrian Hari Ini --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ data_get($count, 'antrian_hari_ini', 0) }}</h3>
                <p>Antrian Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-list-ol"></i>
            </div>
        </div>
    </div>

    {{-- Antrian Selesai --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ data_get($count, 'selesai_hari_ini', 0) }}</h3>
                <p>Selesai Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

</div>

{{-- TABLE ANTRIAN HARI INI --}}
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Antrian Temu Dokter Hari Ini</h5>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Nama Pet</th>
                    <th>Pemilik</th>
                    <th>Perawat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    /** @var \Illuminate\Support\Collection|\App\Models\TemuDokter[] $listAntrian */
                    $listAntrian = $antrian;
                @endphp

                @forelse ($listAntrian as $a)
                <tr>
                    <td>{{ data_get($a, 'no_urut') }}</td>
                    <td>{{ data_get($a, 'pet.nama') }}</td>
                    <td>{{ data_get($a, 'pet.pemilik.user.nama') }}</td>
                    <td>{{ data_get($a, 'roleUser.user.nama') }}</td>
                    <td>
                        @if (data_get($a, 'status') == 0)
                            <span class="badge bg-warning">Menunggu</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada antrian hari ini</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
