@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Data Perawat</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Perawat</li>
        </ol>
    </div>

</div>
@endsection


@section('content')
<div class="container-fluid px-4 mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Perawat</h4>

        <a href="{{ route('admin.perawat.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Perawat
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
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Jenis Kelamin</th>
                        <th>Pendidikan</th>
                        <th>User</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($perawat as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>

                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->no_hp }}</td>

                        {{-- Kondisi Jenis Kelamin --}}
                        <td class="text-center">
                            @if($p->jenis_kelamin == 'L')
                                <span class="badge bg-primary">Laki-laki</span>
                            @elseif($p->jenis_kelamin == 'P')
                                <span class="badge bg-pink" style="background-color:#d63384;">Perempuan</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>

                        <td>{{ $p->pendidikan }}</td>

                        <td>{{ $p->nama_user }}</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.perawat.edit', $p->id_perawat) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                {{-- Delete --}}
                                <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $p->id_perawat }}">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>

                            </div>
                        </td>
                    </tr>

                    {{-- Modal Delete --}}
                    <div class="modal fade" id="deleteModal{{ $p->id_perawat }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Hapus data perawat <b>{{ $p->nama_user }}</b>?
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                    <form action="{{ route('admin.perawat.delete', $p->id_perawat) }}"
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
                            Belum ada data perawat.
                        </td>
                    </tr>

                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
