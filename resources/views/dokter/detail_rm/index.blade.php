@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Detail Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dokter.rekam_medis.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Detail RM</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="container-fluid px-4 mt-4">

    {{-- Header Rekam Medis --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="fw-bold mb-2">Informasi Pasien</h5>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Pasien:</strong> {{ $rekam->nama_pet }}</p>
                    <p><strong>Dokter Pemeriksa:</strong> {{ $rekam->nama_dokter }}</p>
                    <p><strong>No Urut Temu:</strong> <span class="text-primary">{{ $rekam->no_urut }}</span></p>
                </div>

                <div class="col-md-6">
                    <p><strong>Anamnesa:</strong><br>{{ $rekam->anamnesa }}</p>
                    <p><strong>Diagnosa:</strong><br>{{ $rekam->diagnosa }}</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Header tindakan --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Tindakan Rekam Medis</h4>

        <a href="{{ route('dokter.detail_rm.create', $rekam->idrekam_medis) }}" 
           class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Tindakan
        </a>
    </div>


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Tabel tindakan --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60">No</th>
                        <th>Tindakan</th>
                        <th>Detail</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($detail as $d)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>

                        <td>{{ $d->deskripsi_tindakan_terapi }}</td>

                        <td>{{ $d->detail ?: '-' }}</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('dokter.detail_rm.edit', $d->iddetail_rekam_medis) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('dokter.detail_rm.destroy', $d->iddetail_rekam_medis) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus tindakan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}">

                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">
                            Belum ada tindakan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
