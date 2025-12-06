@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Data Dokter</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Dokter</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="container-fluid px-4 mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Dokter</h4>

        <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Dokter
        </a>
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
                        <th>Nama Dokter</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Bidang Dokter</th>
                        <th>Jenis Kelamin</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($dokter as $d)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_user }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td>{{ $d->bidang_dokter }}</td>
                        <td class="text-center">
    @if($d->jenis_kelamin == 'L')
        <span class="badge bg-primary">Laki-laki</span>
    @elseif($d->jenis_kelamin == 'P')
        <span class="badge bg-pink" style="background-color:#d63384;">Perempuan</span>
    @else
        <span class="badge bg-secondary">-</span>
    @endif
</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.dokter.edit', $d->id_dokter) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                {{-- Delete --}}
                                <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $d->id_dokter }}">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>

                            </div>
                        </td>
                    </tr>

                    {{-- Modal Delete --}}
                    <div class="modal fade" id="deleteModal{{ $d->id_dokter }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Hapus data dokter <b>{{ $d->nama_user }}</b>  
                                    (Bidang: <b>{{ $d->bidang_dokter }}</b>)?
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                    <form action="{{ route('admin.dokter.delete', $d->id_dokter) }}"
                                          method="GET">
                                        @csrf
                                        <button class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">
                            Belum ada data dokter.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection
