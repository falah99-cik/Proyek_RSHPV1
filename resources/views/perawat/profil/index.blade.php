@extends('layouts.lte.main')

@section('title', 'Profil Perawat')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Profil Perawat</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="container-fluid px-4 mt-4">

    {{-- CARD PROFIL --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                {{-- FOTO PROFIL --}}
                <div class="col-md-3 text-center">
                    <img src="{{ $user->foto ? asset('uploads/perawat/'.$user->foto) : asset('assets/adminlte/img/user.png') }}"
                         class="img-thumbnail rounded-circle mb-3"
                         style="width: 160px; height: 160px; object-fit: cover;">

                    <h5 class="fw-bold mt-2">{{ $user->nama }}</h5>
                    <p class="text-muted">Perawat Hewan</p>
                </div>

                {{-- DETAIL PROFIL --}}
                <div class="col-md-9">

                    <h5 class="fw-bold mb-3">Informasi Perawat</h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Nama Lengkap</p>
                            <p class="text-muted">{{ $user->nama }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Email</p>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Nomor HP</p>
                            <p class="text-muted">{{ $perawat->no_hp ?? '-' }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Role</p>
                            <p class="text-muted">Perawat</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="mb-1 fw-bold">Pendidikan</p>
                            <p class="text-muted">{{ $perawat->pendidikan ?? '-' }}</p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <p class="mb-1 fw-bold">Alamat</p>
                            <p class="text-muted">{{ $perawat->alamat ?? '-' }}</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
