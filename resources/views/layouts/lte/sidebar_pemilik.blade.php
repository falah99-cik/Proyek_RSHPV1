<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="{{ route('pemilik.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/adminlte/img/AdminLTELogo.png') }}"
                 class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Pemilik RSHP</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('pemilik.dashboard') }}"
                       class="nav-link {{ request()->is('pemilik/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pemilik.jadwal.index') }}"
                       class="nav-link {{ request()->is('pemilik/jadwal-temu*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar-check"></i>
                        <p>Jadwal Temu Dokter</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pemilik.rekam.index') }}"
                       class="nav-link {{ request()->is('pemilik/rekam-medis*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-medical"></i>
                        <p>Rekam Medis</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</aside>
