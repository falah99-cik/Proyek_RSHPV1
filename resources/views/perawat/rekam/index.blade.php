@extends('layouts.lte.main')

@section('title', 'Rekam Medis')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Rekam Medis</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Rekam Medis</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">

    <div class="card-body table-responsive">

        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID RM</th>
                    <th>Pet</th>
                    <th>Anamnesa</th>
                    <th>Temuan Klinis</th>
                    <th>Diagnosa</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rm as $r)
                <tr>
                    <td>{{ $r->idrekam_medis }}</td>
                    <td>{{ $r->pet->nama }}</td>
                    <td>{{ Str::limit($r->anamnesa, 20) }}</td>
                    <td>{{ Str::limit($r->temuan_klinis, 20) }}</td>
                    <td>{{ Str::limit($r->diagnosa, 20) }}</td>

                    <td>
                        <a href="{{ route('perawat.rekam.edit', $r->idrekam_medis) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('perawat.rekam.destroy', $r->idrekam_medis) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus RM?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada Rekam Medis</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection
