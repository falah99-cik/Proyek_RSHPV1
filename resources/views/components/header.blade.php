@php
    $current = Request::path();
@endphp

<nav class="navbar" role="navigation" aria-label="Main navigation">
    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" 
         alt="Logo Universitas Airlangga" />

    <ul>
        <li class="{{ $current == 'home' ? 'active' : '' }}">
            <a href="{{ url('/') }}">Home</a>
        </li>

        <li class="{{ $current == 'struktur' ? 'active' : '' }}">
            <a href="{{ url('/struktur') }}">Struktur Organisasi</a>
        </li>

        <li class="{{ $current == 'layanan' ? 'active' : '' }}">
            <a href="{{ url('/layanan') }}">Layanan Umum</a>
        </li>

        <li class="{{ $current == 'visi' ? 'active' : '' }}">
            <a href="{{ url('/visi') }}">Visi Misi dan Tujuan</a>
        </li>

        <li>
            <a href="{{ url('/home') }}" class="login">Login</a>
        </li>
    </ul>
</nav>
