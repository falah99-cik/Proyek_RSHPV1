@extends('layout.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Pemilik</h2>
    <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary">+ Tambah Pemilik</a>
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
                    <th>Nama Pemilik</th>
                    <th>Nomor WA</th>
                    <th>Alamat</th>
                    <th>Email User</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data pemilik.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
