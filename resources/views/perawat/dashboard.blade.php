@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Dashboard Perawat
                </div>

                <div class="card-body">

                    <div class="row g-3 mb-4">

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Jumlah Rekam Medis</div>
                                <h3 class="fw-bold">{{ $jumlahRekamMedis }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Jumlah Pasien</div>
                                <h3 class="fw-bold">{{ $jumlahPasien }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Tindakan Terapi</div>
                                <h3 class="fw-bold">{{ $jumlahTindakan }}</h3>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3">10 Rekam Medis Terbaru</h5>

                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Hewan</th>
                                <th>Anamnesa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rekamMedisBaru as $rm)
                                <tr>
                                    <td>{{ $rm->created_at }}</td>
                                    <td>{{ $rm->pet->nama ?? '-' }}</td>
                                    <td>{{ Str::limit($rm->anamnesa, 40) }}</td>
                                </tr>
                            @endforeach

                            @if ($rekamMedisBaru->count() == 0)
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada rekam medis.
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
