@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    Dashboard - {{ session('user_name') }}
                </div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        You are logged in as <strong>{{ session('user_role_name') }}</strong>
                    </p>

                    <hr>

                    <!-- MENU SESUAI ROLE -->
                    @if(session('user_role_name') == 'Administrator')
                        <a href="{{ url('/jenis-hewan') }}" class="btn btn-primary mb-2">Kelola Jenis Hewan</a>
                        <a href="{{ url('/kategori') }}" class="btn btn-primary mb-2">Kelola Kategori</a>
                        <a href="{{ url('/pemilik') }}" class="btn btn-primary mb-2">Daftar Pemilik</a>
                        <a href="{{ url('/user_role') }}" class="btn btn-primary mb-2">Kelola User</a>
                    @endif

                    @if(session('user_role_name') == 'Resepsionis')
                        <a href="{{ url('/pendaftaran') }}" class="btn btn-primary mb-2">Data Pendaftaran</a>
                    @endif

                    @if(session('user_role_name') == 'Pemilik')
                        <a href="{{ url('/pet') }}" class="btn btn-primary mb-2">Data Pet Saya</a>
                    @endif

                    @if(session('user_role_name') == 'Dokter')
                        <a href="{{ url('/rekam-medis') }}" class="btn btn-primary mb-2">Data Rekam Medis</a>
                    @endif

                    @if(session('user_role_name') == 'Perawat')
                        <a href="{{ url('/perawatan') }}" class="btn btn-primary mb-2">Data Perawatan</a>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
