@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Kategori</h2>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        + Tambah Kategori
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
                        <td colspan="2" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
