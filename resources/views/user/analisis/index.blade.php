@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Progress Belajar</h2>
            <p class="text-muted">Pantau perkembangan dan kemajuan Anda</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Grafik Progress</h5>
                </div>
                <div class="card-body">
                    <div id="progressChart" style="height: 300px; background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                        <p class="text-muted">Grafik progress akan ditampilkan di sini</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted mb-1">Level</p>
                        <h4>{{ $user->level }}</h4>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1">Poin Total</p>
                        <h4>{{ $user->points }}</h4>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1">Status</p>
                        <h4><span class="badge bg-success">Aktif</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Achievement & Badge</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 mb-3 text-center">
                            <i class="bi bi-star" style="font-size: 3rem; color: #ffc107;"></i>
                            <p class="mt-2 small">Pemula</p>
                        </div>
                        <div class="col-md-2 mb-3 text-center">
                            <i class="bi bi-book" style="font-size: 3rem; color: #6c757d;"></i>
                            <p class="mt-2 small">Pelajar</p>
                        </div>
                        <div class="col-md-2 mb-3 text-center">
                            <i class="bi bi-check-circle" style="font-size: 3rem; color: #6c757d;"></i>
                            <p class="mt-2 small">Selesai Kursus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection