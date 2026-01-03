<nav class="navbar-main">
    <div class="navbar-container">
        <!-- Logo & Toggle -->
        <div class="navbar-brand">
            <button class="btn-toggle-sidebar" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Navbar Center - Search -->
        <div class="navbar-search">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari..." id="headerSearchInput">
            </div>
        </div>

        <!-- Navbar Right - User Menu -->
        <div class="navbar-right">
            <!-- Icon Tema -->
            <button class="navbar-icon-btn" title="Pengaturan Tema" onclick="window.showThemeModal()" style="border: none; background: transparent; cursor: pointer; padding: 0.5rem;">
                <i class="bi bi-palette"></i>
            </button>

            <!-- Icon Pencarian -->
            <button class="navbar-icon-btn" title="Pencarian Data" onclick="window.showSearchModal()" style="border: none; background: transparent; cursor: pointer; padding: 0.5rem;">
                <i class="bi bi-search"></i>
            </button>

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
                    <li><a class="dropdown-item" href="{{ route('theme-settings') }}"><i class="bi bi-palette"></i> Pengaturan Tema</a></li>
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