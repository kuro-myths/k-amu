@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Profil Saya</h2>
            <p class="text-muted">Kelola informasi profil pribadi</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="https://via.placeholder.com/150" alt="Avatar" class="rounded-circle mb-3" width="150">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p class="badge bg-primary">{{ ucfirst($user->user_type) }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <p>{{ $user->phone ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipe Pengguna</label>
                            <p><span class="badge bg-info">{{ ucfirst($user->user_type) }}</span></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Bio</label>
                            <p>{{ $user->bio ?? '-' }}</p>
                        </div>
                    </div>
                    <button class="btn btn-primary">Edit Profil</button>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-muted mb-1">Level</p>
                            <h4>{{ $user->level }}</h4>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1">Poin</p>
                            <h4>{{ $user->points }}</h4>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1">Bergabung</p>
                            <h4>{{ $user->created_at->format('d M Y') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection