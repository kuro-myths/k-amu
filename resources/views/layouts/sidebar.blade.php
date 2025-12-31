<!-- Sidebar Navigation -->
<nav class="sidebar">
    <!-- Sidebar Top -->
    <div class="sidebar-top">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div>
                <h5 class="brand-name">K-AMU</h5>
                <small class="brand-subtitle">v1.0</small>
            </div>
        </div>
        <button class="btn-close-sidebar" id="closeSidebarBtn">
            <i class="bi bi-x"></i>
        </button>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        @if(auth()->user()->isSuperadmin())
        @include('layouts.sidebar-superadmin')
        @elseif(auth()->user()->isMastercard())
        @include('layouts.sidebar-mastercard')
        @elseif(auth()->user()->isLeader())
        @include('layouts.sidebar-leader')
        @elseif(auth()->user()->isTester())
        @include('layouts.sidebar-tester')
        @else
        @include('layouts.sidebar-user')
        @endif
    </ul>

    <!-- Sidebar Footer -->
    <div style="padding: 16px 20px; border-top: 1px solid #2a3a4a; text-align: center; flex-shrink: 0;">
        <small style="color: #9ca3af; display: block;">{{ auth()->user()->role }}</small>
        <small style="color: #6b7280; display: block; margin-top: 4px;">© 2025 K-AMU System</small>
    </div>
</nav>

<script>
    // Close sidebar on mobile when clicking close btn
    document.getElementById('closeSidebarBtn')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.remove('show');
    });

    // Handle submenu toggle
    document.querySelectorAll('.menu-link-toggle').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const submenu = this.nextElementSibling;
            const isExpanded = submenu.style.display === 'flex' || submenu.style.display === '';

            // Close all other submenus
            document.querySelectorAll('.submenu').forEach(menu => {
                menu.style.display = 'none';
            });
            document.querySelectorAll('.menu-link-toggle').forEach(btn => {
                btn.classList.remove('active');
            });

            // Toggle current submenu
            if (isExpanded) {
                submenu.style.display = 'none';
                this.classList.remove('active');
            } else {
                submenu.style.display = 'flex';
                this.classList.add('active');
            }
        });
    });

    // Close sidebar when clicking menu items on mobile
    document.querySelectorAll('.sidebar .menu-link').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                document.querySelector('.sidebar').classList.remove('show');
            }
        });
    });

    // Close sidebar when clicking submenu items on mobile
    document.querySelectorAll('.submenu-link').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                document.querySelector('.sidebar').classList.remove('show');
            }
        });
    });
</script>