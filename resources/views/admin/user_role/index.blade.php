@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">User Role</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">User Role</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- HEADER TITLE + BUTTON --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar User Role</h4>

        <a href="{{ route('admin.user_role.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah User Role
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
                        <th>Nama User</th>
                        <th>Email User</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($roleUser as $ru)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $ru->user->nama }}</td>
                            <td>{{ $ru->user->email }}</td>
                            <td>{{ $ru->role->nama_role }}</td>
                            <td class="text-center">

                                @if ($ru->status == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Belum ada data user role.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if(method_exists($roleUser, 'links'))
        <div class="card-footer">
            {{ $roleUser->links() }}
        </div>
        @endif

    </div>

</div>

@endsection
