@extends('layout.main')

@section('content')

<h2>Tambah Kategori</h2>

<form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}">

        @error('nama_kategori')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

@endsection
