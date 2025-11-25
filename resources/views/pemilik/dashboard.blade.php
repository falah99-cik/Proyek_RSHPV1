@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Dashboard Pemilik
                </div>

                <div class="card-body">

                    <div class="mb-4">
                        <h5 class="fw-bold">Halo, {{ $pemilik->nama_pemilik ?? 'Pengguna' }}</h5>
                        <p class="text-muted">Berikut data hewan peliharaan Anda:</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Jumlah Hewan Peliharaan</div>
                                <h3 class="fw-bold">{{ $jumlahPet }}</h3>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3">Daftar Hewan Peliharaan</h5>

                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pet</th>
                                <th>Jenis</th>
                                <th>Ras</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pets as $pet)
                                <tr>
                                    <td>{{ $pet->nama }}</td>
                                    <td>{{ $pet->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
<td>{{ $pet->rasHewan->nama_ras ?? '-' }}</td>
                                </tr>
                            @endforeach

                            @if ($pets->count() === 0)
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Anda belum memiliki data pet.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
