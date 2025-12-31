@extends('layouts.app')

@section('title', 'Laporan Bug')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-bug-fill"></i> Laporan Bug
            </h2>
            <p class="text-muted mt-1">Ringkasan dan analisis laporan bug</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('superadmin.laporan') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="open">Terbuka</option>
                                <option value="in_progress">Sedang Dikerjakan</option>
                                <option value="resolved">Terselesaikan</option>
                                <option value="closed">Ditutup</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Prioritas</label>
                            <select name="prioritas" class="form-select">
                                <option value="">Semua Prioritas</option>
                                <option value="low">Rendah</option>
                                <option value="medium">Sedang</option>
                                <option value="high">Tinggi</option>
                                <option value="critical">Kritis</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Periode</label>
                            <select name="periode" class="form-select">
                                <option value="all">Semua Waktu</option>
                                <option value="today">Hari Ini</option>
                                <option value="week">Minggu Ini</option>
                                <option value="month" selected>Bulan Ini</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
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
                        <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-exclamation-circle text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Terbuka</p>
                            <h5 class="mb-0">{{ \App\Models\BugReport::where('status', 'open')->count() }}</h5>
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
                            <i class="bi bi-arrow-repeat text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Sedang Dikerjakan</p>
                            <h5 class="mb-0">{{ \App\Models\BugReport::where('status', 'in_progress')->count() }}</h5>
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
                            <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Terselesaikan</p>
                            <h5 class="mb-0">{{ \App\Models\BugReport::where('status', 'resolved')->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bug Report List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-list-check"></i> Daftar Bug Report</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Prioritas</th>
                                    <th>Status</th>
                                    <th>Reporter</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\BugReport::latest()->take(20)->get() as $bug)
                                <tr>
                                    <td><strong>#{{ $bug->id }}</strong></td>
                                    <td>{{ Str::limit($bug->title, 30) }}</td>
                                    <td>
                                        @if($bug->priority === 'critical')
                                        <span class="badge bg-danger">Kritis</span>
                                        @elseif($bug->priority === 'high')
                                        <span class="badge bg-warning">Tinggi</span>
                                        @elseif($bug->priority === 'medium')
                                        <span class="badge bg-info">Sedang</span>
                                        @else
                                        <span class="badge bg-secondary">Rendah</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($bug->status === 'open')
                                        <span class="badge bg-danger">Terbuka</span>
                                        @elseif($bug->status === 'in_progress')
                                        <span class="badge bg-warning">Dikerjakan</span>
                                        @elseif($bug->status === 'resolved')
                                        <span class="badge bg-success">Selesai</span>
                                        @else
                                        <span class="badge bg-secondary">Ditutup</span>
                                        @endif
                                    </td>
                                    <td>{{ $bug->reporter_name ?? 'Unknown' }}</td>
                                    <td>{{ $bug->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('superadmin.laporan-bug') }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Tidak ada bug report
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

    <!-- Summary Chart -->
    <div class="row mt-4 mb-5">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Distribusi Status</h5>
                </div>
                <div class="card-body">
                    <div id="statusChart" style="height: 300px;" class="d-flex align-items-center justify-content-center text-muted">
                        <p>Grafik distribusi status (require Chart.js)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Distribusi Prioritas</h5>
                </div>
                <div class="card-body">
                    <div id="priorityChart" style="height: 300px;" class="d-flex align-items-center justify-content-center text-muted">
                        <p>Grafik distribusi prioritas (require Chart.js)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection