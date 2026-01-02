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
        <li class="menu-item">
            <a href="{{ route('leader.beranda') }}" class="menu-link @if(request()->routeIs('leader.beranda')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('leader.proyek') }}" class="menu-link @if(request()->routeIs('leader.proyek*')) active @endif">
                <i class="bi bi-briefcase"></i>
                <span>Proyek Saya</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('leader.catatan') }}" class="menu-link @if(request()->routeIs('leader.catatan*')) active @endif">
                <i class="bi bi-sticky"></i>
                <span>Catatan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('leader.analisis') }}" class="menu-link @if(request()->routeIs('leader.analisis*')) active @endif">
                <i class="bi bi-graph-up"></i>
                <span>Analisis</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('leader.bimbingan') }}" class="menu-link @if(request()->routeIs('leader.bimbingan*')) active @endif">
                <i class="bi bi-chat-dots"></i>
                <span>Bimbingan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('leader.obrolan') }}" class="menu-link @if(request()->routeIs('leader.obrolan*')) active @endif">
                <i class="bi bi-chat-left"></i>
                <span>Obrolan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('leader.bantuan') }}" class="menu-link @if(request()->routeIs('leader.bantuan*')) active @endif">
                <i class="bi bi-question-circle"></i>
                <span>Bantuan</span>
            </a>
        </li>
    </ul>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <p>Leader Panel</p>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>