@extends('layout.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Tambah User Role</h2>
    <a href="{{ route('admin.user_role.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Perhatian!</strong> Periksa kembali input Anda.
    </div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.user_role.store') }}" method="POST">
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
                <label class="form-label">Pilih Role</label>
                <select class="form-control" name="idrole">
                    <option value="">-- Pilih Role --</option>
                    @foreach ($role as $r)
                        <option value="{{ $r->idrole }}" {{ old('idrole') == $r->idrole ? 'selected' : '' }}>
                            {{ $r->nama_role }}
                        </option>
                    @endforeach
                </select>
                @error('idrole')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-control" name="status">
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button class="btn btn-primary mt-2">Simpan</button>

        </form>

    </div>
</div>

@endsection
