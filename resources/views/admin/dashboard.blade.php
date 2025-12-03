@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

    {{-- ========================= --}}
    {{-- INFO BOX TOP --}}
    {{-- ========================= --}}
    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary">
                    <i class="bi bi-paw-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pet</span>
                    <span class="info-box-number">{{ $totalPet }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-warning">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Owner</span>
                    <span class="info-box-number">{{ $totalPemilik }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-success">
                    <i class="bi bi-person-vcard-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Dokter</span>
                    <span class="info-box-number">{{ $totalDokter }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-danger">
                    <i class="bi bi-list-ol"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Reservasi Hari Ini</span>
                    <span class="info-box-number">{{ $totalReservasiHariIni }}</span>
                </div>
            </div>
        </div>

    </div>


    {{-- ========================= --}}
    {{-- CARD GRAFIK + STATUS --}}
    {{-- ========================= --}}
    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Monthly Recap Report</h5>
                    <button class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>

                <div class="card-body">

                    <div class="row">

                        {{-- GRAFIK --}}
                        <div class="col-md-8">
                            <p class="text-center fw-bold mb-2">
                                Grafik Kunjungan Klinik (Bulanan)
                            </p>
                            <div id="chart-kunjungan" style="min-height: 300px;"></div>
                        </div>

                        {{-- STATUS KLINIK --}}
                        <div class="col-md-4">
                            <p class="text-center fw-bold">Status Klinik</p>

                            <div class="progress-group">
    Pemeriksaan Selesai
    <span class="float-end"><b>{{ $totalRekamMedis }}</b></span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-success" style="width: {{ $persenPemeriksaan }}%"></div>
    </div>
</div>

                            <div class="progress-group">
    Antrian Hari Ini
    <span class="float-end"><b>{{ $totalReservasiHariIni }}</b></span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-warning" style="width: {{ $persenAntrian }}%"></div>
    </div>
</div>


                            <div class="progress-group">
    Hewan Terdaftar
    <span class="float-end"><b>{{ $totalPet }}</b></span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-primary" style="width: {{ $persenHewan }}%"></div>
    </div>
</div>


                            <div class="progress-group">
    Pemilik Baru
    <span class="float-end"><b>{{ $totalPemilik }}</b></span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-danger" style="width: {{ $persenPemilik }}%"></div>
    </div>
</div>


                        </div>

                    </div>

                </div>

                <div class="card-footer text-center">
                    <small class="text-muted">Data klinik hewan RSHP UNAIR</small>
                </div>

            </div>

        </div>
    </div>


    {{-- ========================= --}}
    {{-- CHAT DAN LISTS --}}
    {{-- ========================= --}}
    <div class="row">

        <div class="col-md-8">

            @include('admin.dashboard.partials.chat')

            @include('admin.dashboard.partials.latest-users')

            @include('admin.dashboard.partials.latest-orders')

        </div>

        <div class="col-md-4">

            @include('admin.dashboard.partials.info-right')

            @include('admin.dashboard.partials.activity')

        </div>

    </div>

</div>
</div>

@endsection



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    var options = {
        chart: {
            type: 'line',
            height: 300,
            toolbar: { show: true }
        },
        series: [
            {
                name: "Reservasi",
                data: @json($reservasiBulanan->pluck('total')),
                color: "#1E90FF"
            },
            {
                name: "Rekam Medis",
                data: @json($rekamMedisBulanan->pluck('total')),
                color: "#28A745"
            }
        ],
        xaxis: {
            categories: @json($reservasiBulanan->pluck('nama_bulan')),
            title: { text: "Bulan" }
        },
        yaxis: {
            title: { text: "Jumlah" }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        markers: {
            size: 4
        },
        legend: {
            position: 'top'
        }
    };

    let chart = new ApexCharts(
        document.querySelector("#chart-kunjungan"),
        options
    );
    chart.render();

});
</script>

@endsection
