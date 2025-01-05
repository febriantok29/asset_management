<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ 'Kelompok 3' }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master Section -->
                <li class="nav-header">MASTER</li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Kategori Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vendors.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Vendor Penyedia Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('asset_locations.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>Penempatan Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('assets.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>Asset</p>
                    </a>
                </li>
                <!-- Tambahkan menu master lainnya di sini -->

                <!-- Transaksi Section -->
                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="{{ route('asset_purchases.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Pembelian Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('asset_transfers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Pemindahan Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('asset_maintenances.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Perawatan Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('asset_repairs.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-wrench"></i>
                        <p>Perbaikan Asset</p>
                    </a>
                </li>
                <!-- Tambahkan menu transaksi lainnya di sini -->

                {{-- Report Section --}}
                <li class="nav-header" style="margin-top: 20px;">LAPORAN</li>
                <li class="nav-item">
                    <a href="{{ route('report.assets_summary') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Rekap Asset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('report.vendor_purchases') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Pembelian Vendor</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
