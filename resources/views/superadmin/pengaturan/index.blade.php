@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-gear-fill"></i> Pengaturan Sistem
            </h2>
            <p class="text-muted mt-1">Kelola konfigurasi aplikasi K-AMU</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Settings Tabs -->
    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button">
                <i class="bi bi-info-circle"></i> Umum
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="display-tab" data-bs-toggle="tab" data-bs-target="#display" type="button">
                <i class="bi bi-palette"></i> Tampilan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification" type="button">
                <i class="bi bi-bell"></i> Notifikasi
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="maintenance-tab" data-bs-toggle="tab" data-bs-target="#maintenance" type="button">
                <i class="bi bi-tools"></i> Sistem
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- General Settings -->
        <div class="tab-pane fade show active" id="general" role="tabpanel">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Pengaturan Umum</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('superadmin.pengaturan.update') }}">
                                @csrf

                                <!-- App Name -->
                                <div class="mb-3">
                                    <label for="appName" class="form-label fw-semibold">
                                        <i class="bi bi-app"></i> Nama Aplikasi
                                    </label>
                                    <input type="text" class="form-control" id="appName" name="app_name" value="K-AMU" required>
                                </div>

                                <!-- App Description -->
                                <div class="mb-3">
                                    <label for="appDesc" class="form-label fw-semibold">
                                        <i class="bi bi-file-text"></i> Deskripsi
                                    </label>
                                    <textarea class="form-control" id="appDesc" name="app_description" rows="3">Sistem Manajemen Akademik Universitas</textarea>
                                </div>

                                <!-- Support Email -->
                                <div class="mb-3">
                                    <label for="supportEmail" class="form-label fw-semibold">
                                        <i class="bi bi-envelope"></i> Email Dukungan
                                    </label>
                                    <input type="email" class="form-control" id="supportEmail" name="support_email" value="support@k-amu.test" required>
                                </div>

                                <!-- Support Phone -->
                                <div class="mb-3">
                                    <label for="supportPhone" class="form-label fw-semibold">
                                        <i class="bi bi-telephone"></i> Nomor Telepon
                                    </label>
                                    <input type="tel" class="form-control" id="supportPhone" name="support_phone" value="+62 812 3456 7890">
                                </div>

                                <!-- Timezone -->
                                <div class="mb-3">
                                    <label for="timezone" class="form-label fw-semibold">
                                        <i class="bi bi-globe"></i> Zona Waktu
                                    </label>
                                    <select class="form-select" id="timezone" name="timezone" required>
                                        <option value="UTC">UTC (Coordinated Universal Time)</option>
                                        <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                        <option value="Asia/Bangkok">Asia/Bangkok (ICT)</option>
                                        <option value="Asia/Singapore">Asia/Singapore (SGT)</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="bi bi-info-circle"></i> Informasi Sistem
                            </h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <small><strong>Versi Laravel:</strong></small><br>
                                    <small class="text-muted">11.0</small>
                                </li>
                                <li class="mb-2">
                                    <small><strong>PHP Version:</strong></small><br>
                                    <small class="text-muted">8.3.25</small>
                                </li>
                                <li class="mb-2">
                                    <small><strong>Database:</strong></small><br>
                                    <small class="text-muted">MySQL 8.0</small>
                                </li>
                                <li>
                                    <small><strong>Environment:</strong></small><br>
                                    <small class="text-muted">Production</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tampilan/Display Settings -->
        @include('superadmin.pengaturan.tampilan')

        <!-- Notifikasi Settings -->
        @include('superadmin.pengaturan.notifikasi')

        <!-- Sistem Settings -->
        @include('superadmin.pengaturan.sistem')
    </div>
</div>
@endsection