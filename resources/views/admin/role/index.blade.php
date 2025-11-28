@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Role</h2>
    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">+ Tambah Role</a>
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
                    <th>Nama Role</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($role as $r)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $r->nama_role }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Belum ada data role.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
