@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Dashboard Pemimpin</h2>
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
                            <p class="card-text text-muted">Proyek Aktif</p>
                            <h3 class="card-title">{{ $projects ?? 12 }}</h3>
                        </div>
                        <i class="bi bi-folder text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Anggota Tim</p>
                            <h3 class="card-title">24</h3>
                        </div>
                        <i class="bi bi-people text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Bimbingan</p>
                            <h3 class="card-title">8</h3>
                        </div>
                        <i class="bi bi-person-check text-info" style="font-size: 2rem;"></i>
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
                            <h3 class="card-title">{{ $notes ?? 16 }}</h3>
                        </div>
                        <i class="bi bi-file-text text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Proyek Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Proyek</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sistem K-AMU</td>
                                    <td><span class="badge bg-primary">Berjalan</span></td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" style="width: 75%">75%</div>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('leader.proyek') }}" class="btn btn-sm btn-info">Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>Web Portal</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" style="width: 100%">100%</div>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('leader.proyek') }}" class="btn btn-sm btn-info">Lihat</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Peringatan</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> Ada 3 tugas yang belum dikerjakan
                    </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle"></i> Laporan bulanan akan dibuka minggu depan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection