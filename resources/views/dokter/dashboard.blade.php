@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Dashboard Dokter
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Reservasi Temu Dokter</div>
                                <h3 class="fw-bold">{{ $jumlahReservasi }}</h3>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Rekam Medis</div>
                                <h3 class="fw-bold">{{ $jumlahRekamMedis }}</h3>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Jumlah Pasien (Pet)</div>
                                <h3 class="fw-bold">{{ $jumlahPasien }}</h3>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Tindakan Terapi</div>
                                <h3 class="fw-bold">{{ $jumlahTindakan }}</h3>
                            </div>
                        </div>
                    
                    <hr class="my-4">

<h5 class="fw-bold mb-3">Daftar Antrian Pasien</h5>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>No Urut</th>
            <th>Nama Pet</th>
            <th>Waktu Daftar</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($antrian as $row)
            <tr>
                <td>{{ $row->no_urut }}</td>
                <td>{{ $row->pet->nama }}</td>
                <td>{{ $row->waktu_daftar }}</td>
            </tr>
        @endforeach

        @if ($antrian->count() == 0)
            <tr>
                <td colspan="3" class="text-center text-muted">
                    Tidak ada antrian saat ini.
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
</div>
@endsection
