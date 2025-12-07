@extends('layouts.lte.main')

@section('title', 'Tambah Pet')

@section('content-header')
<div class="row">
    <div class="col-sm-6">
        <h3>Tambah Pet</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.pet.index') }}">Pet</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('resepsionis.pet.store') }}" method="POST">
                        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @csrf

            <div class="mb-3">
                <label>Nama Pet</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>

            <div class="mb-3">
                <label>Warna/Tanda</label>
                <input type="text" name="warna_tanda" class="form-control">
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="J">Jantan</option>
                    <option value="B">Betina</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Pemilik</label>
                <select name="idpemilik" class="form-control">
            @foreach ($pemilik as $p)
                <option value="{{ data_get($p, 'idpemilik') }}">
                    {{ data_get($p, 'user.nama') }}
                </option>
            @endforeach
</select>

            </div>

            <div class="mb-3">
                <label>Ras Hewan</label>
                <select name="idras_hewan" class="form-control">
                @foreach ($ras as $r)
                    <option value="{{ data_get($r, 'idras_hewan') }}">
                        {{ data_get($r, 'nama_ras') }}
                    </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>

        </form>

    </div>
</div>
@endsection
