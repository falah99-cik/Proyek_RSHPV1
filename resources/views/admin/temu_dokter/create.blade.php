@extends('layouts.lte.main')

@section('title', 'Tambah Temu Dokter')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.temu_dokter.index') }}">Temu Dokter</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.temu_dokter.store') }}" method="POST">
                @csrf

                {{-- PET --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Pet</label>
                    <select class="form-control" name="idpet" required>
                        <option value="">-- Pilih Pet --</option>
                        @foreach ($pet as $p)
                            <option value="{{ $p->idpet }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- DOKTER --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Dokter</label>
                    <select class="form-control" name="idrole_user" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach ($dokter as $d)
                            <option value="{{ $d->idrole_user }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="1">Selesai</option>
                        <option value="0">Menunggu</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.temu_dokter.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
