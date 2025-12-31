@extends('layouts.app')

@section('title', 'Kelola Proyek')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-diagram-3-fill text-warning"></i> Manajemen Proyek
            </h1>
            <p class="text-muted mb-0">Lihat dan kelola semua proyek dalam sistem</p>
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
            <form method="GET" action="{{ route('superadmin.proyek') }}" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau deskripsi proyek..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('superadmin.proyek') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">Nama Proyek</th>
                        <th class="fw-bold">Pemilik</th>
                        <th class="fw-bold">Deskripsi</th>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $project->name }}</strong>
                        </td>
                        <td>
                            <small>{{ $project->user->name ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($project->description, 50) }}</small>
                        </td>
                        <td>
                            @if($project->status === 'active')
                            <span class="badge bg-success">Aktif</span>
                            @elseif($project->status === 'completed')
                            <span class="badge bg-info">Selesai</span>
                            @else
                            <span class="badge bg-secondary">{{ ucfirst($project->status) }}</span>
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox"></i> Tidak ada proyek
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($projects->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $projects->links() }}
    </div>
    @endif
</div>
@endsection