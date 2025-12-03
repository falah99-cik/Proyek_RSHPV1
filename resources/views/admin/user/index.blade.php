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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar User</h4>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah User
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60px">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $u)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->email }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>

</div>

@endsection
