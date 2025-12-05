@extends('layouts.lte.main')

@section('title', 'Edit Detail Rekam Medis')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Detail Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Detail RM</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.detail_rm.update', data_get($data,'iddetail_rekam_medis')) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="idrekam_medis" value="{{ data_get($data,'idrekam_medis') }}">

                <div class="mb-3">
                    <label class="form-label">Tindakan Terapi</label>
                    <select class="form-control" name="idkode_tindakan_terapi">
                        @foreach ($tindakan as $t)
                            <option value="{{ data_get($t,'idkode_tindakan_terapi') }}"
                                {{ data_get($t,'idkode_tindakan_terapi') == data_get($data,'idkode_tindakan_terapi') ? 'selected' : '' }}>
                                {{ data_get($t,'deskripsi_tindakan_terapi') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail Tambahan</label>
                    <textarea class="form-control" name="detail" rows="3">{{ data_get($data,'detail') }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.detail_rm.index', data_get($data,'idrekam_medis')) }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
