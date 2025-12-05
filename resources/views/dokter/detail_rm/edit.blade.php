@extends('layouts.lte.main')

@section('title', 'Edit Detail Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Edit Detail RM</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Detail RM</li>
        </ol>
    </div>

</div>
@endsection


@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('dokter.detail_rm.update', $detail->iddetail_rekam_medis) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="idrekam_medis" value="{{ $detail->idrekam_medis }}">

                {{-- Tindakan --}}
                <div class="mb-3">
                    <label class="form-label">Tindakan</label>
                    <select name="idkode_tindakan_terapi" class="form-control" required>
                        @foreach ($tindakan as $t)
                            <option value="{{ $t->idkode_tindakan_terapi }}"
                                {{ $t->idkode_tindakan_terapi == $detail->idkode_tindakan_terapi ? 'selected' : '' }}>
                                {{ $t->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Detail --}}
                <div class="mb-3">
                    <label class="form-label">Detail</label>
                    <textarea class="form-control" name="detail" rows="3">{{ $detail->detail }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('dokter.detail_rm.index', $detail->idrekam_medis) }}" 
                       class="btn btn-secondary">Kembali</a>

                    <button class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
