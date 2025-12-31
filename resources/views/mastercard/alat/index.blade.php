@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Alat & Utilitas</h2>
            <p class="text-muted">Tools untuk administrasi sistem</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-download" style="font-size: 3rem; color: #0066cc;"></i>
                    <h5 class="card-title mt-3">Export Data</h5>
                    <p class="card-text">Export data pengguna dan laporan</p>
                    <button class="btn btn-primary">Buka</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-upload" style="font-size: 3rem; color: #00cc66;"></i>
                    <h5 class="card-title mt-3">Import Data</h5>
                    <p class="card-text">Import data dari file eksternal</p>
                    <button class="btn btn-success">Buka</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-archive" style="font-size: 3rem; color: #cc6600;"></i>
                    <h5 class="card-title mt-3">Backup</h5>
                    <p class="card-text">Buat backup data sistem</p>
                    <button class="btn btn-warning">Buka</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
