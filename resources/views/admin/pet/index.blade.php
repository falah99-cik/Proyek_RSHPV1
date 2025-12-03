@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Pet</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pet</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- TITLE + BUTTON --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Pet</h4>
        <a href="{{ route('admin.pet.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Pet
        </a>
    </div>

    {{-- SUCCESS ALERT --}}
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
                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>Warna/Tanda</th>
                        <th>Jenis Kelamin</th>
                        <th>Pemilik</th>
                        <th>Ras</th>
                        <th>Jenis Hewan</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pet as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->tanggal_lahir }}</td>
                            <td>{{ $p->warna_tanda }}</td>

                            <td>{{ $p->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td>

                            <td>{{ $p->pemilik->user->nama ?? '-' }}</td>

                            <td>{{ $p->ras->nama_ras }}</td>

                            <td>{{ $p->ras->jenisHewan->nama_jenis_hewan }}</td>

                            {{-- ACTION --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.pet.edit', $p->idpet) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $p->idpet }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>

                                </div>
                            </td>
                        </tr>

                        {{-- MODAL DELETE --}}
                        <div class="modal fade" id="deleteModal{{ $p->idpet }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Yakin ingin menghapus pet <b>{{ $p->nama }}</b>?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                        <form action="{{ route('admin.pet.destroy', $p->idpet) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3">
                                Belum ada data pet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if(method_exists($pet, 'links'))
        <div class="card-footer">
            {{ $pet->links() }}
        </div>
        @endif

    </div>

</div>

@endsection
