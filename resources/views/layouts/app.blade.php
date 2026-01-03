<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'K-AMU')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    @yield('styles')
</head>

<body>
    <!-- Layout Wrapper -->
    <div class="layout-wrapper">
        <!-- Sidebar - Conditionally loaded based on user role -->
        @if(auth()->user()->role === 'superadmin')
        @include('components.sidebars.sidebar-superadmin')
        @elseif(auth()->user()->role === 'leader')
        @include('components.sidebars.sidebar-leader')
        @elseif(auth()->user()->role === 'mastercard')
        @include('components.sidebars.sidebar-mastercard')
        @elseif(auth()->user()->role === 'tester')
        @include('components.sidebars.sidebar-tester')
        @else
        @include('components.sidebars.sidebar-user')
        @endif

        <!-- Right Content Wrapper -->
        <div class="right-content-wrapper">
            <!-- Navbar - Conditionally loaded based on user role -->
            @if(auth()->user()->role === 'superadmin')
            @include('components.navbars.navbar-superadmin')
            @elseif(auth()->user()->role === 'leader')
            @include('components.navbars.navbar-leader')
            @elseif(auth()->user()->role === 'mastercard')
            @include('components.navbars.navbar-mastercard')
            @elseif(auth()->user()->role === 'tester')
            @include('components.navbars.navbar-tester')
            @else
            @include('components.navbars.navbar-user')
            @endif

            <!-- Main Content -->
            <div class="main-content">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <!-- Footer - Conditionally loaded based on user role -->
                @if(auth()->user()->role === 'superadmin')
                @include('components.footers.footer-superadmin')
                @elseif(auth()->user()->role === 'leader')
                @include('components.footers.footer-leader')
                @elseif(auth()->user()->role === 'mastercard')
                @include('components.footers.footer-mastercard')
                @elseif(auth()->user()->role === 'tester')
                @include('components.footers.footer-tester')
                @else
                @include('components.footers.footer-user')
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- HTML2Canvas for Screenshot -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Global JS -->
    <script src="{{ asset('js/global.js') }}"></script>
    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>
    <script src="{{ asset('js/footer-actions.js') }}"></script>
    <!-- Theme Manager -->
    <script src="{{ asset('js/theme-manager.js') }}"></script>
    <!-- Notification Badge Real-time Update -->
    @if(auth()->user()->role === 'superadmin')
    <script src="{{ asset('js/notification-badge.js') }}"></script>
    @endif

    @yield('scripts')

    <!-- Theme & Search Modals -->
    @include('modals.theme-modal')
    @include('modals.search-modal')

    <!-- Countdown Modal -->
    <div class="modal fade" id="countdownModal" tabindex="-1" aria-labelledby="countdownModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="countdownModalLabel">
                        <i class="bi bi-calendar"></i> Kalender & Penanda
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="calendarContainer">
                        <!-- Kalender akan dirender di sini -->
                    </div>
                    <hr>
                    <div style="text-align: center; font-size: 0.85rem; color: #6b7280;">
                        <p style="margin: 0;">
                            <span style="display: inline-block; width: 16px; height: 16px; background: rgba(79, 70, 229, 0.2); border: 1px solid #4f46e5; margin-right: 4px;"></span>
                            Hari Ini
                        </p>
                        <p style="margin: 8px 0 0 0;">
                            <span style="display: inline-block; width: 16px; height: 16px; background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; margin-right: 4px;"></span>
                            Ditandai
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.clearAllMarks()">
                        <i class="bi bi-trash"></i> Hapus Semua Penanda
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Time Tracking Modal -->
    <div class="modal fade" id="timetrackingModal" tabindex="-1" aria-labelledby="timetrackingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timetrackingModalLabel">
                        <i class="bi bi-clock"></i> Pelacakan Waktu Aktif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <div id="timetrackingStatus" class="mb-2">
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        </div>
                        <h4 id="timetrackingTimer">00:00:00</h4>
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-success btn-sm" id="timetrackingToggleBtn" onclick="toggleTimeTracking()">
                            <i class="bi bi-play-fill"></i> Mulai Tracking
                        </button>
                    </div>
                    <hr>
                    <div>
                        <h6>Riwayat Waktu Aktif</h6>
                        <div id="timetrackingHistoryList" style="max-height: 200px; overflow-y: auto;">
                            <p class="text-muted">Belum ada riwayat</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" onclick="clearTimeTrackingHistory()">
                        <i class="bi bi-trash"></i> Hapus Riwayat
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>