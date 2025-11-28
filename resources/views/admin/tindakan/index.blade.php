@extends('layout.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Kode Tindakan Terapi</h2>
    <a href="{{ route('admin.tindakan.create') }}" class="btn btn-primary">
        + Tambah Tindakan Terapi
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mt-3">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="50px">No</th>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Kategori Klinis</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tindakan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->kategoriKlinis->nama_kategori_klinis }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
