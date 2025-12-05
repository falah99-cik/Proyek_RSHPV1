@extends('layouts.lte.main')

@section('title', 'Edit Rekam Medis')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Edit Rekam Medis</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.rekam_medis.index') }}">Rekam Medis</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>

</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.rekam_medis.update', data_get($data, 'idrekam_medis')) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- PET --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Pet</label>
                    <select class="form-control" name="idpet">
                        @foreach ($pet as $p)
                            <option value="{{ data_get($p, 'idpet') }}"
                                {{ data_get($p, 'idpet') == data_get($data, 'idpet') ? 'selected' : '' }}>
                                {{ data_get($p, 'nama') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- DOKTER --}}
                <div class="mb-3">
                    <label class="form-label">Dokter Pemeriksa</label>
                    <select class="form-control" name="dokter_pemeriksa">
                        @foreach ($dokter as $d)
                            <option value="{{ data_get($d, 'idrole_user') }}"
                                {{ data_get($d, 'idrole_user') == data_get($data, 'dokter_pemeriksa') ? 'selected' : '' }}>
                                {{ data_get($d, 'nama') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- TEMU DOKTER --}}
                <div class="mb-3">
                    <label class="form-label">Nomor Urut Temu Dokter</label>
                    <select class="form-control" name="idreservasi_dokter">
                        @foreach ($temu as $t)
                            <option value="{{ data_get($t, 'idreservasi_dokter') }}"
                                {{ data_get($t, 'idreservasi_dokter') == data_get($data, 'idreservasi_dokter') ? 'selected' : '' }}>
                                {{ data_get($t, 'no_urut') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ANAMNESA --}}
                <div class="mb-3">
                    <label class="form-label">Anamnesa</label>
                    <textarea class="form-control" name="anamnesa" rows="3">{{ data_get($data, 'anamnesa') }}</textarea>
                </div>

                {{-- TEMUAN KLINIS --}}
                <div class="mb-3">
                    <label class="form-label">Temuan Klinis</label>
                    <textarea class="form-control" name="temuan_klinis" rows="3">{{ data_get($data, 'temuan_klinis') }}</textarea>
                </div>

                {{-- DIAGNOSA --}}
                <div class="mb-3">
                    <label class="form-label">Diagnosa</label>
                    <textarea class="form-control" name="diagnosa" rows="3">{{ data_get($data, 'diagnosa') }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.rekam_medis.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
