@extends('layouts.lte.main')

@section('title', 'Jadwal Temu Dokter')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h3>Jadwal Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Jadwal Temu Dokter</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Daftar Jadwal</h4>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No Urut</th>
                    <th>Nama Pet</th>
                    <th>Dokter</th>
                    <th>Waktu Daftar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $j)
                <tr>
                    <td>{{ $j->no_urut }}</td>
                    <td>{{ $j->pet->nama }}</td>
                    <td>{{ $j->roleUser->user->nama }}</td>
                    <td>{{ $j->waktu_daftar }}</td>

                    <td>
                        @if ($j->status == 0)
                            <span class="badge bg-secondary">Menunggu</span>
                        @elseif ($j->status == 1)
                            <span class="badge bg-info text-dark">Proses Perawat</span>
                        @elseif ($j->status == 2)
                            <span class="badge bg-warning text-dark">Menunggu Dokter</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
