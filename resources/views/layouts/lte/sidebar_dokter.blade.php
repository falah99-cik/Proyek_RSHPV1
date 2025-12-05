<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    {{-- Logo --}}
    <div class="sidebar-brand">
        <a href="{{ route('dokter.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/adminlte/img/AdminLTELogo.png') }}"
                 class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Dokter RSHP</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('dokter.dashboard') }}"
                       class="nav-link {{ request()->is('dokter/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                {{-- DATA PASIEN --}}
                <li class="nav-item">
                    <a href="{{ route('dokter.pasien.index') }}"
                       class="nav-link {{ request()->is('dokter/pasien*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Data Pasien</p>
                    </a>
                </li>


                {{-- REKAM MEDIS --}}
                <li class="nav-item">
                    <a href="{{ route('dokter.rekam_medis.index') }}"
                       class="nav-link {{ request()->is('dokter/rekam-medis*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-medical"></i>
                        <p>Rekam Medis</p>
                    </a>
                </li>


                {{-- DETAIL REKAM MEDIS --}}
                <li class="nav-item">
                    <a href="#" class="nav-link disabled text-muted">
                        <i class="nav-icon bi bi-list-ul"></i>
                        <p>Detail Rekam Medis</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</aside>
