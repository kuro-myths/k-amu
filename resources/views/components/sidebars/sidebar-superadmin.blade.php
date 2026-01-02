<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="sidebar-header-content">
            <img src="{{ asset('favicon.svg') }}" alt="K-amu" class="sidebar-logo">
            <h5>K-amu</h5>
        </div>
        <div class="sidebar-header-actions">
            <button class="btn-close-sidebar d-lg-none" id="sidebarCloseBtn" data-bs-toggle="tooltip" title="Tutup">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="{{ route('superadmin.beranda') }}" class="menu-link @if(request()->routeIs('superadmin.beranda')) active @endif">
                <i class="bi bi-house-door"></i>
                <span>Beranda</span>
            </a>
        </li>

        <!-- Manajemen Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('superadmin.pengguna', 'superadmin.pengguna.create', 'superadmin.pengguna.edit', 'superadmin.peran', 'superadmin.proyek', 'superadmin.laporan-bug', 'superadmin.hasil-testing')) active @endif">
                <i class="bi bi-gear"></i>
                <span>Manajemen</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('superadmin.pengguna', 'superadmin.pengguna.create', 'superadmin.pengguna.edit', 'superadmin.peran', 'superadmin.proyek', 'superadmin.laporan-bug', 'superadmin.hasil-testing')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('superadmin.pengguna') }}" class="submenu-link @if(request()->routeIs('superadmin.pengguna') && !request()->routeIs('superadmin.pengguna.create')) active @endif">
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.proyek') }}" class="submenu-link @if(request()->routeIs('superadmin.proyek')) active @endif">
                        <span>Proyek</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.laporan-bug') }}" class="submenu-link @if(request()->routeIs('superadmin.laporan-bug')) active @endif">
                        <span>Laporan Bug</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.hasil-testing') }}" class="submenu-link @if(request()->routeIs('superadmin.hasil-testing')) active @endif">
                        <span>Hasil Testing</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Monitoring Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('superadmin.laporan', 'superadmin.catatan-aktivitas', 'superadmin.notifikasi')) active @endif">
                <i class="bi bi-binoculars"></i>
                <span>Monitoring</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('superadmin.laporan', 'superadmin.catatan-aktivitas', 'superadmin.notifikasi')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('superadmin.catatan-aktivitas') }}" class="submenu-link @if(request()->routeIs('superadmin.catatan-aktivitas')) active @endif">
                        <span>Log Aktivitas</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.laporan') }}" class="submenu-link @if(request()->routeIs('superadmin.laporan')) active @endif">
                        <span>Laporan</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.notifikasi') }}" class="submenu-link @if(request()->routeIs('superadmin.notifikasi')) active @endif">
                        <span>Notifikasi</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Konten Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('superadmin.catatan', 'superadmin.catatan.create', 'superadmin.catatan.edit', 'superadmin.obrolan', 'superadmin.obrolan.pribadi', 'superadmin.obrolan.detail')) active @endif">
                <i class="bi bi-file-text"></i>
                <span>Konten</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('superadmin.catatan', 'superadmin.catatan.create', 'superadmin.catatan.edit', 'superadmin.obrolan', 'superadmin.obrolan.pribadi', 'superadmin.obrolan.detail')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('superadmin.catatan') }}" class="submenu-link @if(request()->routeIs('superadmin.catatan')) active @endif">
                        <span>Catatan</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.obrolan') }}" class="submenu-link @if(request()->routeIs('superadmin.obrolan', 'superadmin.obrolan.pribadi', 'superadmin.obrolan.detail')) active @endif">
                        <span>Obrolan/Chat</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Pengaturan Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('superadmin.pengaturan', 'superadmin.profil', 'superadmin.profil.update', 'superadmin.profil.changePassword')) active @endif">
                <i class="bi bi-sliders"></i>
                <span>Pengaturan</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('superadmin.pengaturan', 'superadmin.profil', 'superadmin.profil.update', 'superadmin.profil.changePassword')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('superadmin.pengaturan') }}" class="submenu-link @if(request()->routeIs('superadmin.pengaturan')) active @endif">
                        <span>Pengaturan Sistem</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.profil') }}" class="submenu-link @if(request()->routeIs('superadmin.profil')) active @endif">
                        <span>Profil Saya</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Bantuan Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('superadmin.bantuan', 'superadmin.bantuan.faq', 'superadmin.bantuan.panduan')) active @endif">
                <i class="bi bi-question-circle"></i>
                <span>Bantuan</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('superadmin.bantuan', 'superadmin.bantuan.faq', 'superadmin.bantuan.panduan')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('superadmin.bantuan') }}" class="submenu-link @if(request()->routeIs('superadmin.bantuan')) active @endif">
                        <span>Panduan Umum</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.bantuan.faq') }}" class="submenu-link @if(request()->routeIs('superadmin.bantuan.faq')) active @endif">
                        <span>FAQ</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.bantuan.panduan') }}" class="submenu-link @if(request()->routeIs('superadmin.bantuan.panduan')) active @endif">
                        <span>Panduan Lengkap</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Alat Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('superadmin.alat', 'superadmin.alat.cadangan', 'superadmin.alat.ekspor', 'superadmin.alat.impor')) active @endif">
                <i class="bi bi-tools"></i>
                <span>Alat</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('superadmin.alat', 'superadmin.alat.cadangan', 'superadmin.alat.ekspor', 'superadmin.alat.impor')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('superadmin.alat') }}" class="submenu-link @if(request()->routeIs('superadmin.alat')) active @endif">
                        <span>Dashboard Alat</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.alat.cadangan') }}" class="submenu-link @if(request()->routeIs('superadmin.alat.cadangan')) active @endif">
                        <span>Cadangan Data</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.alat.ekspor') }}" class="submenu-link @if(request()->routeIs('superadmin.alat.ekspor')) active @endif">
                        <span>Ekspor Data</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('superadmin.alat.impor') }}" class="submenu-link @if(request()->routeIs('superadmin.alat.impor')) active @endif">
                        <span>Impor Data</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>