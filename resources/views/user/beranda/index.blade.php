@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Dashboard Saya</h2>
            <p class="text-muted">Selamat datang, {{ Auth::user()->name }}! ({{ ucfirst(Auth::user()->user_type) }})</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Level</p>
                            <h3 class="card-title">{{ Auth::user()->level }}</h3>
                        </div>
                        <i class="bi bi-star text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Poin</p>
                            <h3 class="card-title">{{ Auth::user()->points }}</h3>
                        </div>
                        <i class="bi bi-award text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text text-muted">Catatan</p>
                            <h3 class="card-title">{{ $notes ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-file-text text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('user.catatan') }}" class="btn btn-outline-primary w-100">
                                <i class="bi bi-file-text"></i> Catatan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('user.proyek') }}" class="btn btn-outline-info w-100">
                                <i class="bi bi-briefcase"></i> Proyek
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('user.analisis') }}" class="btn btn-outline-success w-100">
                                <i class="bi bi-graph-up"></i> Progress
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="{{ route('user.obrolan') }}" class="btn btn-outline-warning w-100">
                                <i class="bi bi-chat-dots"></i> Chat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection