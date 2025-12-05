@extends('layouts.lte.main')

@section('title', 'Tambah Detail Rekam Medis')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Detail Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.detail_rm.index', $rekam->idrekam_medis) }}">Detail RM</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.detail_rm.store') }}" method="POST">
                @csrf

                <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}">

                <div class="mb-3">
                    <label class="form-label">Tindakan Terapi</label>
                    <select class="form-control" name="idkode_tindakan_terapi" required>
                        <option value="">-- Pilih Tindakan --</option>
                        @foreach ($tindakan as $t)
                            <option value="{{ $t->idkode_tindakan_terapi }}">
                                {{ $t->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail Tambahan</label>
                    <textarea class="form-control" name="detail" rows="3"></textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.detail_rm.index', $rekam->idrekam_medis) }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
