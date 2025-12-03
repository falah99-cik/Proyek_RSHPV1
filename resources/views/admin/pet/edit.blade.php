@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Pet</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Pet</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Pet</label>
                    <input type="text" name="nama" value="{{ $pet->nama }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ $pet->tanggal_lahir }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Warna / Tanda</label>
                    <input type="text" name="warna_tanda" value="{{ $pet->warna_tanda }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="J" {{ $pet->jenis_kelamin == 'J' ? 'selected' : '' }}>Jantan</option>
                        <option value="B" {{ $pet->jenis_kelamin == 'B' ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ras Hewan</label>
                    <select name="idras_hewan" class="form-control">
                        @foreach($ras as $r)
                            <option value="{{ $r->idras_hewan }}" 
                                {{ $pet->idras_hewan == $r->idras_hewan ? 'selected' : '' }}>
                                {{ $r->nama_ras }} ({{ $r->jenisHewan->nama_jenis_hewan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pemilik</label>
                    <select name="idpemilik" class="form-control">
                        @foreach($pemilik as $pm)
                            <option value="{{ $pm->idpemilik }}"
                                {{ $pet->idpemilik == $pm->idpemilik ? 'selected' : '' }}>
                                {{ $pm->user->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
