@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Pemilik</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Pemilik</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Header Title + Add Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Pemilik</h4>
        <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Pemilik
        </a>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Pemilik</th>
                        <th>Nomor WA</th>
                        <th>Alamat</th>
                        <th>Email User</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pemilik as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $p->user->nama ?? '-' }}</td>
                            <td>{{ $p->no_wa }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->user->email ?? '-' }}</td>

                            {{-- ACTION BUTTONS --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.pemilik.edit', $p->idpemilik) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $p->idpemilik }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="deleteModal{{ $p->idpemilik }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus pemilik  
                                        <b>{{ $p->user->nama ?? '-' }}</b>?
                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Batal
                                        </button>

                                        <form action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger">Hapus</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                Belum ada data pemilik.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        @if(method_exists($pemilik, 'links'))
        <div class="card-footer">
            {{ $pemilik->links() }}
        </div>
        @endif

    </div>

</div>

@endsection
