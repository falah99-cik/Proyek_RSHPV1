@extends('layouts.lte.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lengkapi Profil Dokter</h3>
                </div>

                <form action="{{ route('dokter.profil.store') }}" method="POST">
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
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Bidang Dokter</label>
                            <input type="text"
                                name="bidang_dokter"
                                value="{{ old('bidang_dokter') }}"
                                class="form-control @error('bidang_dokter') is-invalid @enderror"
                                required>
                            @error('bidang_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary">
                            Simpan Profil
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection
