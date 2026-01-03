<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="sidebar-header-content">
            <img src="{{ asset('favicon.svg') }}" alt="K-amu" class="sidebar-logo">
            <h5>K-amu</h5>
        </div>
        <div class="sidebar-header-actions">
            <button class="btn-close-sidebar d-lg-none" id="sidebarCloseBtn">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        @if(auth()->user()->role === 'siswa')
        <!-- Menu Siswa -->
        <li class="menu-item">
            <a href="{{ route('user.beranda') }}" class="menu-link @if(request()->routeIs('user.beranda')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('user.siswa.catatan') }}" class="menu-link @if(request()->routeIs('user.siswa.catatan*')) active @endif">
                <i class="bi bi-sticky"></i>
                <span>Catatan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('user.siswa.laporan') }}" class="menu-link @if(request()->routeIs('user.siswa.laporan*')) active @endif">
                <i class="bi bi-file-earmark-text"></i>
                <span>Laporan Nilai</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('user.siswa.obrolan') }}" class="menu-link @if(request()->routeIs('user.siswa.obrolan*')) active @endif">
                <i class="bi bi-chat-left"></i>
                <span>Obrolan</span>
            </a>
        </li>

        @elseif(auth()->user()->role === 'orang_tua')
        <!-- Menu Orang Tua -->
        <li class="menu-item">
            <a href="{{ route('user.beranda') }}" class="menu-link @if(request()->routeIs('user.beranda')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('user.orang_tua.catatan') }}" class="menu-link @if(request()->routeIs('user.orang_tua.catatan*')) active @endif">
                <i class="bi bi-sticky"></i>
                <span>Catatan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('user.orang_tua.laporan') }}" class="menu-link @if(request()->routeIs('user.orang_tua.laporan*')) active @endif">
                <i class="bi bi-file-earmark-text"></i>
                <span>Laporan Anak</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('user.orang_tua.obrolan') }}" class="menu-link @if(request()->routeIs('user.orang_tua.obrolan*')) active @endif">
                <i class="bi bi-chat-left"></i>
                <span>Obrolan</span>
            </a>
        </li>

        @else
        <!-- Menu Alumni & Umum -->
        <li class="menu-item">
            <a href="{{ route('user.beranda') }}" class="menu-link @if(request()->routeIs('user.beranda')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('user.alumni') }}" class="menu-link @if(request()->routeIs('user.alumni*')) active @endif">
                <i class="bi bi-people"></i>
                <span>Direktori Alumni</span>
            </a>
        </li>
        @endif
    </ul>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>