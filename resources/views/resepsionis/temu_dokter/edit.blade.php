@extends('layouts.lte.main')

@section('title', 'Edit Temu Dokter')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Edit Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('resepsionis.temu-dokter.update', data_get($data, 'idreservasi_dokter')) }}" method="POST">
            @csrf @method('PUT')

            {{-- PILIH PET --}}
            <div class="mb-3">
                <label>Pet</label>
                <select name="idpet" class="form-control">
                    @foreach ($pet as $p)
                        <option 
                            value="{{ data_get($p, 'idpet') }}"
                            {{ data_get($p, 'idpet') == data_get($data, 'idpet') ? 'selected' : '' }}
                        >
                            {{ data_get($p, 'nama') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PILIH PERAWAT --}}
            <div class="mb-3">
                <label>Perawat</label>
                <select name="idrole_user" class="form-control">
                    @foreach ($perawat as $pr)
                        <option 
                            value="{{ data_get($pr, 'idrole_user') }}"
                            {{ data_get($pr, 'idrole_user') == data_get($data, 'idrole_user') ? 'selected' : '' }}
                        >
                            {{ data_get($pr, 'user.nama') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STATUS --}}
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ data_get($data, 'status') == 1 ? 'selected' : '' }}>Menunggu</option>
                    <option value="0" {{ data_get($data, 'status') == 0 ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>

        </form>

    </div>
</div>

@endsection
