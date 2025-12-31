@extends('layouts.app')

@section('title', 'Kelola Laporan Bug')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-bug-fill text-danger"></i> Laporan Bug
            </h1>
            <p class="text-muted mb-0">Lihat dan kelola semua laporan bug dalam sistem</p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filter & Search -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('superadmin.laporan-bug') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul atau deskripsi..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Terbuka</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Ditutup</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('superadmin.laporan-bug') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bug Reports Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">Judul</th>
                        <th class="fw-bold">Proyek</th>
                        <th class="fw-bold">Pelapor</th>
                        <th class="fw-bold">Prioritas</th>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bugs as $bug)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $bug->title }}</strong><br>
                            <small class="text-muted">{{ Str::limit($bug->description, 40) }}</small>
                        </td>
                        <td>
                            <small>{{ $bug->project->name ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <small>{{ $bug->user->name ?? 'N/A' }}</small>
                        </td>
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
                            <span class="badge bg-success">Terbuka</span>
                            @elseif($bug->status === 'in_progress')
                            <span class="badge bg-primary">Sedang Dikerjakan</span>
                            @else
                            <span class="badge bg-secondary">Ditutup</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox"></i> Tidak ada laporan bug
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($bugs->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $bugs->links() }}
    </div>
    @endif
</div>
@endsection