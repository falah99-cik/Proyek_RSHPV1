@extends('layouts.lte.main')

@section('title', 'Profil Pemilik')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h3>Profil Pemilik</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

{{-- Card Profil --}}
<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title">Informasi Pemilik</h4>
    </div>
    <div class="card-body">

        <div class="row">
{{-- FOTO PROFIL --}}
                <div class="col-md-3 text-center">

                    <img src="{{ asset('assets/adminlte/img/user.png') }}"
                         class="img-thumbnail rounded-circle mb-3"
                         style="width: 160px; height: 160px; object-fit: cover;">

                    <h5 class="fw-bold mt-2">{{ $pemilik->user->nama }}</h5>
                    <p class="text-muted">Pemilik Hewan</p>
                </div>

                {{-- DETAIL PROFIL --}}
                <div class="col-md-9">

                    <h5 class="fw-bold mb-3">Informasi Pemilik</h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Nama Lengkap</p>
                            <p class="text-muted">{{ $pemilik->user->nama }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Email</p>
                            <p class="text-muted">{{ $pemilik->user->email }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Nomor WhatsApp</p>
                            <p class="text-muted">{{ $pemilik->no_wa ?? '-' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Total Hewan Peliharaan</p>
                            <p class="text-muted">{{ $pet->count() }}</p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <p class="mb-1 fw-bold">Alamat</p>
                            <p class="text-muted">{{ $pemilik->alamat ?? '-' }}</p>
                        </div>

    </div>
</div>

{{-- Card Daftar Pet --}}
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Pet yang Dimiliki</h4>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama Pet</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Warna/Tanda</th>
                    <th>Jenis Kelamin</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pet as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->rasHewan->jenisHewan->nama_jenis_hewan }}</td>
                    <td>{{ $p->rasHewan->nama_ras }}</td>
                    <td>{{ $p->warna_tanda }}</td>
                    <td>{{ $p->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
