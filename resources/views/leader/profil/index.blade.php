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
                    <h5 class="card-title">{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->email }}</p>
                    <p class="badge bg-primary">Leader</p>
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
                            <p>{{ auth()->user()->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <p>{{ auth()->user()->phone ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <p><span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span></p>
                        </div>
                    </div>
                    <button class="btn btn-primary">Edit Profil</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection