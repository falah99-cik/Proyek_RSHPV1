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
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/jenis-hewan*','admin/ras-hewan*','admin/kategori*','admin/kategori-klinis*','admin/tindakan*','admin/pet*') ? 'menu-open' : '' }}">
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
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Jenis Hewan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.kategori.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.kategori_klinis.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Kategori Klinis</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.pet.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Pet</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.ras_hewan.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Ras Hewan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.tindakan.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Kode Tindakan</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{ request()->is('admin/user*','admin/user-role*','admin/role*','admin/dokter*','admin/perawat*','admin/pemilik*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>
                            User Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.user_role.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>User Role</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.dokter.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Dokter</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.perawat.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Perawat</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.pemilik.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Pemilik</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item {{ request()->is('admin/temu-dokter*','admin/rekam-medis*','admin/detail-rm*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-receipt-cutoff"></i>
                        <p>
                            Transaksi Pelayanan
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.temu_dokter.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Temu Dokter</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.rekam_medis.index') }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Rekam Medis</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.detail_rm.index', ['idrekam'=>1]) }}" class="nav-link">
                                <i class="bi bi-dot nav-icon"></i>
                                <p>Detail Rekam Medis</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>

        </nav>
    </div>

</aside>
