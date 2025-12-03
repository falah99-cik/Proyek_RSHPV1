@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Kode Tindakan Terapi</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tindakan Terapi</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- HEADER TITLE + BUTTON --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Kode Tindakan Terapi</h4>

        <a href="{{ route('admin.tindakan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Tindakan Terapi
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60">No</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Kategori Klinis</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($tindakan as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>{{ $item->kategoriKlinis->nama_kategori_klinis }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.tindakan.edit', $item->idkode_tindakan_terapi) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- Delete --}}
                                    <button 
                                        class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->idkode_tindakan_terapi }}">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- DELETE MODAL --}}
                        <div class="modal fade" id="deleteModal{{ $item->idkode_tindakan_terapi }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus tindakan:
                                        <br>
                                        <b>{{ $item->kode }} - {{ $item->deskripsi_tindakan_terapi }}</b>?
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                        <form action="{{ route('admin.tindakan.destroy', $item->idkode_tindakan_terapi) }}" 
                                              method="POST">
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
                                Belum ada data tindakan terapi.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if(method_exists($tindakan, 'links'))
            <div class="card-footer">
                {{ $tindakan->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
