@extends('superadmin.layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-clock-history"></i> Log Aktivitas
            </h2>
        </div>
        <div class="col-md-6 text-end">
            <form class="d-inline-flex gap-2" action="{{ route('superadmin.log-aktivitas') }}" method="get">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari aktivitas..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="15%">Waktu</th>
                        <th width="15%">User</th>
                        <th width="15%">Aksi</th>
                        <th width="15%">Model</th>
                        <th width="25%">Deskripsi</th>
                        <th width="15%">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td>
                            <small class="text-muted">
                                {{ $log->created_at->format('d M Y H:i') }}
                            </small>
                        </td>
                        <td>
                            @if($log->user)
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $log->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($log->user->name) }}"
                                    alt="{{ $log->user->name }}"
                                    class="rounded-circle"
                                    width="32"
                                    height="32">
                                <div>
                                    <div class="fw-semibold">{{ $log->user->name }}</div>
                                    <small class="text-muted">{{ $log->user->email }}</small>
                                </div>
                            </div>
                            @else
                            <span class="text-muted">System</span>
                            @endif
                        </td>
                        <td>
                            @php
                            $actionBadges = [
                            'create' => 'success',
                            'update' => 'info',
                            'delete' => 'danger',
                            'restore' => 'warning',
                            'login' => 'primary',
                            'logout' => 'secondary',
                            'view' => 'light',
                            'download' => 'info',
                            ];
                            $badgeClass = $actionBadges[$log->action] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $badgeClass }}">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ str_replace('App\\Models\\', '', $log->model) }}
                            </small>
                        </td>
                        <td>
                            <small>{{ $log->description ?? '-' }}</small>
                        </td>
                        <td>
                            <small class="text-muted font-monospace">{{ $log->ip_address ?? '-' }}</small>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                <p class="mt-2">Tidak ada aktivitas</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
        <div class="card-footer bg-white border-top">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

    <!-- Statistik Aktivitas -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Total Aktivitas</p>
                            <h4 class="mb-0">{{ \App\Models\ActivityLog::count() }}</h4>
                        </div>
                        <i class="bi bi-clock-history text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Aktivitas Hari Ini</p>
                            <h4 class="mb-0">{{ \App\Models\ActivityLog::whereDate('created_at', today())->count() }}</h4>
                        </div>
                        <i class="bi bi-calendar-today text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Aktivitas Minggu Ini</p>
                            <h4 class="mb-0">{{ \App\Models\ActivityLog::where('created_at', '>=', now()->startOfWeek())->count() }}</h4>
                        </div>
                        <i class="bi bi-calendar-week text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1">User Aktif</p>
                            <h4 class="mb-0">{{ \App\Models\ActivityLog::distinct('user_id')->count('user_id') }}</h4>
                        </div>
                        <i class="bi bi-people text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection