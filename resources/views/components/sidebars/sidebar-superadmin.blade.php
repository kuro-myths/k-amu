<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <h5>Menu Admin</h5>
        <button class="btn-close-sidebar d-lg-none" id="sidebarCloseBtn">
            <i class="bi bi-x"></i>
        </button>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="{{ route('superadmin.beranda') }}" class="menu-link @if(request()->routeIs('superadmin.beranda')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('superadmin.pengguna') }}" class="menu-link @if(request()->routeIs('superadmin.pengguna*')) active @endif">
                <i class="bi bi-people"></i>
                <span>Kelola Pengguna</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('superadmin.catatan') }}" class="menu-link @if(request()->routeIs('superadmin.catatan*')) active @endif">
                <i class="bi bi-sticky"></i>
                <span>Catatan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('superadmin.laporan') }}" class="menu-link @if(request()->routeIs('superadmin.laporan*')) active @endif">
                <i class="bi bi-graph-up"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('superadmin.pengaturan') }}" class="menu-link @if(request()->routeIs('superadmin.pengaturan*')) active @endif">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li>
    </ul>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <p>Super Admin Panel</p>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>