@extends('layouts.lte.main')

@section('title', 'Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Rekam Medis</li>
        </ol>
    </div>

</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Rekam Medis Pasien</h4>
    </div>

    {{-- Alert --}}
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
                        <th>Nama Pet</th>
                        <th>No Urut Temu</th>
                        <th>Anamnesa</th>
                        <th>Diagnosa</th>
                        <th width="170px">Tanggal</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($rekam as $rm)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $rm->nama_pet }}</td>

                            <td class="text-center">
                                <span class="badge bg-primary">{{ $rm->no_urut }}</span>
                            </td>

                            <td>{{ Str::limit($rm->anamnesa, 40) }}</td>

                            <td>{{ Str::limit($rm->diagnosa, 40) }}</td>

                            <td>{{ $rm->created_at }}</td>

                            <td class="text-center">
                                <a href="{{ route('dokter.detail_rm.index', $rm->idrekam_medis) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Belum ada rekam medis yang ditangani.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
