@extends('layouts.lte.main')

@section('title', 'Antrian Temu Dokter')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Antrian Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Temu Dokter</li>
        </ol>
    </div>
</div>
@endsection


@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Daftar Antrian Pasien</h5>
    </div>

    <div class="card-body table-responsive">

        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="80">No Urut</th>
                    <th>Nama Pet</th>
                    <th>Pemilik</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($antrian as $a)
                <tr>
                    <td class="text-center fw-bold">{{ $a->no_urut }}</td>

                    <td>{{ data_get($a, 'pet.nama') }}</td>

                    <td>{{ data_get($a, 'pet.pemilik.user.nama') }}</td>

                    <td>
                        @if ($a->status == 0)
                            <span class="badge bg-secondary">Menunggu</span>
                        @elseif ($a->status == 1)
                            <span class="badge bg-warning">Diproses Perawat</span>
                        @elseif ($a->status == 2)
                            <span class="badge bg-info">Menunggu Dokter</span>
                        @elseif ($a->status == 3)
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>

                    <td>

                        @if ($a->status == 0)
                        {{-- Button Proses --}}
                        <form action="{{ route('perawat.temu.proses', $a->idreservasi_dokter) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-check-circle"></i> Proses
                            </button>
                        </form>
                        @endif

                        @if ($a->status == 1)
                        {{-- Button Buat Rekam Medis --}}
                        <a href="{{ route('perawat.rekam.create', ['idreservasi_dokter' => $a->idreservasi_dokter]) }}"
                           class="btn btn-success btn-sm">
                            <i class="bi bi-journal-plus"></i> Buat RM
                        </a>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada antrian untuk Anda.</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

@endsection
