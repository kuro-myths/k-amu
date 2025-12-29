<nav class="navbar-main">
    <div class="navbar-container">
        <!-- Logo & Toggle -->
        <div class="navbar-brand">
            <button class="btn-toggle-sidebar" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="navbar-logo">
                <i class="bi bi-people"></i>
                <span>K-AMU</span>
            </div>
        </div>

        <!-- Navbar Center - Search -->
        <div class="navbar-search">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari catatan, laporan...">
            </div>
        </div>

        <!-- Navbar Right - User Menu -->
        <div class="navbar-right">
            <!-- Notifications -->
            <button class="navbar-icon-btn" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle"></i> Informasi Baru</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-chat-left"></i> Pesan Baru</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Lihat Semua</a></li>
            </ul>

            <!-- User Menu -->
            <div class="navbar-user">
                <button class="navbar-user-btn" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ \App\Helpers\RouteHelper::getProfileRoute() }}"><i class="bi bi-person"></i> Profil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>