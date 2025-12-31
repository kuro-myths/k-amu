@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Dashboard QA Tester</h2>
            <p class="text-muted">Selamat datang, {{ Auth::user()->name }}!</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Bug Reports</p>
                            <h3 class="card-title">{{ $totalBugs ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-bug text-danger" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Test Results</p>
                            <h3 class="card-title">{{ $totalTests ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Catatan</p>
                            <h3 class="card-title">{{ $notes ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-file-text text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Status</p>
                            <h3 class="card-title">Aktif</h3>
                        </div>
                        <i class="bi bi-check-circle text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('tester.laporan') }}" class="btn btn-outline-danger w-100">
                                <i class="bi bi-bug"></i> Bug Reports
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('tester.tools') }}" class="btn btn-outline-success w-100">
                                <i class="bi bi-check-circle"></i> Test Results
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('tester.analisis') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-graph-up"></i> Analisis
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('tester.catatan') }}" class="btn btn-outline-info w-100">
                                <i class="bi bi-file-text"></i> Catatan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<h3 class="text-lg font-semibold text-gray-800 mb-4">Akses Cepat</h3>
<div class="space-y-2">
    <a href="{{ route('tester.tools') }}" class="block p-3 bg-blue-50 rounded hover:bg-blue-100 transition">
        <i class="fas fa-tools text-blue-600 mr-2"></i>
        <span class="font-semibold text-gray-800">Tools & Bug</span>
    </a>
    <a href="{{ route('tester.monitoring') }}" class="block p-3 bg-green-50 rounded hover:bg-green-100 transition">
        <i class="fas fa-eye text-green-600 mr-2"></i>
        <span class="font-semibold text-gray-800">Monitoring</span>
    </a>
    <a href="{{ route('tester.laporan') }}" class="block p-3 bg-purple-50 rounded hover:bg-purple-100 transition">
        <i class="fas fa-chart-bar text-purple-600 mr-2"></i>
        <span class="font-semibold text-gray-800">Laporan</span>
    </a>
    <a href="{{ route('tester.statistik') }}" class="block p-3 bg-yellow-50 rounded hover:bg-yellow-100 transition">
        <i class="fas fa-percent text-yellow-600 mr-2"></i>
        <span class="font-semibold text-gray-800">Statistik</span>
    </a>
</div>
</div>
</div>
@endsection