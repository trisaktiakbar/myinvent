<aside class="left-sidebar">

    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
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
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">INVENTORY</span>
                </li>
                @if (Auth::user()->role === 'Admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('permintaan-barang.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-clipboard-text"></i>
                            </span>
                            <span class="hide-menu">Permintaan Barang</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Gudang Pusat')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('gudang-pusat.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building-warehouse"></i>
                            </span>
                            <span class="hide-menu">Gudang Pusat</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Gudang Pusat' || Auth::user()->role === 'Gudang Central')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('gudang-central.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-building-cottage"></i>
                            </span>
                            <span class="hide-menu">Gudang Central</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('gudang-site.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-sitemap"></i>
                        </span>
                        <span class="hide-menu">Gudang Site</span>
                    </a>
                </li>

                @if (Auth::user()->role === 'Admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MANAJEMEN PENGGUNA</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Gudang Pusat</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Gudang Central</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
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
                    <a class="sidebar-link" href="#" aria-expanded="false">
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
