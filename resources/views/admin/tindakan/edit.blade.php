@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Edit Tindakan Terapi</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tindakan.index') }}">Tindakan Terapi</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.tindakan.update', $tindakan->idkode_tindakan_terapi) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- KODE --}}
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input 
                        type="text" 
                        name="kode" 
                        class="form-control"
                        value="{{ old('kode', $tindakan->kode) }}"
                    >
                    @error('kode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi Tindakan</label>
                    <textarea 
                        name="deskripsi_tindakan_terapi" 
                        class="form-control" 
                        rows="3"
                    >{{ old('deskripsi_tindakan_terapi', $tindakan->deskripsi_tindakan_terapi) }}</textarea>

                    @error('deskripsi_tindakan_terapi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="idkategori" class="form-control">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategori as $k)
                            <option value="{{ $k->idkategori }}"
                                {{ $k->idkategori == $tindakan->idkategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                    @error('idkategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- KATEGORI KLINIS --}}
                <div class="mb-3">
                    <label class="form-label">Kategori Klinis</label>
                    <select name="idkategori_klinis" class="form-control">
                        <option value="">-- Pilih Kategori Klinis --</option>

                        @foreach ($kategoriKlinis as $kk)
                            <option value="{{ $kk->idkategori_klinis }}"
                                {{ $kk->idkategori_klinis == $tindakan->idkategori_klinis ? 'selected' : '' }}>
                                {{ $kk->nama_kategori_klinis }}
                            </option>
                        @endforeach
                    </select>

                    @error('idkategori_klinis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.tindakan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
