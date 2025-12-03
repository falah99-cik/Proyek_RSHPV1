@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Ras Hewan</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ras Hewan</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- Header Title + Add Button --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Ras Hewan</h4>

        <a href="{{ route('admin.ras_hewan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Ras Hewan
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
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rasHewan as $r)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $r->nama_ras }}</td>
                            <td>{{ $r->jenisHewan->nama_jenis_hewan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                Belum ada data ras hewan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if(method_exists($rasHewan, 'links'))
        <div class="card-footer">
            {{ $rasHewan->links() }}
        </div>
        @endif

    </div>

</div>

@endsection
