<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                @if (!Auth::check())
                    <li class="nav-item {{ $active == "home" ? 'active' : '' }}">
                        <a href="/">
                            <i class="fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                @endif

                @if (Auth::check())
                    <li class="nav-item {{ $active == "dashboard" ? 'active' : '' }}">
                        <a href="/dashboard">
                            <i class="fas fa-desktop"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif

                @if (!Auth::check())
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Products</h4>
                    </li>
                    <li class="nav-item {{ $active == "produk" ? 'active' : '' }}">
                        <a data-bs-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Produk Kami</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="/products">
                                        <span class="sub-item">All</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/products_atas">
                                        <span class="sub-item">Pakaian Atas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/products_bawah">
                                        <span class="sub-item">Pakaian Bawah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/products_aksesoris">
                                        <span class="sub-item">Aksesoris</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if ($active == "pesanan")
                        <li class="nav-item {{ $active == "pesanan" ? 'active' : '' }}">
                            <a href="/pesanan">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Pesanan</p>
                            </a>
                        </li>
                    @endif
                @endif

                @if (Auth::check())
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Penjual</h4>
                    </li>
                    <li class="nav-item {{ $active == "kelola_produk" ? 'active' : '' }}">
                        <a href="/kelola_produk">
                            <i class="fas fa-luggage-cart"></i>
                            <p>Kelola Produk</p>
                        </a>
                    </li>
                    <li class="nav-item {{ $active == "kelola_pesanan" ? 'active' : '' }}">
                        <a href="/kelola_pesanan">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Pesanan</p>
                            <span class="badge badge-warning">{{ $warning }}</span>
                            <span class="badge badge-info">{{ $info }}</span>
                            <span class="badge badge-primary">{{ $primary }}</span>
                            <span class="badge badge-success">{{ $success }}</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->