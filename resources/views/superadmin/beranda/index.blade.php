@extends('layouts.app')
@section('title', 'Dashboard SuperAdmin - K-AMU')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

<div class="dashboard-wrapper">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="header-info">
            <h1 class="header-title">Dashboard SuperAdmin</h1>
            <p class="header-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->format('l, d F Y H:i') }}
            </p>
        </div>
        <div class="header-icon">
            <i class="bi bi-shield-check"></i>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <!-- Total Pengguna -->
        <div class="stat-card stat-blue">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Total Pengguna</p>
                    <h2 class="stat-value">{{ $totalUsers ?? 0 }}</h2>
                    <small class="stat-trend"><i class="bi bi-arrow-up"></i>+12% bulan ini</small>
                </div>
                <i class="bi bi-people-fill stat-icon"></i>
            </div>
            <div class="stat-progress">
                <div class="progress-bar" style="width: 75%;"></div>
            </div>
        </div>

        <!-- Total Proyek -->
        <div class="stat-card stat-cyan">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Total Proyek</p>
                    <h2 class="stat-value">{{ $totalProjects ?? 0 }}</h2>
                    <small class="stat-trend"><i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>{{ $activeProjects ?? 0 }} aktif</small>
                </div>
                <i class="bi bi-briefcase-fill stat-icon"></i>
            </div>
            <div class="stat-progress">
                <div class="progress-bar" style="width: 60%;"></div>
            </div>
        </div>

        <!-- Total Bug -->
        <div class="stat-card stat-red">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Total Bug</p>
                    <h2 class="stat-value">{{ $totalBugs ?? 0 }}</h2>
                    <small class="stat-trend"><i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>{{ $openBugs ?? 0 }} terbuka</small>
                </div>
                <i class="bi bi-bug-fill stat-icon"></i>
            </div>
            <div class="stat-progress">
                <div class="progress-bar" style="width: 45%;"></div>
            </div>
        </div>

        <!-- Total Test -->
        <div class="stat-card stat-green">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Total Test</p>
                    <h2 class="stat-value">{{ $totalTests ?? 0 }}</h2>
                    <small class="stat-trend"><i class="bi bi-check-circle"></i>{{ $passRate ?? 0 }}% lulus</small>
                </div>
                <i class="bi bi-check-circle-fill stat-icon"></i>
            </div>
            <div class="stat-progress">
                <div class="progress-bar" style="width: 85%;"></div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="card-header">
                <h3 class="card-title">Distribusi Pengguna</h3>
            </div>
            <div class="chart-container">
                <canvas id="userChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="card-header">
                <h3 class="card-title">Aktivitas 7 Hari Terakhir</h3>
            </div>
            <div class="chart-container">
                <canvas id="activityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content-grid">
        <!-- Activity Info -->
        <div class="info-card">
            <div class="card-header">
                <h3 class="card-title">Informasi Alur</h3>
            </div>
            <div class="card-body">
                <div class="activity-item">
                    <h6 class="activity-title">Registrasi Posisi</h6>
                    <p class="activity-desc">Data posisi berhasil dimulai dan database</p>
                    <span class="badge badge-success"><i class="bi bi-check-circle"></i>Selesai</span>
                </div>

                <div class="activity-item">
                    <h6 class="activity-title">Screening Media</h6>
                    <p class="activity-desc">Pengecakan telegram datang dan lahir tebaik</p>
                    <span class="badge badge-success"><i class="bi bi-check-circle"></i>Selesai</span>
                </div>

                <div class="activity-item">
                    <h6 class="activity-title">Administrasi Vaksin</h6>
                    <p class="activity-desc">Menugungi konfirmasi dari apolikar</p>
                    <span class="badge badge-warning"><i class="bi bi-clock"></i>Proses</span>
                </div>

                <div class="activity-item">
                    <h6 class="activity-title">Observasi & Seleksi</h6>
                    <p class="activity-desc">Periode observasi 30 menit pasos vaksinasi</p>
                    <span class="badge badge-pending"><i class="bi bi-hourglass"></i>Pending</span>
                </div>
            </div>
        </div>

        <!-- Admin Profile -->
        <div class="profile-card">
            <div class="card-header">
                <h3 class="card-title">Profil Admin</h3>
            </div>
            <div class="card-body">
                <div class="profile-avatar">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h5 class="profile-name">{{ auth()->user()->name }}</h5>
                <p class="profile-role">{{ ucfirst(auth()->user()->role) }}</p>

                <div class="profile-info">
                    <div class="info-item">
                        <small class="info-label">Email</small>
                        <p class="info-value">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="info-item">
                        <small class="info-label">ID Pengguna</small>
                        <p class="info-value">#{{ auth()->user()->id }}</p>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('superadmin.profil') }}" class="btn-custom btn-primary">
                        <i class="bi bi-pencil"></i>Edit
                    </a>
                    <a href="{{ route('logout') }}" class="btn-custom btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>Logout
                    </a>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection