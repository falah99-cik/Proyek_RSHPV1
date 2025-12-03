<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/adminlte/img/AdminLTELogo.png') }}"
                 class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">RSHP UNAIR</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/*') ? 'menu-close' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-boxes"></i>
                        <p>
                            Data Master
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.jenis_hewan.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Jenis Hewan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.kategori.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Kategori</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.kategori_klinis.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Kategori Klinis</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.pemilik.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Pemilik</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.pet.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Pet</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.ras_hewan.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Ras Hewan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Role</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.tindakan.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tindakan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.user_role.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>User Role</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.dokter.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dokter</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.perawat.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Perawat</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
    </div>

</aside>
