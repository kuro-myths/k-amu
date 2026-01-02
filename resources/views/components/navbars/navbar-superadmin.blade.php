<nav class="navbar-main">
    <div class="navbar-container">
        <!-- Logo & Toggle -->
        <div class="navbar-brand">
            <button class="btn-toggle-sidebar" id="sidebarToggle" data-bs-toggle="tooltip" title="Buka/Tutup Menu">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- Navbar Center - Search -->
        <div class="navbar-search">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari pengguna, laporan...">
            </div>
        </div>

        <!-- Navbar Right - User Menu -->
        <div class="navbar-right">
            <!-- Notifications -->
            @php
            $unreadNotifications = auth()->user()->notifications()->unread()->latest()->limit(5)->get();
            $unreadCount = auth()->user()->notifications()->unread()->count();
            @endphp
            <button class="navbar-icon-btn" id="notificationBtn" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                @if($unreadCount > 0)
                <span class="notification-badge" id="notificationBadge">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px;">
                @forelse($unreadNotifications as $notif)
                <li>
                    <a class="dropdown-item" href="{{ route('superadmin.notifikasi') }}">
                        <i class="bi {{ $notif->icon ?? 'bi-info-circle' }}"></i>
                        <div class="d-flex flex-column flex-grow-1">
                            <span class="fw-bold">{{ $notif->title }}</span>
                            <small class="text-muted">{{ Str::limit($notif->content, 50) }}</small>
                            <small class="text-secondary">{{ $notif->created_at->diffForHumans() }}</small>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @empty
                <li class="p-3 text-center text-muted">Tidak ada notifikasi baru</li>
                @endforelse
                <li><a class="dropdown-item text-center text-primary fw-bold" href="{{ route('superadmin.notifikasi') }}">Lihat Semua</a></li>
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
                    <li><a class="dropdown-item" href="{{ \App\Helpers\RouteHelper::getProfileRoute() }}"><i class="bi bi-person"></i> Profil Admin</a></li>
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