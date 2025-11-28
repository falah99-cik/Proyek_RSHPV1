@extends('layouts.admin')

@section('content')
<h2>Tambah Jenis Hewan</h2>

<form action="{{ route('admin.jenis_hewan.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Jenis Hewan</label>
        <input type="text" name="nama_jenis_hewan" class="form-control" value="{{ old('nama_jenis_hewan') }}">
        @error('nama_jenis_hewan')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="bt btn-primary">Simpan</button>
</form>
@endsection