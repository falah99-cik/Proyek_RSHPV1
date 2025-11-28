@extends('layouts.app')

@section('content')

<h2>Tambah Ras Hewan</h2>

<form action="{{ route('admin.ras_hewan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Ras Hewan</label>
        <input type="text" name="nama_ras" class="form-control" value="{{ old('nama_ras') }}">

        @error('nama_ras')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Jenis Hewan</label>
        <select name="idjenis_hewan" class="form-control">
            <option value="">-- Pilih Jenis Hewan --</option>
            @foreach ($jenisHewan as $item)
                <option value="{{ $item->idjenis_hewan }}"
                    {{ old('idjenis_hewan') == $item->idjenis_hewan ? 'selected' : '' }}>
                    {{ $item->nama_jenis_hewan }}
                </option>
            @endforeach
        </select>

        @error('idjenis_hewan')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection
