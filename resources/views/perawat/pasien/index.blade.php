@extends('layouts.lte.main')
@section('title','Data Pasien')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Data Pasien</h3>
        <small class="text-muted">Daftar pasien yang sudah memiliki rekam medis</small>
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
    <div class="card-header bg-primary text-white">
        <strong>Daftar Pasien</strong>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th style="width: 5%">No</th>
                    <th>Nama Pet</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Pemilik</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pasien as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->ras->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                    <td>{{ $p->ras->nama_ras ?? '-' }}</td>
                    <td>{{ $p->pemilik->user->nama ?? '-' }}</td>

                    <td class="text-center">
                        <a href="{{ route('perawat.pasien.show', $p->idpet) }}" 
                           class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Tidak ada pasien yang memiliki rekam medis.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
