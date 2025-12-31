@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Proyek Saya</h2>
            <p class="text-muted">Kelola proyek yang Anda pimpin</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Proyek ({{ $projects->total() }})</h5>
                <a href="{{ route('leader.proyek.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Buat Proyek Baru
                </a>
            </div>
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
                            <th>Anggota</th>
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
                                @php
                                $teamCount = $project->team_members ? count(json_decode($project->team_members, true)) : 0;
                                @endphp
                                {{ $teamCount }} Orang
                            </td>
                            <td>
                                <a href="{{ route('leader.proyek.detail', $project->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
                <p class="mb-0">Belum ada proyek. <a href="{{ route('leader.proyek.create') }}" class="alert-link">Buat proyek baru</a></p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection