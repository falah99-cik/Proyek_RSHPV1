@extends('layouts.lte.main')

@section('title', 'Profil Admin')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Profil Admin</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
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

                    <img src="{{ $user->foto ? asset('uploads/admin/'.$user->foto) : asset('assets/adminlte/img/user.png') }}"
                         class="img-thumbnail rounded-circle mb-3"
                         style="width: 160px; height: 160px; object-fit: cover;">

                    <h5 class="fw-bold mt-2">{{ $user->nama }}</h5>
                    <p class="text-muted">Administrator</p>
                </div>

                {{-- DETAIL PROFIL --}}
                <div class="col-md-9">

                    <h5 class="fw-bold mb-3">Informasi Admin</h5>

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
                            <p class="mb-1 fw-bold">Role</p>
                            <p class="text-muted">Administrator</p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <p class="mb-1 fw-bold">Alamat</p>
                            <p class="text-muted">{{ $admin->alamat ?? '-' }}</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
