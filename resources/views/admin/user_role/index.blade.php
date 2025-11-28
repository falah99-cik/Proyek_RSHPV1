@extends('layout.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar User Role</h2>
    <a href="{{ route('admin.user_role.create') }}" class="btn btn-primary">+ Tambah User Role</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>No</th>
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
                        <td>
                            @if ($ru->status == 1)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data user role.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
