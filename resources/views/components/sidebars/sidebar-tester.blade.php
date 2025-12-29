<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <h5>Menu Tester</h5>
        <button class="btn-close-sidebar d-lg-none" id="sidebarCloseBtn">
            <i class="bi bi-x"></i>
        </button>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="{{ route('tester.beranda') }}" class="menu-link @if(request()->routeIs('tester.beranda')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.tools') }}" class="menu-link @if(request()->routeIs('tester.tools*')) active @endif">
                <i class="bi bi-tools"></i>
                <span>Tools</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.sandbox') }}" class="menu-link @if(request()->routeIs('tester.sandbox*')) active @endif">
                <i class="bi bi-box"></i>
                <span>Sandbox</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.dokumentasi') }}" class="menu-link @if(request()->routeIs('tester.dokumentasi*')) active @endif">
                <i class="bi bi-book"></i>
                <span>Dokumentasi</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.laporan') }}" class="menu-link @if(request()->routeIs('tester.laporan*')) active @endif">
                <i class="bi bi-file-earmark-text"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.monitoring') }}" class="menu-link @if(request()->routeIs('tester.monitoring')) active @endif">
                <i class="bi bi-graph-up"></i>
                <span>Monitoring</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.statistik') }}" class="menu-link @if(request()->routeIs('tester.statistik')) active @endif">
                <i class="bi bi-pie-chart"></i>
                <span>Statistik</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.obrolan') }}" class="menu-link @if(request()->routeIs('tester.obrolan*')) active @endif">
                <i class="bi bi-chat-left"></i>
                <span>Obrolan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('tester.pengaturan') }}" class="menu-link @if(request()->routeIs('tester.pengaturan')) active @endif">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>
        </li>
    </ul>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <p>Tester Panel</p>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>