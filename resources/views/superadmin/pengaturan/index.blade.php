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
            <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button">
                <i class="bi bi-envelope"></i> Email
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button">
                <i class="bi bi-shield-lock"></i> Keamanan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="maintenance-tab" data-bs-toggle="tab" data-bs-target="#maintenance" type="button">
                <i class="bi bi-tools"></i> Pemeliharaan
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

        <!-- Email Settings -->
        <div class="tab-pane fade" id="email" role="tabpanel">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Pengaturan Email</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('superadmin.pengaturan.update') }}">
                                @csrf

                                <!-- Mail Driver -->
                                <div class="mb-3">
                                    <label for="mailDriver" class="form-label fw-semibold">
                                        <i class="bi bi-envelope-open"></i> Pengirim Email
                                    </label>
                                    <select class="form-select" id="mailDriver" name="mail_driver" required>
                                        <option value="smtp">SMTP</option>
                                        <option value="sendmail">Sendmail</option>
                                        <option value="log">Log</option>
                                    </select>
                                </div>

                                <!-- Mail From -->
                                <div class="mb-3">
                                    <label for="mailFrom" class="form-label fw-semibold">
                                        <i class="bi bi-at"></i> Email Pengirim
                                    </label>
                                    <input type="email" class="form-control" id="mailFrom" name="mail_from" value="noreply@k-amu.test" required>
                                </div>

                                <!-- SMTP Host -->
                                <div class="mb-3">
                                    <label for="smtpHost" class="form-label fw-semibold">
                                        <i class="bi bi-server"></i> SMTP Host
                                    </label>
                                    <input type="text" class="form-control" id="smtpHost" name="smtp_host" placeholder="smtp.example.com">
                                </div>

                                <!-- SMTP Port -->
                                <div class="mb-3">
                                    <label for="smtpPort" class="form-label fw-semibold">
                                        <i class="bi bi-signpost"></i> SMTP Port
                                    </label>
                                    <input type="number" class="form-control" id="smtpPort" name="smtp_port" value="587">
                                </div>

                                <!-- SMTP Username -->
                                <div class="mb-3">
                                    <label for="smtpUser" class="form-label fw-semibold">
                                        <i class="bi bi-person"></i> SMTP Username
                                    </label>
                                    <input type="text" class="form-control" id="smtpUser" name="smtp_username" placeholder="username@example.com">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="tab-pane fade" id="security" role="tabpanel">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Pengaturan Keamanan</h6>
                        </div>
                        <div class="card-body">
                            <!-- Session Timeout -->
                            <div class="mb-4">
                                <label for="sessionTimeout" class="form-label fw-semibold">
                                    <i class="bi bi-clock"></i> Session Timeout (menit)
                                </label>
                                <input type="number" class="form-control" id="sessionTimeout" value="120" disabled>
                                <small class="text-muted">Pengguna akan keluar otomatis setelah 120 menit tidak aktif</small>
                            </div>

                            <!-- Enable 2FA -->
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="enable2FA" name="enable_2fa" value="1" checked>
                                    <label class="form-check-label" for="enable2FA">
                                        <i class="bi bi-shield-check"></i> Aktifkan Two-Factor Authentication (2FA)
                                    </label>
                                </div>
                            </div>

                            <!-- Force HTTPS -->
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="forceHttps" name="force_https" value="1" checked>
                                    <label class="form-check-label" for="forceHttps">
                                        <i class="bi bi-lock"></i> Paksa HTTPS
                                    </label>
                                </div>
                            </div>

                            <!-- Allowed Login Attempts -->
                            <div class="mb-4">
                                <label for="loginAttempts" class="form-label fw-semibold">
                                    <i class="bi bi-exclamation-triangle"></i> Maksimal Percobaan Login
                                </label>
                                <input type="number" class="form-control" id="loginAttempts" value="5" disabled>
                                <small class="text-muted">Akun akan terkunci sementara setelah 5 kali gagal login</small>
                            </div>

                            <button class="btn btn-primary" disabled>
                                <i class="bi bi-check-circle"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Maintenance -->
        <div class="tab-pane fade" id="maintenance" role="tabpanel">
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Pemeliharaan Sistem</h6>
                        </div>
                        <div class="card-body">
                            <!-- Maintenance Mode -->
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="maintenanceMode" name="maintenance_mode" value="1">
                                    <label class="form-check-label" for="maintenanceMode">
                                        <i class="bi bi-cone-striped"></i> Mode Pemeliharaan
                                    </label>
                                </div>
                                <small class="text-muted d-block mt-1">Matikan aplikasi untuk pengguna reguler selama pemeliharaan</small>
                            </div>

                            <!-- Database Actions -->
                            <div class="mb-4">
                                <h6 class="mb-3">Database</h6>
                                <button class="btn btn-outline-warning me-2" disabled>
                                    <i class="bi bi-arrow-counterclockwise"></i> Backup Database
                                </button>
                                <button class="btn btn-outline-danger" disabled>
                                    <i class="bi bi-bootstrap-reboot"></i> Restore Database
                                </button>
                            </div>

                            <!-- Cache -->
                            <div class="mb-4">
                                <h6 class="mb-3">Cache</h6>
                                <form method="POST" action="{{ route('superadmin.pengaturan.clearCache') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info">
                                        <i class="bi bi-trash"></i> Hapus Cache
                                    </button>
                                </form>
                                <button class="btn btn-outline-secondary ms-2" disabled>
                                    <i class="bi bi-gear"></i> Optimize Cache
                                </button>
                            </div>

                            <!-- Logs -->
                            <div class="mb-4">
                                <h6 class="mb-3">Log Sistem</h6>
                                <button class="btn btn-outline-danger" disabled>
                                    <i class="bi bi-trash"></i> Hapus Log Sistem
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection