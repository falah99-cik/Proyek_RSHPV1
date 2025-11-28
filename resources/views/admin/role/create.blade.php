@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Tambah Role</h2>
    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Perhatian!</strong> Periksa kembali input Anda.
    </div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.role.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Role</label>
                <input type="text" class="form-control" name="nama_role" value="{{ old('nama_role') }}">

                @error('nama_role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary mt-2">Simpan</button>

        </form>

    </div>
</div>

@endsection
