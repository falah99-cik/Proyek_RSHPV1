@extends('layouts.lte.main')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Edit User Role</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user_role.index') }}">User Role</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>

</div>
@endsection


@section('content')

<div class="container-fluid px-4 mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.user_role.update', $userRole->idrole_user) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- USER --}}
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select name="iduser" class="form-control @error('iduser') is-invalid @enderror">
                        <option value="">-- Pilih User --</option>

                        @foreach ($users as $u)
                            <option value="{{ $u->iduser }}"
                                {{ old('iduser', $userRole->iduser) == $u->iduser ? 'selected' : '' }}>
                                {{ $u->nama }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>

                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="idrole" class="form-control @error('idrole') is-invalid @enderror">
                        <option value="">-- Pilih Role --</option>

                        @foreach ($roles as $r)
                            <option value="{{ $r->idrole }}"
                                {{ old('idrole', $userRole->idrole) == $r->idrole ? 'selected' : '' }}>
                                {{ $r->nama_role }}
                            </option>
                        @endforeach
                    </select>

                    @error('idrole')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ old('status', $userRole->status) == 1 ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0" {{ old('status', $userRole->status) == 0 ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </div>

                {{-- BUTTONS --}}
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.user_role.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
