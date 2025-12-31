@extends('layouts.app')

@section('title', 'Catatan Aktivitas')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-clock-history text-info"></i> Catatan Aktivitas
            </h1>
            <p class="text-muted mb-0">Log semua aktivitas pengguna dalam sistem</p>
        </div>
    </div>

    <!-- Activity Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Aktivitas Hari Ini</h6>
                            <h4 class="text-primary fw-bold mb-0">{{ \App\Models\ActivityLog::whereDate('created_at', today())->count() }}</h4>
                        </div>
                        <i class="bi bi-graph-up text-primary" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Pengguna Aktif</h6>
                            <h4 class="text-success fw-bold mb-0">{{ \App\Models\ActivityLog::distinct('user_id')->count('user_id') }}</h4>
                        </div>
                        <i class="bi bi-people-fill text-success" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Tipe Aktivitas</h6>
                            <h4 class="text-warning fw-bold mb-0">{{ \App\Models\ActivityLog::distinct('action')->count('action') }}</h4>
                        </div>
                        <i class="bi bi-list-task text-warning" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Aktivitas</h6>
                            <h4 class="text-danger fw-bold mb-0">{{ \App\Models\ActivityLog::count() }}</h4>
                        </div>
                        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('superadmin.catatan-aktivitas') }}" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari pengguna atau aksi..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="tipe" class="form-select">
                        <option value="">Semua Tipe Aktivitas</option>
                        <option value="login" {{ request('tipe') === 'login' ? 'selected' : '' }}>Login</option>
                        <option value="logout" {{ request('tipe') === 'logout' ? 'selected' : '' }}>Logout</option>
                        <option value="create" {{ request('tipe') === 'create' ? 'selected' : '' }}>Buat</option>
                        <option value="update" {{ request('tipe') === 'update' ? 'selected' : '' }}>Perbarui</option>
                        <option value="delete" {{ request('tipe') === 'delete' ? 'selected' : '' }}>Hapus</option>
                        <option value="download" {{ request('tipe') === 'download' ? 'selected' : '' }}>Download</option>
                        <option value="upload" {{ request('tipe') === 'upload' ? 'selected' : '' }}>Upload</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('superadmin.catatan-aktivitas') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light border-0">
            <h5 class="mb-0">Timeline Aktivitas</h5>
        </div>
        <div class="card-body">
            <div class="timeline">
                @forelse($logs as $log)
                @php
                $actionIcons = [
                'login' => 'bi-box-arrow-in-right',
                'logout' => 'bi-box-arrow-right',
                'create_note' => 'bi-plus-circle',
                'update_note' => 'bi-pencil-square',
                'delete_note' => 'bi-trash',
                'send_message' => 'bi-chat-dots',
                'create_project' => 'bi-plus-circle',
                'update_project' => 'bi-pencil-square',
                'create_bug' => 'bi-bug',
                'update_bug' => 'bi-pencil-square',
                'create_test' => 'bi-check-circle',
                'update_test' => 'bi-pencil-square',
                'change_password' => 'bi-key',
                'update_profile' => 'bi-person-fill',
                'export_data' => 'bi-download',
                'import_data' => 'bi-upload',
                'system_config' => 'bi-gear',
                'user_management' => 'bi-people-fill',
                ];

                $actionBadges = [
                'login' => 'secondary',
                'logout' => 'secondary',
                'create_note' => 'success',
                'update_note' => 'warning',
                'delete_note' => 'danger',
                'send_message' => 'info',
                'create_project' => 'success',
                'update_project' => 'warning',
                'create_bug' => 'danger',
                'update_bug' => 'warning',
                'create_test' => 'success',
                'update_test' => 'warning',
                'change_password' => 'info',
                'update_profile' => 'info',
                'export_data' => 'primary',
                'import_data' => 'primary',
                'system_config' => 'danger',
                'user_management' => 'warning',
                ];

                $actionLabels = [
                'login' => 'Login',
                'logout' => 'Logout',
                'create_note' => 'Create',
                'update_note' => 'Update',
                'delete_note' => 'Delete',
                'send_message' => 'Message',
                'create_project' => 'Create',
                'update_project' => 'Update',
                'create_bug' => 'Create',
                'update_bug' => 'Update',
                'create_test' => 'Create',
                'update_test' => 'Update',
                'change_password' => 'Password',
                'update_profile' => 'Profile',
                'export_data' => 'Export',
                'import_data' => 'Import',
                'system_config' => 'Config',
                'user_management' => 'Management',
                ];

                $icon = $actionIcons[$log->action] ?? 'bi-circle';
                $badge = $actionBadges[$log->action] ?? 'secondary';
                $label = $actionLabels[$log->action] ?? ucfirst($log->action);
                @endphp

                <div class="timeline-item mb-4 pb-4 border-bottom">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm bg-{{ $badge }} text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi {{ $icon }}"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div>
                                    <h6 class="mb-1 fw-bold">
                                        {{ $log->action }}
                                        @if($log->user)
                                        - {{ $log->user->name }}
                                        @endif
                                    </h6>
                                    <small class="text-muted">
                                        @if($log->user)
                                        <i class="bi bi-person"></i> {{ $log->user->email }}
                                        @endif
                                        @if($log->ip_address)
                                        <i class="bi bi-geo-alt ms-2"></i> {{ $log->ip_address }}
                                        @endif
                                    </small>
                                </div>
                                <span class="badge bg-{{ $badge }}">{{ $label }}</span>
                            </div>
                            <p class="text-muted small mb-0">{{ $log->description ?? '-' }}</p>
                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <p class="text-muted">Tidak ada aktivitas</p>
                </div>
                @endforelse
            </div>
        </div>

        @if($logs->hasPages())
        <div class="card-footer bg-white border-top">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding-left: 0;
    }

    .timeline-item {
        position: relative;
        padding-left: 0;
        transition: all 0.3s ease;
    }

    .timeline-item:hover {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-left: -1rem;
        margin-right: -1rem;
    }

    .avatar-sm {
        min-width: 40px;
        min-height: 40px;
        flex-shrink: 0;
    }

    /* Pagination Styling */
    .pagination {
        gap: 0.25rem;
        flex-wrap: wrap;
    }

    .pagination .page-link {
        color: #0d6efd;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.15s ease-in-out;
    }

    .pagination .page-link:hover {
        color: #0a58ca;
        background-color: #e7f1ff;
        border-color: #0d6efd;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #dee2e6;
    }

    /* Badge Styling */
    .badge {
        font-weight: 600;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }

    /* Card Hover Effect */
    .card {
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Timeline Item Border */
    .timeline-item:last-child {
        border-bottom: none !important;
    }
</style>
@endsection