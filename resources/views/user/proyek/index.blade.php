@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Daftar Proyek</h2>
            <p class="text-muted">Proyek-proyek yang tersedia untuk diikuti</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Proyek Aktif ({{ $projects->total() }})</h5>
        </div>
        <div class="card-body">
            @if($projects->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Proyek</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Deadline</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>
                                <strong>{{ $project->name }}</strong>
                                <br />
                                <small class="text-muted">{{ Str::limit($project->description, 50) }}</small>
                            </td>
                            <td>
                                @if($project->status === 'planning')
                                <span class="badge bg-secondary">Perencanaan</span>
                                @elseif($project->status === 'in_progress')
                                <span class="badge bg-primary">Berjalan</span>
                                @elseif($project->status === 'completed')
                                <span class="badge bg-success">Selesai</span>
                                @else
                                <span class="badge bg-warning">Ditangguhkan</span>
                                @endif
                            </td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" @style(['width: ' . $project->progress . ' %']) aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $project->progress }}%
                                    </div>
                                </div>
                            </td>
                            <td>{{ $project->end_date ? $project->end_date->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $projects->links() }}
            </div>
            @else
            <div class="alert alert-info">
                Belum ada proyek yang tersedia.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection