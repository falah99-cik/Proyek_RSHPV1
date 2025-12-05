@extends('layouts.lte.main')

@section('title', 'Dashboard Dokter')

@section('content-header')
<div class="row align-items-center">

    <div class="col-sm-6">
        <h3 class="mb-0">Dashboard Dokter</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="row g-3">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-people-fill text-primary fs-2 me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-1">{{ $jumlah_pasien }}</h5>
                        <p class="text-muted mb-0">Total Pasien Ditangani</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-journal-medical text-success fs-2 me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-1">{{ $jumlah_rm }}</h5>
                        <p class="text-muted mb-0">Total Rekam Medis</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-list-check text-danger fs-2 me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-1">{{ $jumlah_tindakan }}</h5>
                        <p class="text-muted mb-0">Jumlah Tindakan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-hourglass-split text-warning fs-2 me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-1">{{ $jumlah_antrian }}</h5>
                        <p class="text-muted mb-0">Pasien Dalam Antrian</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-warning">
            <h5 class="mb-0 text-dark">
                <i class="bi bi-exclamation-circle me-2"></i>Pasien Belum Diperiksa
            </h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>No Urut</th>
                        <th>Nama Pet</th>
                        <th>Waktu Daftar</th>
                        <th>Status</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pasien_belum as $p)
                        <tr class="text-center">

                            <td><span class="badge bg-warning text-dark">{{ $p->no_urut }}</span></td>

                            <td>{{ $p->nama_pet }}</td>

                            <td>{{ $p->waktu_daftar }}</td>

                            <td>
                                @if ($p->status == 0)
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>

                            <td>
                                @if ($p->rekam_medis_id)
                                    <a href="{{ route('dokter.detail_rm.index', $p->rekam_medis_id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i> Periksa
                                    </a>
                                @else
                                    <span class="badge bg-danger">RM belum dibuat</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-3 text-muted">
                                Tidak ada pasien untuk diperiksa 🎉
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Jadwal Temu Dokter Hari Ini</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>No Urut</th>
                        <th>Nama Pet</th>
                        <th>Waktu Daftar</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($jadwal_hari_ini as $j)
                        <tr class="text-center">

                            <td><span class="badge bg-primary">{{ $j->no_urut }}</span></td>

                            <td>{{ $j->nama_pet }}</td>

                            <td>{{ $j->waktu_daftar }}</td>

                            <td>
                                @if ($j->status == 0)
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3 text-muted">
                                Tidak ada jadwal hari ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <div class="card shadow-sm mt-4 mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Rekam Medis Terbaru</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama Pet</th>
                        <th>Anamnesa</th>
                        <th>Diagnosa</th>
                        <th>Tanggal</th>
                        <th width="130px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rekam_terbaru as $rm)
                        <tr>
                            <td>{{ $rm->nama_pet }}</td>
                            <td>{{ Str::limit($rm->anamnesa, 40) }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 40) }}</td>
                            <td>{{ $rm->created_at }}</td>

                            <td class="text-center">
                                <a href="{{ route('dokter.detail_rm.index', $rm->idrekam_medis) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-3 text-muted">
                                Tidak ada rekam medis terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
