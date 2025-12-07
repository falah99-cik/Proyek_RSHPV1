@extends('layouts.lte.main')
@section('title', 'Detail Pasien')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Detail Pasien: {{ $pasien->nama }}</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('perawat.pasien.index') }}">Data Pasien</a></li>
            <li class="breadcrumb-item active">Detail Pasien</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Informasi Pasien</strong>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th>Nama</th>
                <td>{{ $pasien->nama }}</td>
            </tr>
            <tr>
                <th>Jenis Hewan</th>
                <td>{{ $pasien->ras->jenisHewan->nama_jenis_hewan }}</td>
            </tr>
            <tr>
                <th>Ras</th>
                <td>{{ $pasien->ras->nama_ras }}</td>
            </tr>
            <tr>
                <th>Pemilik</th>
                <td>{{ $pasien->pemilik->user->nama }}</td>
            </tr>
            <tr>
                <th>No. WA Pemilik</th>
                <td>{{ $pasien->pemilik->no_wa }}</td>
            </tr>
        </table>
    </div>
</div>

{{-- Riwayat Rekam Medis --}}
<div class="card shadow">
    <div class="card-header bg-dark text-white">
        <strong>Riwayat Rekam Medis</strong>
    </div>

    <div class="card-body table-responsive">
        @if($pasien->rekamMedis->isEmpty())
            <p class="text-center text-muted">Belum ada rekam medis untuk pasien ini.</p>
        @else
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Dokter Pemeriksa</th>
                    <th>Anamnesa</th>
                    <th>Temuan Klinis</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pasien->rekamMedis as $rm)
                <tr>
                    <td>{{ $rm->created_at }}</td>
                    <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                    <td>{{ $rm->anamnesa }}</td>
                    <td>{{ $rm->temuan_klinis }}</td>
                    <td>{{ $rm->diagnosa }}</td>
                    <td>
                        @forelse($rm->tindakan as $t)
                            <div>
                                <strong>{{ $t->kode->kode }}</strong> – {{ $t->kode->deskripsi_tindakan_terapi }}
                                @if($t->detail)
                                    <br><em>Catatan:</em> {{ $t->detail }}
                                @endif
                            </div>
                            <hr>
                        @empty
                            <span class="text-muted">Tidak ada tindakan</span>
                        @endforelse
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
