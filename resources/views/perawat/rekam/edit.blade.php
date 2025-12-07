@extends('layouts.lte.main')

@section('title', 'Edit Rekam Medis')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Edit Rekam Medis</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('perawat.rekam.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item"><a href="{{ route('perawat.rekam.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('perawat.rekam.update', $rm->idrekam_medis) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Anamnesa</label>
                <textarea name="anamnesa" class="form-control" required>{{ $rm->anamnesa }}</textarea>
            </div>

            <div class="mb-3">
                <label>Temuan Klinis</label>
                <textarea name="temuan_klinis" class="form-control" required>{{ $rm->temuan_klinis }}</textarea>
            </div>

            <div class="mb-3">
                <label>Diagnosa</label>
                <textarea name="diagnosa" class="form-control">{{ $rm->diagnosa }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
        </form>

    </div>
</div>
@endsection
