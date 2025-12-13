@extends('layouts.lte.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lengkapi Profil Perawat</h3>
                </div>

                <form action="{{ route('perawat.profil.store') }}" method="POST">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text"
                                class="form-control"
                                value="{{ auth()->user()->nama }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                class="form-control"
                                value="{{ auth()->user()->email }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap"
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>No Handphone</label>
                            <input type="text"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                placeholder="08xxxxxxxxxx"
                                required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input type="text"
                                name="pendidikan"
                                value="{{ old('pendidikan') }}"
                                class="form-control @error('pendidikan') is-invalid @enderror"
                                placeholder="Contoh: D3 Keperawatan / S1 Keperawatan"
                                required>
                            @error('pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            Simpan Profil
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection
