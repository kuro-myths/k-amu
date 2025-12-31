@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="page-title">Detail Proyek</h2>
                <a href="{{ route('leader.proyek') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <p class="text-muted">Informasi lengkap proyek</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $project->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Proyek</label>
                            <p><strong>{{ $project->name }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <p>
                                @if($project->status === 'planning')
                                <span class="badge bg-secondary">Perencanaan</span>
                                @elseif($project->status === 'in_progress')
                                <span class="badge bg-primary">Berjalan</span>
                                @elseif($project->status === 'completed')
                                <span class="badge bg-success">Selesai</span>
                                @else
                                <span class="badge bg-warning">Ditangguhkan</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <p>{{ $project->start_date->format('d M Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deadline</label>
                            <p>{{ $project->end_date ? $project->end_date->format('d M Y') : 'Belum ditentukan' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Progress</label>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar" role="progressbar" @style(['width: ' . $project->progress . ' %']) aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $project->progress }}%
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <p>{{ $project->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Anggota Tim ({{ count($teamUsers) }})</h5>
                </div>
                <div class="card-body">
                    @if(count($teamUsers) > 0)
                    <div class="list-group">
                        @foreach($teamUsers as $member)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span>{{ $member->name }}</span>
                                <small class="badge bg-info">{{ ucfirst($member->role) }}</small>
                            </div>
                            <small class="text-muted">{{ $member->email }}</small>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted text-center">Belum ada anggota tim</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Aksi Proyek</h5>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('leader.proyek') }}" class="btn btn-outline-secondary">Edit</a>
                    <form action="#" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus proyek ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection