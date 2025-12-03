@extends('layouts.lte.main')

@section('title', 'Edit Temu Dokter')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Temu Dokter</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.temu_dokter.index') }}">Temu Dokter</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.temu_dokter.update', $data->idreservasi_dokter) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- No Urut --}}
                <div class="mb-3">
                    <label class="form-label">Nomor Urut</label>
                    <input type="text" class="form-control" value="{{ $data->no_urut }}" disabled>
                </div>

                {{-- Pet --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Pet</label>
                    <select class="form-control" name="idpet">
                        @foreach ($pet as $p)
                            <option value="{{ $p->idpet }}" {{ $p->idpet == $data->idpet ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dokter --}}
                <div class="mb-3">
                    <label class="form-label">Pilih Dokter</label>
                    <select class="form-control" name="idrole_user">
                        @foreach ($dokter as $d)
                            <option value="{{ $d->idrole_user }}"
                                {{ $d->idrole_user == $data->idrole_user ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.temu_dokter.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
