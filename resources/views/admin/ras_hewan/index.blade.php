@extends('layout.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Ras Hewan</h2>
    <a href="{{ route('admin.ras_hewan.create') }}" class="btn btn-primary">
        + Tambah Ras Hewan
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mt-3">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="50px">No</th>
                    <th>Nama Ras</th>
                    <th>Jenis Hewan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($rasHewan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_ras }}</td>
                        <td>{{ $item->jenisHewan->nama_jenis_hewan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
