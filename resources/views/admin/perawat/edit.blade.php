@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6"><h3 class="mb-0">Edit Perawat</h3></div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.perawat.index') }}">Perawat</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-header"><h4 class="mb-0">Form Edit Perawat</h4></div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Periksa kembali input anda.</strong>
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.perawat.update', $perawat->id_perawat) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat"
                               value="{{ old('alamat', $perawat->alamat) }}"
                               class="form-control @error('alamat') is-invalid @enderror" required>
                        @error('alamat')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp"
                               value="{{ old('no_hp', $perawat->no_hp) }}"
                               class="form-control @error('no_hp') is-invalid @enderror" required>
                        @error('no_hp')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pendidikan</label>
                        <input type="text" name="pendidikan"
                               value="{{ old('pendidikan', $perawat->pendidikan) }}"
                               class="form-control @error('pendidikan') is-invalid @enderror" required>
                        @error('pendidikan')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Pilih User (role = Perawat)</label>
                        <select name="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                            <option value="">-- Pilih User --</option>
                            @foreach($user as $u)
                                <option value="{{ $u->iduser }}" {{ old('id_user', $perawat->id_user) == $u->iduser ? 'selected' : '' }}>
                                    {{ $u->nama }} — {{ $u->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.perawat.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                    <button class="btn btn-primary"><i class="bi bi-check2-circle"></i> Update</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
