@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Catatan Aktivitas</h2>
            <p class="text-muted">Log semua aktivitas pengguna</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Activity Log ({{ $activities->total() }})</h5>
        </div>
        <div class="card-body">
            @if($activities->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Waktu</th>
                            <th>Pengguna</th>
                            <th>Aktivitas</th>
                            <th>Model</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                        <tr>
                            <td><small class="text-muted">{{ $activity->created_at->format('d M Y H:i:s') }}</small></td>
                            <td>{{ $activity->user ? $activity->user->name : 'System' }}</td>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst(str_replace('_', ' ', $activity->action)) }}</span>
                            </td>
                            <td><small>{{ $activity->model ?? '-' }}</small></td>
                            <td><small class="text-muted">{{ $activity->ip_address ?? '-' }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                {{ $activities->links() }}
            </nav>
            @else
            <div class="alert alert-info text-center">
                <p class="mb-0">Belum ada aktivitas</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection