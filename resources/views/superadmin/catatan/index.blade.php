@extends('layouts.app')

@section('title', 'Manajemen Catatan')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-0">
                <i class="bi bi-sticky-fill"></i> Manajemen Catatan
            </h2>
            <p class="text-muted mt-1">Kelola semua catatan pribadi Anda</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('superadmin.catatan.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Catatan Baru
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('superadmin.catatan') }}" class="row g-3">
                <!-- Search -->
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Cari catatan..."
                        value="{{ request('search') }}">
                </div>

                <!-- Category Filter -->
                <div class="col-md-3">
                    <select class="form-select" name="category">
                        <option value="">Semua Kategori</option>
                        <option value="pribadi" {{ request('category') == 'pribadi' ? 'selected' : '' }}>Pribadi</option>
                        <option value="pekerjaan" {{ request('category') == 'pekerjaan' ? 'selected' : '' }}>Pekerjaan</option>
                        <option value="ide" {{ request('category') == 'ide' ? 'selected' : '' }}>Ide</option>
                        <option value="ingatkan" {{ request('category') == 'ingatkan' ? 'selected' : '' }}>Ingatkan</option>
                        <option value="lainnya" {{ request('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Filter & Reset Buttons -->
                <div class="col-md-5">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('superadmin.catatan') }}" class="btn btn-outline-secondary w-100 mt-2">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Notes Grid -->
    @forelse($notes as $note)
    <div class="row mb-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid var(--note-color)">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="flex-grow-1">
                            <div class="d-flex gap-2 align-items-center mb-1">
                                <h5 class="card-title mb-0">
                                    @if($note->is_pinned)
                                    <i class="bi bi-pin-fill text-warning"></i>
                                    @endif
                                    {{ $note->title }}
                                </h5>
                                <span class="badge bg-secondary">{{ ucfirst($note->category) }}</span>
                            </div>
                            <p class="card-text text-muted mb-2" style="font-size: 0.9rem;">
                                {{ Str::limit($note->content, 150) }}
                            </p>
                            <small class="text-muted">
                                <i class="bi bi-calendar3"></i>
                                {{ $note->created_at->format('d M Y H:i') }}
                            </small>
                        </div>

                        <!-- Actions -->
                        <div class="ms-3">
                            <div class="btn-group btn-group-sm">
                                @if(!$note->is_pinned)
                                <form action="{{ route('superadmin.catatan.pin', $note->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info" title="Pin catatan">
                                        <i class="bi bi-pin"></i>
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('superadmin.catatan.unpin', $note->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info" title="Unpin catatan">
                                        <i class="bi bi-pin-fill"></i>
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('superadmin.catatan.edit', $note->id) }}" class="btn btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $note->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $note->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title">Hapus Catatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus catatan "<strong>{{ $note->title }}</strong>"?</p>
                    <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('superadmin.catatan.destroy', $note->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <!-- Empty State -->
    <div class="text-center py-5">
        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
        <p class="text-muted mt-3">Belum ada catatan. <a href="{{ route('superadmin.catatan.create') }}">Buat catatan baru</a></p>
    </div>
    @endforelse

    <!-- Pagination -->
    @if($notes->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $notes->links() }}
    </div>
    @endif
</div>

<style>
    :root {
        --note-color: #ffc107;
    }

    .note-yellow {
        --note-color: #ffc107;
    }

    .note-blue {
        --note-color: #0d6efd;
    }

    .note-green {
        --note-color: #198754;
    }

    .note-pink {
        --note-color: #dc3545;
    }

    .note-purple {
        --note-color: #0dcaf0;
    }
</style>
@endsection