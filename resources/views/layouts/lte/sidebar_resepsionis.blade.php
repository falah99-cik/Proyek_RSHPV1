<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    {{-- Logo --}}
    <div class="sidebar-brand">
        <a href="{{ route('resepsionis.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/adminlte/img/AdminLTELogo.png') }}"
                 class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">Resepsionis RSHP</span>
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
                    <a href="{{ route('resepsionis.dashboard') }}"
                       class="nav-link {{ request()->is('resepsionis/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- MENU PEMILIK --}}
                <li class="nav-item">
                    <a href="{{ route('resepsionis.pemilik.index') }}"
                       class="nav-link {{ request()->is('resepsionis/pemilik*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-vcard"></i>
                        <p>Data Pemilik</p>
                    </a>
                </li>

                {{-- MENU PET --}}
                <li class="nav-item">
                    <a href="{{ route('resepsionis.pet.index') }}"
                       class="nav-link {{ request()->is('resepsionis/pet*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-paw"></i>
                        <p>Data Hewan (Pet)</p>
                    </a>
                </li>

                {{-- MENU TEMU DOKTER --}}
                <li class="nav-item">
                    <a href="{{ route('resepsionis.temu-dokter.index') }}"
                       class="nav-link {{ request()->is('resepsionis/temu-dokter*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-pulse"></i>
                        <p>Temu Dokter</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</aside>
