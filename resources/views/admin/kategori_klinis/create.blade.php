@extends('layout.main')

@section('content')

<h2>Tambah Kategori Klinis</h2>

<form action="{{ route('admin.kategori_klinis.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kategori Klinis</label>
        <input type="text" name="nama_kategori_klinis" class="form-control" value="{{ old('nama_kategori_klinis') }}">

        @error('nama_kategori_klinis')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection
