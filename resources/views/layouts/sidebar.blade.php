<aside class="left-sidebar">

    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('beranda') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo.png') }}" class="mt-3" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">DASHBOARD</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('beranda') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Beranda</span>
                    </a>
                </li>
                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Permintaan Barang')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MANAJEMEN ITEM</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('kelola-item') || request()->is('kelola-item/*') ? 'active' : '' }}"
                            href="{{ route('kelola-item.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-notes"></i>
                            </span>
                            <span class="hide-menu">Kelola Item</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role !== 'User')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">INVENTORY</span>
                    </li>
                @endif
                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Permintaan Barang')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('permintaan-barang') || request()->is('permintaan-barang/*') ? 'active' : '' }}"
                            href="{{ route('permintaan-barang.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-clipboard-text"></i>
                            </span>
                            <span class="hide-menu">Permintaan Barang</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'Admin' ||
                        Auth::user()->role === 'Permintaan Barang' ||
                        Auth::user()->role === 'Time Planner HO')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('time-planner-ho') || request()->is('time-planner-ho/*') ? 'active' : '' }}"
                            href="{{ route('time-planner-ho.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-report"></i>
                            </span>
                            <span class="hide-menu">Time Planner HO</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role === 'Admin' ||
                        Auth::user()->role === 'Permintaan Barang' ||
                        Auth::user()->role === 'Time Planner HO' ||
                        Auth::user()->role === 'Purchasing')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('purchasing') || request()->is('purchasing/*') ? 'active' : '' }}"
                            href="{{ route('purchasing.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building-bank"></i>
                            </span>
                            <span class="hide-menu">Purchasing</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role === 'Admin' ||
                        Auth::user()->role === 'Permintaan Barang' ||
                        Auth::user()->role === 'Time Planner HO' ||
                        Auth::user()->role === 'Purchasing' ||
                        Auth::user()->role === 'Gudang Pusat')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('gudang-pusat') || request()->is('gudang-pusat/*') ? 'active' : '' }}"
                            href="{{ route('gudang-pusat.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building-warehouse"></i>
                            </span>
                            <span class="hide-menu">Gudang Pusat</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'Admin' ||
                        Auth::user()->role === 'Permintaan Barang' ||
                        Auth::user()->role === 'Time Planner HO' ||
                        Auth::user()->role === 'Purchasing' ||
                        Auth::user()->role === 'Gudang Pusat' ||
                        Auth::user()->role === 'Gudang Central')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('gudang-central') || request()->is('gudang-central/*') ? 'active' : '' }}"
                            href="{{ route('gudang-central.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building-cottage"></i>
                            </span>
                            <span class="hide-menu">Gudang Central</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'Admin' ||
                        Auth::user()->role === 'Permintaan Barang' ||
                        Auth::user()->role === 'Time Planner HO' ||
                        Auth::user()->role === 'Purchasing' ||
                        Auth::user()->role === 'Gudang Pusat' ||
                        Auth::user()->role === 'Gudang Central' ||
                        Auth::user()->role === 'Gudang Site')
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('gudang-site') || request()->is('gudang-site/*') ? 'active' : '' }}"
                            href="{{ route('gudang-site.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-sitemap"></i>
                            </span>
                            <span class="hide-menu">Gudang Site</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('pembelian-lokal') || request()->is('pembelian-lokal/*') ? 'active' : '' }}"
                            href="{{ route('pembelian-lokal.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-current-location"></i>
                            </span>
                            <span class="hide-menu">Pembelian Lokal</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'User')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Export Data</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('export-by-kode-item') || request()->is('export-by-kode-item/*') ? 'active' : '' }}"
                            href="{{ route('export-by-kode-item.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-table"></i>
                            </span>
                            <span class="hide-menu">Berdasarkan Kode Item</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('export-by-lokasi') || request()->is('export-by-lokasi/*') ? 'active' : '' }}"
                            href="{{ route('export-by-lokasi.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-table"></i>
                            </span>
                            <span class="hide-menu">Berdasarkan Lokasi</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'Admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MANAJEMEN PENGGUNA</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('manajemen-pengguna/user') || request()->is('manajemen-pengguna/user/*') ? 'active' : '' }}"
                            href="{{ route('manajemen-pengguna.user.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('manajemen-pengguna/permintaan-barang') || request()->is('manajemen-pengguna/permintaan-barang/*') ? 'active' : '' }}"
                            href="{{ route('manajemen-pengguna.permintaan-barang.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Permintaan Barang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('manajemen-pengguna/time-planner-ho') || request()->is('manajemen-pengguna/time-planner-ho/*') ? 'active' : '' }}"
                            href="{{ route('manajemen-pengguna.time-planner-ho.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Time Planner HO</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('manajemen-pengguna/purchasing') || request()->is('manajemen-pengguna/purchasing/*') ? 'active' : '' }}"
                            href="{{ route('manajemen-pengguna.purchasing.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Purchasing</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('manajemen-pengguna/gudang-pusat') || request()->is('manajemen-pengguna/gudang-pusat/*') ? 'active' : '' }}"
                            href="{{ route('manajemen-pengguna.gudang-pusat.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Gudang Pusat</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('manajemen-pengguna/gudang-central') || request()->is('manajemen-pengguna/gudang-central/*') ? 'active' : '' }}"
                            href="{{ route('manajemen-pengguna.gudang-central.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Gudang Central</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('manajemen-pengguna/gudang-site') || request()->is('manajemen-pengguna/gudang-site/*') ? 'active' : '' }}"
                            href="{{ route('manajemen-pengguna.gudang-site.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Gudang Site</span>
                        </a>
                    </li>
                @endif

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">AKUN</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('pengaturan') || request()->is('pengaturan/*') ? 'active' : '' }}"
                        href="{{ route('pengaturan.profil.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Pengaturan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#logOutModal" aria-expanded="false">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">Log Out</span>
                    </a>
                </li>
            </ul>

        </nav>

    </div>

</aside>
