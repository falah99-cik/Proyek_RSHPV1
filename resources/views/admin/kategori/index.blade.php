@extends('layouts.lte.main')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Kategori</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Kategori</h4>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="60px">No</th>
                        <th>Nama Kategori</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kategori as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-3">
                                Belum ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        @if(method_exists($kategori, 'links'))
        <div class="card-footer">
            {{ $kategori->links() }}
        </div>
        @endif

    </div>

</div>

@endsection
