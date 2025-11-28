@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Pet</h2>
    <a href="{{ route('admin.pet.create') }}" class="btn btn-primary">
        + Tambah Pet
    </a>
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
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Warna/Tanda</th>
                    <th>Jenis Kelamin</th>
                    <th>Pemilik</th>
                    <th>Ras</th>
                    <th>Jenis Hewan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pet as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->tanggal_lahir }}</td>
                        <td>{{ $p->warna_tanda }}</td>

                        <td>
                            {{ $p->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
                        </td>

                        <td>{{ $p->pemilik->user->nama }}</td>

                        <td>{{ $p->ras->nama_ras }}</td>

                        <td>{{ $p->ras->jenisHewan->nama_jenis_hewan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data pet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
