@extends('layouts.app')

@section('title', 'Laporan Sistem')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan Sistem
            </h2>
            <p class="text-muted mt-1">Analisis dan statistik sistem K-AMU</p>
        </div>
        <div class="col-md-4 text-end">
            <form method="GET" action="{{ route('superadmin.laporan') }}" class="d-inline">
                <select class="form-select form-select-sm" name="period" onchange="this.form.submit()">
                    <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="year" {{ request('period') == 'year' ? 'selected' : '' }}>Tahun Ini</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <!-- Total Users -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Total Pengguna</p>
                            <h3 class="mb-0">{{ $totalUsers ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-people-fill text-primary" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-arrow-up"></i>
                        {{ $newUsersThisMonth ?? 0 }} bulan ini
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Projects -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Total Proyek</p>
                            <h3 class="mb-0">{{ $totalProjects ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-briefcase-fill text-success" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>
                        {{ $activeProjects ?? 0 }} aktif
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Bug Reports -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Total Bug</p>
                            <h3 class="mb-0">{{ $totalBugs ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-bug-fill text-danger" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-circle-fill" style="font-size: 0.5rem;"></i>
                        {{ $openBugs ?? 0 }} terbuka
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Tests -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1 small">Total Test</p>
                            <h3 class="mb-0">{{ $totalTests ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-check2-circle text-info" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-arrow-up"></i>
                        {{ $passRate ?? 0 }}% lulus
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- User Distribution -->
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-light p-3">
                    <h6 class="mb-0">
                        <i class="bi bi-pie-chart-fill"></i> Distribusi Pengguna
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center py-5 text-muted">
                        <p>Grafik distribusi pengguna per role</p>
                        <small>Chart rendering akan ditampilkan dengan Chart.js</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Timeline -->
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-light p-3">
                    <h6 class="mb-0">
                        <i class="bi bi-graph-up"></i> Aktivitas Harian
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center py-5 text-muted">
                        <p>Grafik aktivitas 30 hari terakhir</p>
                        <small>Chart rendering akan ditampilkan dengan Chart.js</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Log Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-light p-3">
                    <h6 class="mb-0">
                        <i class="bi bi-clock-history"></i> Log Aktivitas Terbaru
                    </h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Waktu</th>
                                <th>Pengguna</th>
                                <th>Aksi</th>
                                <th>Deskripsi</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activityLogs ?? [] as $log)
                            <tr>
                                <td>
                                    <small class="text-muted">{{ $log->created_at->format('d M H:i') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">{{ $log->user_name ?? 'Unknown' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $log->action ?? 'Unknown' }}</span>
                                </td>
                                <td>
                                    <small>{{ $log->description ?? '-' }}</small>
                                </td>
                                <td>
                                    <code class="text-muted" style="font-size: 0.75rem;">{{ $log->ip_address ?? '-' }}</code>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada aktivitas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection