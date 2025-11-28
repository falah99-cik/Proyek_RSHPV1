@extends('layouts.app')

@section('content')

<h2>Tambah Pet</h2>

<form action="{{ route('admin.pet.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Pet</label>
        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
        @error('nama')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
        @error('tanggal_lahir')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Warna / Tanda</label>
        <input type="text" class="form-control" name="warna_tanda" value="{{ old('warna_tanda') }}">
        @error('warna_tanda')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select class="form-control" name="jenis_kelamin">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
            <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
        </select>
        @error('jenis_kelamin')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Ras Hewan</label>
        <select class="form-control" name="idras_hewan">
            <option value="">-- Pilih Ras Hewan --</option>
            @foreach ($ras as $r)
                <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan') == $r->idras_hewan ? 'selected' : '' }}>
                    {{ $r->nama_ras }} ({{ $r->jenisHewan->nama_jenis_hewan }})
                </option>
            @endforeach
        </select>
        @error('idras_hewan')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Pemilik</label>
        <select class="form-control" name="idpemilik">
            <option value="">-- Pilih Pemilik --</option>
            @foreach ($pemilik as $p)
                <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                    {{ $p->user->nama }}
                </option>
            @endforeach
        </select>
        @error('idpemilik')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>

</form>

@endsection
