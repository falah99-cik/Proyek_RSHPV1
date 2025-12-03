@extends('layouts.lte.main')

@section('content-header')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Jenis Hewan</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Jenis Hewan</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Daftar Jenis Hewan</h4>
    <a href="{{ route('admin.jenis_hewan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Jenis Hewan
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex">
            <input type="text" name="q" value="{{ $q }}" class="form-control me-2"
                   placeholder="Cari jenis hewan...">
            <button class="btn btn-secondary"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr class="text-center">
                    <th width="60px">No</th>
                    <th>Nama Jenis Hewan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($jenis as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}</td>
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

    <div class="card-footer">
        {{ $jenis->links() }}
    </div>
</div>

@endsection
