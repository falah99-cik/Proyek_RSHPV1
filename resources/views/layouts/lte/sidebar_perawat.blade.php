<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    {{-- Logo --}}
    <div class="sidebar-brand">
        <a href="{{ route('perawat.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/adminlte/img/AdminLTELogo.png') }}"
                 class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Perawat RSHP</span>
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
                    <a href="{{ route('perawat.dashboard') }}"
                       class="nav-link {{ request()->is('perawat/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- DATA PASIEN --}}
                <li class="nav-item">
                    <a href="{{ route('perawat.pasien.index') }}"
                       class="nav-link {{ request()->is('perawat/pasien*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Data Pasien</p>
                    </a>
                </li>

                {{-- REKAM MEDIS --}}
                <li class="nav-item">
                    <a href="{{ route('perawat.rekam.index') }}"
                       class="nav-link {{ request()->is('perawat/rekam-medis*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-medical"></i>
                        <p>Rekam Medis</p>
                    </a>
                </li>

                {{-- TAMBAH REKAM MEDIS --}}
                <li class="nav-item">
                    <a href="{{ route('perawat.rekam.create') }}"
                       class="nav-link {{ request()->is('perawat/rekam-medis/create') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-plus-circle"></i>
                        <p>Tambah Rekam Medis</p>
                    </a>
                </li>


            </ul>
        </nav>
    </div>

</aside>
