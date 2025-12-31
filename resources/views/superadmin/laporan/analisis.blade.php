@extends('layouts.app')

@section('title', 'Laporan Analisis')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-graph-up"></i> Laporan Analisis
            </h2>
            <p class="text-muted mt-1">Analisis data dan performa sistem</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('superadmin.laporan') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Periode</label>
                            <select name="periode" class="form-select">
                                <option value="today">Hari Ini</option>
                                <option value="week">Minggu Ini</option>
                                <option value="month" selected>Bulan Ini</option>
                                <option value="year">Tahun Ini</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tipe Analisis</label>
                            <select name="tipe" class="form-select">
                                <option value="">Semua Tipe</option>
                                <option value="user">User Activity</option>
                                <option value="proyek">Project Progress</option>
                                <option value="bug">Bug Report</option>
                                <option value="testing">Testing Result</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="{{ route('superadmin.laporan') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-people text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Total User</p>
                            <h5 class="mb-0">{{ \App\Models\User::count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-folder text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Total Proyek</p>
                            <h5 class="mb-0">{{ \App\Models\Project::count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-bug text-danger" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Total Bug</p>
                            <h5 class="mb-0">{{ \App\Models\BugReport::count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-check-circle text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Test Results</p>
                            <h5 class="mb-0">{{ \App\Models\TestResult::count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analysis Details -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart"></i> User Activity Trend</h5>
                </div>
                <div class="card-body">
                    <div id="activityChart" style="height: 300px;" class="d-flex align-items-center justify-content-center text-muted">
                        <p>Grafik aktivitas user (require Chart.js)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Project Status Distribution</h5>
                </div>
                <div class="card-body">
                    <div id="projectChart" style="height: 300px;" class="d-flex align-items-center justify-content-center text-muted">
                        <p>Distribusi status proyek (require Chart.js)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Report -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-table"></i> Detailed Analisis Data</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Total</th>
                                    <th>Aktif</th>
                                    <th>Persentase</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>User Activity</strong></td>
                                    <td>{{ \App\Models\ActivityLog::count() }}</td>
                                    <td>{{ \App\Models\ActivityLog::where('created_at', '>=', now()->subDay())->count() }}</td>
                                    <td>{{ round(\App\Models\ActivityLog::where('created_at', '>=', now()->subDay())->count() / max(\App\Models\ActivityLog::count(), 1) * 100, 2) }}%</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Project Status</strong></td>
                                    <td>{{ \App\Models\Project::count() }}</td>
                                    <td>{{ \App\Models\Project::where('status', 'ongoing')->count() }}</td>
                                    <td>{{ round(\App\Models\Project::where('status', 'ongoing')->count() / max(\App\Models\Project::count(), 1) * 100, 2) }}%</td>
                                    <td><span class="badge bg-primary">In Progress</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Bug Report</strong></td>
                                    <td>{{ \App\Models\BugReport::count() }}</td>
                                    <td>{{ \App\Models\BugReport::where('status', 'open')->count() }}</td>
                                    <td>{{ round(\App\Models\BugReport::where('status', 'open')->count() / max(\App\Models\BugReport::count(), 1) * 100, 2) }}%</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Test Results</strong></td>
                                    <td>{{ \App\Models\TestResult::count() }}</td>
                                    <td>{{ \App\Models\TestResult::where('status', 'passed')->count() }}</td>
                                    <td>{{ round(\App\Models\TestResult::where('status', 'passed')->count() / max(\App\Models\TestResult::count(), 1) * 100, 2) }}%</td>
                                    <td><span class="badge bg-success">Passed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Button -->
    <div class="row mt-4 mb-5">
        <div class="col-12 text-end">
            <button class="btn btn-success" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Report
            </button>
            <a href="{{ route('superadmin.alat.ekspor') }}" class="btn btn-info">
                <i class="bi bi-download"></i> Export to Excel
            </a>
        </div>
    </div>
</div>
@endsection