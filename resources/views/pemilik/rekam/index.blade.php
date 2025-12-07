@extends('layouts.lte.main')

@section('title', 'Rekam Medis')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h3>Rekam Medis</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Rekam Medis</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Daftar Rekam Medis Pet</h4>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pet</th>
                    <th>Dokter Pemeriksa</th>
                    <th>Diagnosa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($rekam as $r)
                <tr>
                    <td>{{ $r->created_at }}</td>
                    <td>{{ $r->pet->nama }}</td>
                    <td>{{ $r->dokter->user->nama ?? 'Tidak Ada' }}</td>
                    <td>{{ $r->diagnosa }}</td>
                    <td>
                        <a href="{{ route('pemilik.rekam.show', $r->idrekam_medis) }}"
                           class="btn btn-info btn-sm">
                           Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
