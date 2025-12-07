@extends('layouts.lte.main')

@section('title', 'Edit Temu Dokter')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Edit Temu Dokter</h3>
        <small class="text-muted">Perbarui data pendaftaran temu dokter</small>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header bg-warning">
        <strong>Edit Data</strong>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('resepsionis.temu-dokter.update', $temu->idreservasi_dokter) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Hewan</label>
                <select name="idpet" class="form-control" required>
                    @foreach ($pet as $p)
                        <option value="{{ $p->idpet }}" {{ $temu->idpet == $p->idpet ? 'selected' : '' }}>
                            {{ $p->nama }} — {{ $p->pemilik->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Dokter Pemeriksa</label>
                <select name="idrole_user" class="form-control" required>
                    @foreach ($dokter as $dr)
                        <option value="{{ $dr->idrole_user }}" {{ $temu->idrole_user == $dr->idrole_user ? 'selected' : '' }}>
                            {{ $dr->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
            </div>

        </form>
    </div>
</div>

@endsection
