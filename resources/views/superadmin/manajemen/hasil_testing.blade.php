@extends('layouts.app')

@section('title', 'Kelola Hasil Testing')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-check2-square text-success"></i> Hasil Testing
            </h1>
            <p class="text-muted mb-0">Lihat hasil pengujian semua proyek</p>
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
            <form method="GET" action="{{ route('superadmin.hasil-testing') }}" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari proyek atau tester..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="passed" {{ request('status') === 'passed' ? 'selected' : '' }}>Lulus</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Tertunda</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('superadmin.hasil-testing') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Test Results Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">Proyek</th>
                        <th class="fw-bold">Tester</th>
                        <th class="fw-bold">Total Test</th>
                        <th class="fw-bold">Lulus</th>
                        <th class="fw-bold">Gagal</th>
                        <th class="fw-bold">Pass Rate</th>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">Tanggal</th>
                        <th class="fw-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $result->project->name ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            <small>{{ $result->tester->name ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $result->total_tests ?? 0 }}</span>
                        </td>
                        <td>
                            <span class="badge bg-success">{{ $result->passed_tests ?? 0 }}</span>
                        </td>
                        <td>
                            <span class="badge bg-danger">{{ $result->failed_tests ?? 0 }}</span>
                        </td>
                        <td>
                            @php
                            $passRate = $result->total_tests > 0 ? round(($result->passed_tests / $result->total_tests) * 100) : 0;
                            $barClass = $passRate >= 80 ? 'bg-success' : ($passRate >= 50 ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar {{ $barClass }}"
                                    role="progressbar"
                                    aria-valuenow="{{ $passRate }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    @style(['width: ' . $passRate . ' %'])>
                                    {{ $passRate }}%
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($result->status === 'passed')
                            <span class="badge bg-success">Lulus</span>
                            @elseif($result->status === 'failed')
                            <span class="badge bg-danger">Gagal</span>
                            @else
                            <span class="badge bg-secondary">Tertunda</span>
                            @endif
                        </td>
                        <td>
                            <small>{{ $result->created_at->format('d M Y') }}</small>
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
                        <td colspan="10" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox"></i> Tidak ada hasil testing
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($results->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $results->links() }}
    </div>
    @endif
</div>
@endsection