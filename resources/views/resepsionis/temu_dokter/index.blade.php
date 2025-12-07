@extends('layouts.lte.main')

@section('title', 'Temu Dokter')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Temu Dokter</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary btn-sm">+ Tambah Temu Dokter</a>
    </div>

    <div class="card-body table-responsive">
                @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Pet</th>
                    <th>Perawat</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td>{{ $d->no_urut }}</td>
                    <td>{{ $d->pet->nama }}</td>
                    <td>{{ $d->roleUser->user->nama }}</td>
                    <td>
                        @if (data_get($d, 'status') == 0)
                            <span class="badge bg-warning">Menunggu</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('resepsionis.temu-dokter.edit', $d->idreservasi_dokter) }}" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('resepsionis.temu-dokter.destroy', $d->idreservasi_dokter) }}"
                              method="POST" class="d-inline" 
                              onsubmit="return confirm('Hapus data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
