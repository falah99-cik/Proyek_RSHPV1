@extends('layouts.lte.main')

@section('content')

<div class="container-fluid px-4 pt-2 mt-3">
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Jenis Hewan</h4>
        <a href="{{ route('admin.jenis_hewan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Jenis Hewan
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <form method="GET" class="d-flex">
                <input type="text" name="q" value="{{ $q }}" 
                       class="form-control me-2" placeholder="Cari jenis hewan...">
                <button class="btn btn-secondary"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="60px">No</th>
                        <th>Nama Jenis Hewan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($jenis as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}
                            </td>
                            <td>{{ $item->nama_jenis_hewan }}</td>
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

        <div class="card-footer">
            {{ $jenis->links() }}
        </div>
    </div>

</div>

@endsection
