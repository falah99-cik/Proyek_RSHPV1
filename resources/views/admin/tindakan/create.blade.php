@extends('layout.main')

@section('content')

<h2>Tambah Kode Tindakan Terapi</h2>

<form action="{{ route('admin.tindakan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Kode Tindakan</label>
        <input type="text" name="kode" class="form-control" value="{{ old('kode') }}">

        @error('kode')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Deskripsi Tindakan</label>
        <textarea name="deskripsi_tindakan_terapi" class="form-control">{{ old('deskripsi_tindakan_terapi') }}</textarea>

        @error('deskripsi_tindakan_terapi')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <select name="idkategori" class="form-control">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $item)
                <option value="{{ $item->idkategori }}"
                    {{ old('idkategori') == $item->idkategori ? 'selected' : '' }}>
                    {{ $item->nama_kategori }}
                </option>
            @endforeach
        </select>

        @error('idkategori')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Kategori Klinis</label>
        <select name="idkategori_klinis" class="form-control">
            <option value="">-- Pilih Kategori Klinis --</option>
            @foreach ($kategoriKlinis as $item)
                <option value="{{ $item->idkategori_klinis }}"
                    {{ old('idkategori_klinis') == $item->idkategori_klinis ? 'selected' : '' }}>
                    {{ $item->nama_kategori_klinis }}
                </option>
            @endforeach
        </select>

        @error('idkategori_klinis')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
