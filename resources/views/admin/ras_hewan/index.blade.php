@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Ras Hewan</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Ras Hewan</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Ras Hewan</h4>

        <a href="{{ route('admin.ras_hewan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Ras Hewan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-header bg-white">
            <form method="GET" class="d-flex">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $q }}" 
                    class="form-control me-2"
                    placeholder="Cari ras atau jenis hewan..."
                >
                <button class="btn btn-secondary"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60px">No</th>
                        <th width="200px">Jenis Hewan</th>
                        <th>Ras Hewan</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @php $no = 1; @endphp

                    @forelse ($grouped as $jenis => $listRas)

                        @php 
                            $rowspan = $listRas->count(); 
                        @endphp

                        @foreach ($listRas as $i => $ras)
                            <tr>

                                {{-- No --}}
                                <td class="text-center">{{ $no++ }}</td>

                                {{-- Jenis sekali --}}
                                @if ($i == 0)
                                    <td class="text-center align-middle" rowspan="{{ $rowspan }}">
                                        <b>{{ $jenis }}</b>
                                    </td>
                                @endif

                                {{-- Ras --}}
                                <td>{{ $ras->nama_ras }}</td>

                                {{-- Aksi --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.ras_hewan.edit', $ras->idras_hewan) }}"
                                        class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <button 
                                            class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $ras->idras_hewan }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>

                                    </div>
                                </td>

                            </tr>

                            {{-- Modal Delete --}}
                            <div class="modal fade" id="deleteModal{{ $ras->idras_hewan }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            Hapus ras <b>{{ $ras->nama_ras }}</b>?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <form action="{{ route('admin.ras_hewan.destroy', $ras->idras_hewan) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                Belum ada data ras hewan.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

    </div>

</div>

@endsection
