@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Tambah Pemilik</h2>
    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Perhatian!</strong> Periksa kembali input Anda.
    </div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.pemilik.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pilih User</label>
                <select class="form-control" name="iduser">
                    <option value="">-- Pilih User --</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->iduser }}" {{ old('iduser') == $u->iduser ? 'selected' : '' }}>
                            {{ $u->nama }} ({{ $u->email }})
                        </option>
                    @endforeach
                </select>
                @error('iduser')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor WA</label>
                <input type="text" class="form-control" name="no_wa" value="{{ old('no_wa') }}">
                @error('no_wa')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary mt-2">Simpan</button>

        </form>

    </div>
</div>

@endsection
