@extends('layouts.lte.main')

@section('title', 'Data Pasien')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Data Pasien</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Pasien</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Pasien (Pet)</h4>
    </div>

    <div class="card shadow-sm">

        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60px">No</th>
                        <th>Nama Pet</th>
                        <th>Jenis Hewan</th>
                        <th>Ras</th>
                        <th>Pemilik</th>
                        <th>No Telp Pemilik</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pasien as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            {{-- Nama Pet --}}
                            <td>{{ $p->nama }}</td>

                            {{-- Jenis Hewan --}}
                            <td>{{ $p->jenis_hewan }}</td>

                            {{-- Ras Hewan --}}
                            <td>{{ $p->ras_hewan }}</td>


                            {{-- Nama Pemilik --}}
                            <td>{{ $p->nama_pemilik }}</td>

                            {{-- Nomor WA (bukan no_telp) --}}
                            <td>{{ $p->no_wa }}</td>

                            <td class="text-center">
                                <a href="{{ route('dokter.rekam_medis.index') }}?pet={{ $p->idpet }}" 
                                   class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Rekam Medis
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-3 text-muted">
                                Belum ada data pasien.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection
