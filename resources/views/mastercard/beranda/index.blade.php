@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Dashboard Mastercard</h2>
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
                            <p class="card-text text-muted">Total Pengguna</p>
                            <h3 class="card-title">{{ $users ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
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
                        <i class="bi bi-file-text text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Aktivitas</p>
                            <h3 class="card-title">{{ $activities ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-graph-up text-info" style="font-size: 2rem;"></i>
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
                            <a href="{{ route('mastercard.manajemen.pengguna') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-people"></i> Kelola Pengguna
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('mastercard.catatan-aktivitas') }}" class="btn btn-outline-info w-100">
                                <i class="bi bi-journal"></i> Log Aktivitas
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('mastercard.alat') }}" class="btn btn-outline-success w-100">
                                <i class="bi bi-tools"></i> Tools
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('mastercard.catatan') }}" class="btn btn-outline-warning w-100">
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