@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Dashboard Resepsionis
                </div>

                <div class="card-body">

                    <div class="row g-3 mb-4">

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Antrean Hari Ini</div>
                                <h3 class="fw-bold">{{ $jumlahAntreanHariIni }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Jumlah Pasien (Pet)</div>
                                <h3 class="fw-bold">{{ $jumlahPasien }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Jumlah Dokter</div>
                                <h3 class="fw-bold">{{ $jumlahDokter }}</h3>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3">Antrean Temu Dokter Hari Ini</h5>

                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No Urut</th>
                                <th>Nama Hewan</th>
                                <th>Waktu Daftar</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($antrian as $a)
                            <tr>
                                <td>{{ $a->no_urut }}</td>
                                <td>{{ $a->pet->nama ?? '-' }}</td>
                                <td>{{ $a->waktu_daftar }}</td>
                            </tr>
                            @endforeach

                            @if ($antrian->count() == 0)
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada antrean hari ini.
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
