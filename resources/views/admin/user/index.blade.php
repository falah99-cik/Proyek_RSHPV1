@extends('layouts.lte.main')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">User</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar User</h4>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah User
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60px">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $u)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>{{ $u->nama }}</td>
                            <td>{{ $u->email }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.user.edit', $u->iduser) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <button class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $u->iduser }}">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </div>
                            </td>

                        </tr>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="deleteModal{{ $u->iduser }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus user:
                                        <br><b>{{ $u->nama }}</b> ?
                                    </div>

                                    <div class="modal-footer">

                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                        <form action="{{ route('admin.user.destroy', $u->iduser) }}"
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
                            <td colspan="4" class="text-center text-muted py-3">
                                Tidak ada data user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="card-footer">
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection
