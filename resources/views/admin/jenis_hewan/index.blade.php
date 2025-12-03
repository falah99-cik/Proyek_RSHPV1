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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenis as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}
                            </td>
                            <td>{{ $item->nama_jenis_hewan }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-3">
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

@endsection
