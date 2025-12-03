@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Jenis Hewan</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Jenis Hewan</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Header Title + Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Jenis Hewan</h4>

        <a href="{{ route('admin.jenis_hewan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Jenis Hewan
        </a>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card --}}
    <div class="card shadow-sm">

        {{-- Search --}}
        <div class="card-header bg-white">
            <form method="GET" class="d-flex">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $q }}"
                    class="form-control me-2"
                    placeholder="Cari jenis hewan..."
                >
                <button class="btn btn-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="60">No</th>
                        <th>Nama Jenis Hewan</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($jenis as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}
                            </td>

                            <td>{{ $item->nama_jenis_hewan }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.jenis_hewan.edit', $item->idjenis_hewan) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- Delete (trigger modal) --}}
                                    <button 
                                        class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->idjenis_hewan }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                Belum ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="card-footer">
            {{ $jenis->links() }}
        </div>

    </div>
</div>

{{-- MODALS DELETE --}}
@foreach ($jenis as $item)
<div class="modal fade" id="deleteModal{{ $item->idjenis_hewan }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Apakah Anda yakin ingin menghapus
                <b>{{ $item->nama_jenis_hewan }}</b>?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('admin.jenis_hewan.destroy', $item->idjenis_hewan) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>

            </div>

        </div>
    </div>
</div>
@endforeach

@endsection
