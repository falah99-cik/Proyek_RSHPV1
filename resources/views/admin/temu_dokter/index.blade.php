@extends('layouts.lte.main')

@section('title', 'Temu Dokter')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Temu Dokter</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Temu Dokter</h4>

        <a href="{{ route('admin.temu_dokter.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Temu Dokter
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
                        <th width="50px">No</th>
                        <th width="150px">No Urut</th>
                        <th>Pet</th>
                        <th>Dokter Pemeriksa</th>
                        <th width="120px">Status</th>
                        <th width="180px">Waktu Daftar</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-bold text-center">{{ $item->no_urut }}</td>
                            <td>{{ $item->nama_pet }}</td>
                            <td>{{ $item->nama_dokter }}</td>

                            {{-- STATUS --}}
                            <td class="text-center">
                                @if($item->status == '0')
                                    <span class="badge bg-secondary">Menunggu</span>
                                @elseif ($item->status == '1')
                                    <span class="badge bg-warning">Diproses Perawat</span>
                                @elseif ($item->status == '2')
                                    <span class="badge bg-info">Menunggu Dokter</span>
                                @elseif ($item->status == '3')
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>

                            <td>{{ $item->waktu_daftar }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.temu_dokter.edit', $item->idreservasi_dokter) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.temu_dokter.destroy', $item->idreservasi_dokter) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Belum ada data temu dokter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
