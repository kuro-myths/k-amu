@extends('layouts.app')

@section('title', 'Alat & Utilitas')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-tools"></i> Alat & Utilitas
            </h2>
            <p class="text-muted mt-1">Alat bantu untuk mengelola sistem</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Tools Grid -->
    <div class="row">
        <!-- Clear Cache -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-trash3 text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="card-title mb-0">Hapus Cache</h5>
                    </div>
                    <p class="text-muted small mb-3">Hapus semua cache aplikasi untuk meningkatkan performa.</p>
                    <form action="{{ route('superadmin.alat.clearCache') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary w-100"
                            onclick="return confirm('Yakin hapus cache?')">
                            <i class="bi bi-trash3"></i> Jalankan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Optimize Database -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-speedometer2 text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="card-title mb-0">Optimasi Database</h5>
                    </div>
                    <p class="text-muted small mb-3">Optimalkan tabel database untuk performa lebih baik.</p>
                    <form action="{{ route('superadmin.alat.optimizeDB') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success w-100"
                            onclick="return confirm('Yakin optimasi database?')">
                            <i class="bi bi-speedometer2"></i> Jalankan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sync Permissions -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-shield-check text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="card-title mb-0">Sinkronisasi Permissions</h5>
                    </div>
                    <p class="text-muted small mb-3">Sinkronisasi permission dan role di sistem.</p>
                    <form action="{{ route('superadmin.alat.syncPermissions') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-warning w-100"
                            onclick="return confirm('Yakin sinkronisasi permissions?')">
                            <i class="bi bi-shield-check"></i> Jalankan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Backup Database -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-cloud-download text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="card-title mb-0">Backup Database</h5>
                    </div>
                    <p class="text-muted small mb-3">Download backup lengkap database aplikasi.</p>
                    <button type="button" class="btn btn-sm btn-info w-100" disabled>
                        <i class="bi bi-cloud-download"></i> Jalankan
                    </button>
                </div>
            </div>
        </div>

        <!-- Clear Logs -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-file-earmark-x text-danger" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="card-title mb-0">Hapus Log Sistem</h5>
                    </div>
                    <p class="text-muted small mb-3">Hapus semua log sistem yang lama.</p>
                    <form action="{{ route('superadmin.alat.clearLogs') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger w-100"
                            onclick="return confirm('Yakin hapus log sistem?')">
                            <i class="bi bi-file-earmark-x"></i> Jalankan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reset Demo Data -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-secondary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-arrow-clockwise text-secondary" style="font-size: 1.5rem;"></i>
                        </div>
                        <h5 class="card-title mb-0">Reset Demo</h5>
                    </div>
                    <p class="text-muted small mb-3">Reset semua data demo ke kondisi awal.</p>
                    <form action="{{ route('superadmin.alat.resetDemo') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-secondary w-100"
                            onclick="return confirm('PERHATIAN: Ini akan menghapus semua data. Yakin?')">
                            <i class="bi bi-arrow-clockwise"></i> Jalankan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info Card -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-light p-3">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle"></i> Informasi Sistem
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-muted small mb-1">Server Time</p>
                            <p class="fw-semibold">{{ now()->format('d M Y H:i:s') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted small mb-1">Total Users</p>
                            <p class="fw-semibold">{{ $totalUsers ?? 0 }} pengguna</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted small mb-1">Total Activity Logs</p>
                            <p class="fw-semibold">{{ $totalLogs ?? 0 }} logs</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted small mb-1">Database Size</p>
                            <p class="fw-semibold">{{ $dbSize ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Maintenance -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-light p-3">
                    <h6 class="mb-0">
                        <i class="bi bi-clock-history"></i> Riwayat Pemeliharaan
                    </h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                                <th>Oleh</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><small class="text-muted">{{ now()->format('d M Y H:i') }}</small></td>
                                <td><small>Cache dibersihkan</small></td>
                                <td><small class="badge bg-light text-dark">{{ auth()->user()->name }}</small></td>
                                <td><small><span class="badge bg-success">Berhasil</span></small></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Belum ada aktivitas pemeliharaan
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection