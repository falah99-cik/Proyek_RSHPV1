@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Detail Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.rekam_medis.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Detail Rekam Medis</li>
        </ol>
    </div>
</div>


@endsection

@section('content')

<div class="container-fluid px-4 mt-4">
{{-- HEADER DETAIL REKAM MEDIS --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Informasi Rekam Medis</h4>

    <div>
        <a href="{{ route('admin.rekam_medis.index') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <div class="row">

            {{-- KOLOM KIRI --}}
            <div class="col-md-6">

                <p><strong>Pasien:</strong> {{ $rekam->nama_pet }}</p>

                <p><strong>Dokter Pemeriksa:</strong> {{ $rekam->nama_dokter }}</p>

                <p><strong>No Urut Temu Dokter:</strong>
                    <span class="text-primary">{{ $rekam->no_urut }}</span>
                </p>

                <p class="fw-bold mb-1">Anamnesa</p>
                <p class="text-muted">{{ $rekam->anamnesa }}</p>

                <p class="fw-bold mb-1">Temuan Klinis</p>
                <p class="text-muted">{{ $rekam->temuan_klinis }}</p>

            </div>

            {{-- KOLOM KANAN --}}
            <div class="col-md-6">

                <p class="fw-bold mb-1">Diagnosa</p>
                <p class="text-muted">{{ $rekam->diagnosa }}</p>

                <p class="fw-bold mb-1">Tanggal Rekam</p>
                <p class="text-muted">{{ $rekam->created_at }}</p>

            </div>

        </div>

    </div>
</div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Tindakan</h4>

        <a href="{{ route('admin.detail_rm.create', $rekam->idrekam_medis) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Tindakan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60px">No</th>
                        <th>Tindakan</th>
                        <th>Detail</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($detail as $d)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $d->deskripsi_tindakan_terapi }}</td>

                            <td>{{ $d->detail ?: '-' }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.detail_rm.edit', $d->iddetail_rekam_medis) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('admin.detail_rm.destroy', $d->iddetail_rekam_medis) }}"
                                          onsubmit="return confirm('Hapus tindakan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}">

                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
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
