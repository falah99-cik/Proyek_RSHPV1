@extends('layouts.lte.main')

@section('title', 'Tambah Detail Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Tambah Detail RM</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dokter.detail_rm.index', $rekam->idrekam_medis) }}">Detail RM</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>

</div>
@endsection


@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('dokter.detail_rm.store') }}" method="POST">
                @csrf

                <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}">

                {{-- Tindakan --}}
                <div class="mb-3">
                    <label class="form-label">Tindakan</label>
                    <select name="idkode_tindakan_terapi" class="form-control" required>
                        <option value="">-- Pilih Tindakan --</option>
                        @foreach ($tindakan as $t)
                        <option value="{{ $t->idkode_tindakan_terapi }}">
                            {{ $t->deskripsi_tindakan_terapi }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Detail --}}
                <div class="mb-3">
                    <label class="form-label">Detail</label>
                    <textarea class="form-control" name="detail" rows="3"></textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('dokter.detail_rm.index', $rekam->idrekam_medis) }}" 
                       class="btn btn-secondary">Kembali</a>

                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
