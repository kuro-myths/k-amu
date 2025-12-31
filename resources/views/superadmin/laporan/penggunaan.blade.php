@extends('layouts.app')

@section('title', 'Laporan Penggunaan Sistem')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-graph-up"></i> Laporan Penggunaan Sistem
            </h2>
            <p class="text-muted mt-1">Analisis penggunaan dan aktivitas pengguna</p>
        </div>
    </div>

    <!-- Date Range Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('superadmin.laporan') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" name="dari_tanggal" class="form-control" value="{{ request('dari_tanggal', now()->subMonth()->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" name="sampai_tanggal" class="form-control" value="{{ request('sampai_tanggal', now()->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="{{ route('superadmin.laporan') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-person-check text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">User Aktif</p>
                            <h5 class="mb-0">
                                {{ \App\Models\ActivityLog::where('created_at', '>=', now()->subMonth())->distinct('user_id')->count('user_id') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-clock-history text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Total Aktivitas</p>
                            <h5 class="mb-0">
                                {{ \App\Models\ActivityLog::where('created_at', '>=', now()->subMonth())->count() }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-percent text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Rata-rata Aktivitas/Hari</p>
                            <h5 class="mb-0">
                                {{ round(\App\Models\ActivityLog::where('created_at', '>=', now()->subMonth())->count() / 30, 1) }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity by User -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-people"></i> Aktivitas Pengguna</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Total Aktivitas</th>
                                    <th>Aktivitas Hari Ini</th>
                                    <th>Terakhir Aktif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\User::withCount('activityLogs')->get() as $user)
                                <tr>
                                    <td><strong>{{ $user->name }}</strong></td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-info">{{ $user->role }}</span></td>
                                    <td>{{ $user->activity_logs_count }}</td>
                                    <td>
                                        {{ \App\Models\ActivityLog::where('user_id', $user->id)
                                                ->where('created_at', '>=', now()->startOfDay())
                                                ->count() }}
                                    </td>
                                    <td>
                                        {{ $user->activityLogs()
                                                ->latest()
                                                ->first()
                                                ?->created_at
                                                ?->diffForHumans() ?? 'Belum aktif' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Tidak ada data user
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

    <!-- Activity Type Distribution -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Jenis Aktivitas</h5>
                </div>
                <div class="card-body">
                    <div id="activityTypeChart" style="height: 300px;" class="d-flex align-items-center justify-content-center text-muted">
                        <p>Grafik jenis aktivitas (require Chart.js)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Aktivitas per Jam</h5>
                </div>
                <div class="card-body">
                    <div id="hourlyChart" style="height: 300px;" class="d-flex align-items-center justify-content-center text-muted">
                        <p>Grafik aktivitas per jam (require Chart.js)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-list-check"></i> Aktivitas Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>User</th>
                                    <th>Aksi</th>
                                    <th>Model</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\ActivityLog::latest()->take(50)->get() as $log)
                                <tr>
                                    <td>
                                        <small class="text-muted">{{ $log->created_at->format('d M Y H:i') }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $log->user->name ?? 'Unknown' }}</strong>
                                    </td>
                                    <td>
                                        @if($log->action === 'create')
                                        <span class="badge bg-success">Buat</span>
                                        @elseif($log->action === 'update')
                                        <span class="badge bg-info">Ubah</span>
                                        @elseif($log->action === 'delete')
                                        <span class="badge bg-danger">Hapus</span>
                                        @else
                                        <span class="badge bg-secondary">{{ ucfirst($log->action) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $log->model_type ?? '-' }}</td>
                                    <td>{{ Str::limit($log->description ?? '-', 50) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Tidak ada aktivitas
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
</div>
@endsection