@extends('layouts.lte.main')

@section('title', 'Tambah Temu Dokter')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Tambah Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Pet</label>
                <select name="idpet" class="form-control">
                    @foreach ($pet as $p)
                        <option value="{{ $p->idpet }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Perawat</label>
                <select name="idrole_user" class="form-control">
                    @foreach ($perawat as $pr)
                        <option value="{{ $pr->idrole_user }}">{{ $pr->user->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>

        </form>

    </div>
</div>

@endsection
