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
        <li class="menu-item">
            <a href="{{ route('mastercard.pengguna') }}" class="menu-link @if(request()->routeIs('mastercard.pengguna*')) active @endif">
                <i class="bi bi-people"></i>
                <span>Kelola Pengguna</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('mastercard.alat') }}" class="menu-link @if(request()->routeIs('mastercard.alat*')) active @endif">
                <i class="bi bi-tools"></i>
                <span>Alat</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('mastercard.catatan-aktivitas') }}" class="menu-link @if(request()->routeIs('mastercard.catatan-aktivitas')) active @endif">
                <i class="bi bi-clock-history"></i>
                <span>Catatan Aktivitas</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('mastercard.obrolan') }}" class="menu-link @if(request()->routeIs('mastercard.obrolan*')) active @endif">
                <i class="bi bi-chat-left"></i>
                <span>Obrolan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('mastercard.bantuan') }}" class="menu-link @if(request()->routeIs('mastercard.bantuan*')) active @endif">
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