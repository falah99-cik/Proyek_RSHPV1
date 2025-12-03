@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    
    <div class="col-sm-6">
        <h3 class="mb-0">Role</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Role</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Header Title + Add Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Role</h4>

        <a href="{{ route('admin.role.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Role
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
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
                        <th width="60px">No</th>
                        <th>Nama Role</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($role as $r)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $r->nama_role }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.role.edit', $r->idrole) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- Delete --}}
                                    <button 
                                        class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $r->idrole }}">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>

                        {{-- Modal Delete --}}
                        <div class="modal fade" id="deleteModal{{ $r->idrole }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus role 
                                        <b>{{ $r->nama_role }}</b>?
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                        <form action="{{ route('admin.role.destroy', $r->idrole) }}" method="POST">
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
                                Belum ada data role.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        {{-- Pagination support --}}
        @if(method_exists($role, 'links'))
        <div class="card-footer">
            {{ $role->links() }}
        </div>
        @endif

    </div>

</div>

@endsection
