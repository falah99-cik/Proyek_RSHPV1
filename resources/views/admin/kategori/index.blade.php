@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Kategori</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Kategori</h4>

        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">

        {{-- TABLE --}}
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="60">No</th>
                        <th>Nama Kategori</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kategori as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kategori }}</td>

                            <td class="text-center">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.kategori.edit', $item->idkategori) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- DELETE BUTTON --}}
                                <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $item->idkategori }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </td>
                        </tr>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="modalDelete{{ $item->idkategori }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Yakin ingin menghapus kategori
                                        <b>{{ $item->nama_kategori }}</b>?
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                                            Batal
                                        </button>

                                        <form method="POST"
                                              action="{{ route('admin.kategori.destroy', $item->idkategori) }}">
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
                            <td colspan="3" class="text-center text-muted py-3">
                                Belum ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION (opsional jika pakai paginate) --}}
        @if(method_exists($kategori, 'links'))
            <div class="card-footer">
                {{ $kategori->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
