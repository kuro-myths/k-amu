<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'K-AMU')</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    @yield('styles')
</head>

<body>
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Global JS -->
    <script src="{{ asset('js/global.js') }}"></script>
    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>

    @yield('scripts')
</body>

</html>