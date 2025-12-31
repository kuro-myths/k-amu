<!-- Header Navigation -->
<header class="navbar-main">
    <div class="navbar-container">
        <!-- Left Brand -->
        <div class="navbar-brand">
            <button class="btn-toggle-sidebar d-lg-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="navbar-logo">
                <i class="bi bi-shield-check"></i>
                <span>K-AMU</span>
            </div>
        </div>

        <!-- Center Search -->
        <div class="navbar-search">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Cari...">
            </div>
        </div>

        <!-- Right Menu -->
        <div class="navbar-right">
            <!-- Page Title (Hidden on Mobile) -->
            <div class="d-none d-lg-block" style="flex: 1; text-align: right;">
                <h6 class="mb-0">
                    @yield('page-title', 'Dashboard')
                </h6>
                <small>@yield('page-subtitle', 'Selamat datang kembali')</small>
            </div>

            <div class="navbar-divider d-none d-lg-block"></div>

            <!-- Notifications -->
            <div class="navbar-icon-group">
                <button class="navbar-icon-btn" type="button">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
            </div>

            <!-- Messages -->
            <div class="navbar-icon-group">
                <button class="navbar-icon-btn" type="button">
                    <i class="bi bi-chat-dots"></i>
                    <span class="notification-badge">2</span>
                </button>
            </div>

            <!-- User Dropdown -->
            <div class="navbar-user">
                <div class="dropdown">
                    <button class="navbar-user-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <div class="navbar-user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="d-none d-lg-block">
                            <small>{{ auth()->user()->name }}</small>
                            <small>{{ ucfirst(auth()->user()->role) }}</small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Pengaturan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item" style="color: #ef4444;">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('show');
    });
</script>