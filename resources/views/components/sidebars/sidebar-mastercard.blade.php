<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <h5>Menu Mastercard</h5>
        <button class="btn-close-sidebar d-lg-none" id="sidebarCloseBtn">
            <i class="bi bi-x"></i>
        </button>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="{{ route('mastercard.beranda') }}" class="menu-link @if(request()->routeIs('mastercard.beranda')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Manajemen Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('mastercard.manajemen.*')) active @endif">
                <i class="bi bi-gear"></i>
                <span>Manajemen</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('mastercard.manajemen.*')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('mastercard.manajemen.pengguna') }}" class="submenu-link @if(request()->routeIs('mastercard.manajemen.pengguna')) active @endif">
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('mastercard.manajemen.akun') }}" class="submenu-link @if(request()->routeIs('mastercard.manajemen.akun')) active @endif">
                        <span>Kelola Akun</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Monitoring -->
        <li class="menu-item">
            <a href="{{ route('mastercard.catatan-aktivitas') }}" class="menu-link @if(request()->routeIs('mastercard.catatan-aktivitas')) active @endif">
                <i class="bi bi-clock-history"></i>
                <span>Catatan Aktivitas</span>
            </a>
        </li>

        <!-- Konten Submenu -->
        <li class="menu-item menu-item-submenu">
            <button class="menu-link menu-link-toggle @if(request()->routeIs('mastercard.catatan', 'mastercard.obrolan')) active @endif">
                <i class="bi bi-file-text"></i>
                <span>Konten</span>
                <i class="bi bi-chevron-down submenu-icon"></i>
            </button>
            <ul class="submenu @if(request()->routeIs('mastercard.catatan', 'mastercard.obrolan')) show @endif">
                <li class="submenu-item">
                    <a href="{{ route('mastercard.catatan') }}" class="submenu-link @if(request()->routeIs('mastercard.catatan')) active @endif">
                        <span>Catatan</span>
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="{{ route('mastercard.obrolan') }}" class="submenu-link @if(request()->routeIs('mastercard.obrolan')) active @endif">
                        <span>Obrolan/Chat</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Alat -->
        <li class="menu-item">
            <a href="{{ route('mastercard.alat') }}" class="menu-link @if(request()->routeIs('mastercard.alat')) active @endif">
                <i class="bi bi-tools"></i>
                <span>Alat & Utilitas</span>
            </a>
        </li>

        <!-- Profil -->
        <li class="menu-item">
            <a href="{{ route('mastercard.profil') }}" class="menu-link @if(request()->routeIs('mastercard.profil')) active @endif">
                <i class="bi bi-person"></i>
                <span>Profil</span>
            </a>
        </li>

        <!-- Bantuan -->
        <li class="menu-item">
            <a href="{{ route('mastercard.bantuan') }}" class="menu-link @if(request()->routeIs('mastercard.bantuan')) active @endif">
                <i class="bi bi-question-circle"></i>
                <span>Bantuan</span>
            </a>
        </li>
    </ul>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <p>Mastercard Panel</p>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>