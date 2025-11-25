@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Dashboard Administrator
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Jenis Hewan</div>
                                <h3 class="fw-bold">{{ $jumlahJenisHewan }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Ras Hewan</div>
                                <h3 class="fw-bold">{{ $jumlahRasHewan }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Kategori</div>
                                <h3 class="fw-bold">{{ $jumlahKategori }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Kategori Klinis</div>
                                <h3 class="fw-bold">{{ $jumlahKategoriKlinis }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Tindakan Terapi</div>
                                <h3 class="fw-bold">{{ $jumlahTindakan }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Data Pet</div>
                                <h3 class="fw-bold">{{ $jumlahPet }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Pemilik</div>
                                <h3 class="fw-bold">{{ $jumlahPemilik }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">User</div>
                                <h3 class="fw-bold">{{ $jumlahUser }}</h3>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded bg-light text-center">
                                <div class="text-muted">Role</div>
                                <h3 class="fw-bold">{{ $jumlahRole }}</h3>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
