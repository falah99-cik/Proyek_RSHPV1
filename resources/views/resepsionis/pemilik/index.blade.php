@extends('layouts.lte.main')

@section('title', 'Data Pemilik')

@section('content-header')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0">Data Pemilik</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pemilik</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-primary btn-sm">
            + Tambah Pemilik
        </a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No WA</th>
                    <th>Alamat</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemilik as $p)
                <tr>
                    <td>{{ data_get($p, 'user.nama') }}</td>
                    <td>{{ data_get($p, 'user.email') }}</td>
                    <td>{{ data_get($p, 'no_wa') }}</td>
                    <td>{{ data_get($p, 'alamat') }}</td>
                    <td>
                        <a href="{{ route('resepsionis.pemilik.edit', data_get($p, 'idpemilik')) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form 
                            action="{{ route('resepsionis.pemilik.destroy', data_get($p, 'idpemilik')) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus?')"
                        >
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
