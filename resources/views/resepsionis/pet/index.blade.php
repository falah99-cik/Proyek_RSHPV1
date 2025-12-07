@extends('layouts.lte.main')

@section('title', 'Data Pet')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Data Pet</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pet</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-primary btn-sm">
            + Tambah Pet
        </a>
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
                    <th>Nama Pet</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Pemilik</th>
                    <th>Ras</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pet as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>
                        @php
                            $lahir = \Carbon\Carbon::parse(data_get($p, 'tanggal_lahir'));
                            $umur = $lahir->diff(\Carbon\Carbon::now());
                        @endphp

                        {{ $umur->y }} Tahun {{ $umur->m }} Bulan
                    </td>
                    <td>
                        @if (data_get($p, 'jenis_kelamin') == 'J')
                            <span class="badge bg-primary">Jantan</span>
                        @else
                            <span class="badge bg-danger">Betina</span>
                        @endif
                    </td>
                    <td>{{ $p->pemilik->user->nama }}</td>
                    <td>{{ $p->ras->nama_ras }}</td>
                    <td>
                        <a href="{{ route('resepsionis.pet.edit', $p->idpet) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('resepsionis.pet.destroy', $p->idpet) }}"
                              method="POST" class="d-inline" onsubmit="return confirm('Hapus data?')">
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
