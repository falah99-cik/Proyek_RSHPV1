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

    {{-- ALERT SUCCESS --}}
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
                            <td colspan="5" class="text-center text-muted py-3">
                                Belum ada data pemilik.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- Pagination jika pakai paginate --}}
        @if(method_exists($pemilik, 'links'))
        <div class="card-footer">
            {{ $pemilik->links() }}
        </div>
        @endif

    </div>

</div>

@endsection
