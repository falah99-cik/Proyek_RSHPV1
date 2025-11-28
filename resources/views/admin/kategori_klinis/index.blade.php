@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Kategori Klinis</h2>
    <a href="{{ route('admin.kategori_klinis.create') }}" class="btn btn-primary">
        + Tambah Kategori Klinis
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
                        <td colspan="2" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
