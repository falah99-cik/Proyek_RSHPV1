@extends('layouts.app')

@section('content')

<h2 class="mb-4">Dashboard Administrator</h2>

<div class="row">

    {{-- JENIS HEWAN --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.jenis_hewan.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Jenis Hewan</h5>
                    <p class="text-muted">Kelola data jenis hewan</p>
                </div>
            </div>
        </a>
    </div>

    {{-- RAS HEWAN --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.ras_hewan.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Ras Hewan</h5>
                    <p class="text-muted">Kelola data ras hewan</p>
                </div>
            </div>
        </a>
    </div>

    {{-- KATEGORI --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.kategori.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Kategori</h5>
                    <p class="text-muted">Kelola kategori tindakan</p>
                </div>
            </div>
        </a>
    </div>

    {{-- KATEGORI KLINIS --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.kategori_klinis.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Kategori Klinis</h5>
                    <p class="text-muted">Kelola kategori klinis</p>
                </div>
            </div>
        </a>
    </div>

    {{-- TINDAKAN TERAPI --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.tindakan.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Tindakan Terapi</h5>
                    <p class="text-muted">Kelola kode tindakan</p>
                </div>
            </div>
        </a>
    </div>

    {{-- PET --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.pet.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Pet</h5>
                    <p class="text-muted">Kelola data hewan peliharaan</p>
                </div>
            </div>
        </a>
    </div>

    {{-- PEMILIK --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.pemilik.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Pemilik</h5>
                    <p class="text-muted">Kelola data pemilik</p>
                </div>
            </div>
        </a>
    </div>

    {{-- ROLE --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.role.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Role</h5>
                    <p class="text-muted">Kelola role pengguna</p>
                </div>
            </div>
        </a>
    </div>

    {{-- USER ROLE --}}
    <div class="col-md-3 mb-3">
        <a href="{{ route('admin.user_role.index') }}" class="text-decoration-none">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">User Role</h5>
                    <p class="text-muted">Kelola relasi user & role</p>
                </div>
            </div>
        </a>
    </div>

</div>

@endsection
