@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Kategori Klinis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Kategori Klinis</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- TITLE + BUTTON --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Kategori Klinis</h4>

        <a href="{{ route('admin.kategori_klinis.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kategori Klinis
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
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="60px">No</th>
                        <th>Nama Kategori Klinis</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kategoriKlinis as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kategori_klinis }}</td>
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

        {{-- PAGINATION (optional) --}}
        @if(method_exists($kategoriKlinis, 'links'))
        <div class="card-footer">
            {{ $kategoriKlinis->links() }}
        </div>
        @endif
    </div>

</div>

@endsection
