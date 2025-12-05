@extends('layouts.lte.main')
@section('title','Data Pasien')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Data Pasien</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Pasien</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Pemilik</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pasien as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->ras->jenisHewan->nama_jenis_hewan }}</td>
                    <td>{{ $p->ras->nama_ras }}</td>
                    <td>{{ $p->pemilik->user->nama ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
