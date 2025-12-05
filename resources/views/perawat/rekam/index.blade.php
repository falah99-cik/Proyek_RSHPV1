@extends('layouts.lte.main')
@section('title','Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Rekam Medis</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h5 class="card-title mb-0">Daftar Rekam Medis</h5>
        <a href="{{ route('perawat.rekam.create') }}" class="btn btn-light">+ Tambah Rekam</a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Anamnesa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekam as $r)
                <tr>
                    <td>{{ $r->created_at }}</td>
                    <td>{{ $r->pet->nama }}</td>
                    <td>{{ $r->anamnesa }}</td>
                    <td>
                        <a href="{{ route('perawat.rekam.show', $r->idrekam_medis) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
