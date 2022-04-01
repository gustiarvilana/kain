<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview ml-4 mr-4">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link active">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link" id="m_dashboard">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Dashboard Admin</p>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- <li class="nav-item">
                <a href="pages/widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Widgets
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li> --}}

            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Master Produk
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview ml-4 mr-4">
                    <li class="nav-item">
                        <a href="{{ route('jenis.index') }}" class="nav-link">
                            <i class="fa fa-cube mr-2" aria-hidden="true"></i>
                            <p>Tabel Jenis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link">
                            <i class="fa fa-cubes mr-2" aria-hidden="true"></i>
                            <p>Tabel produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('master.index') }}" class="nav-link">
                            <i class="mr-2 fa fa-book" aria-hidden="true"></i>
                            <p>Data Master</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="mr-2 fas fa-truck-loading    "></i>
                            <p>Tabel Supplier</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Transaksi
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview ml-4 mr-4">
                    <li class="nav-item">
                        <a href="{{ route('pembelian.index') }}" class="nav-link">
                            <i class="mr-2 fa fa-truck" aria-hidden="true"></i>
                            <p>Pembelian</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sortir.index') }}" class="nav-link">
                            <i class="mr-2 fa fa-archive" aria-hidden="true"></i>
                            <p>Sortir</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}" class="nav-link">
                            <i class="mr-2 fa fa-cart-arrow-down" aria-hidden="true"></i>
                            <p>Penjualan</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
