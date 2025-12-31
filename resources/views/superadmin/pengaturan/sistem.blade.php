<!-- Sistem Settings Tab Content -->
<div class="tab-pane fade" id="maintenance" role="tabpanel" aria-labelledby="maintenance-tab">
    <div class="row">
        <div class="col-lg-8">
            <h5 class="mb-4">
                <i class="bi bi-tools text-primary"></i> Pengaturan Sistem & Pemeliharaan
            </h5>

            <!-- System Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle"></i> Informasi Sistem
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Nama Aplikasi</label>
                            <p class="fw-bold">K-AMU (Sistem Manajemen Akademik)</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Versi Aplikasi</label>
                            <p class="fw-bold">1.0.0</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Environment</label>
                            <p class="fw-bold">
                                <span class="badge bg-success">Production</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Last Updated</label>
                            <p class="fw-bold">31 December 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cache Management -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-lightning-charge"></i> Manajemen Cache
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Hapus cache aplikasi untuk memperbarui data dan meningkatkan performa.</p>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <small class="text-muted">Cache Driver:</small>
                            <p class="fw-bold">File</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Cache Size:</small>
                            <p class="fw-bold">2.4 MB</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Last Cleared:</small>
                            <p class="fw-bold">Today, 14:23</p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-warning" onclick="return confirm('Yakin hapus cache?')">
                        <i class="bi bi-trash3"></i> Hapus Semua Cache
                    </button>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="bi bi-info-circle"></i> Detail
                    </button>
                </div>
            </div>

            <!-- Database Management -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-database"></i> Manajemen Database
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Optimalkan dan backup database aplikasi.</p>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <small class="text-muted">Total Records:</small>
                            <p class="fw-bold">{{ $totalRecords ?? '15,234' }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Database Size:</small>
                            <p class="fw-bold">{{ $dbSize ?? '8.5 MB' }}</p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Last Backup:</small>
                            <p class="fw-bold">{{ $lastBackup ?? '3 days ago' }}</p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-info" onclick="return confirm('Mulai optimasi database?')">
                        <i class="bi bi-speedometer2"></i> Optimalkan Database
                    </button>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="bi bi-download"></i> Backup Sekarang
                    </button>
                </div>
            </div>

            <!-- Log Management -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-file-text"></i> Manajemen Log
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Kelola file log sistem aplikasi.</p>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Total Log Files:</small>
                            <p class="fw-bold">42</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Total Log Size:</small>
                            <p class="fw-bold">156 MB</p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger" onclick="return confirm('Yakin hapus semua log?')">
                        <i class="bi bi-trash3"></i> Hapus Semua Log
                    </button>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="bi bi-download"></i> Download Log
                    </button>
                </div>
            </div>

            <!-- System Settings -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-sliders"></i> Pengaturan Sistem Umum
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="appName" class="form-label">Nama Aplikasi</label>
                            <input type="text" class="form-control" id="appName" value="K-AMU Admin" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Email Administrator</label>
                            <input type="email" class="form-control" id="adminEmail" placeholder="admin@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="timezone" class="form-label">Zona Waktu</label>
                            <select class="form-select" id="timezone">
                                <option selected>Asia/Jakarta (UTC+7)</option>
                                <option>Asia/Bangkok (UTC+7)</option>
                                <option>Asia/Singapore (UTC+8)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="language" class="form-label">Bahasa</label>
                            <select class="form-select" id="language">
                                <option selected>Bahasa Indonesia</option>
                                <option>English</option>
                                <option>中文</option>
                            </select>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="maintenanceMode">
                            <label class="form-check-label" for="maintenanceMode">
                                <strong>Mode Pemeliharaan</strong>
                                <br>
                                <small class="text-muted">Matikan aplikasi untuk semua user kecuali admin</small>
                            </label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="debugMode">
                            <label class="form-check-label" for="debugMode">
                                <strong>Mode Debug</strong>
                                <br>
                                <small class="text-muted">Tampilkan error detail (JANGAN aktifkan di production)</small>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Save Button -->
            <div class="d-flex gap-2 mb-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Simpan Pengaturan
                </button>
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </button>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <div class="alert alert-warning border-0">
                <h6 class="alert-heading">
                    <i class="bi bi-exclamation-triangle"></i> Peringatan
                </h6>
                <small class="text-muted">
                    Perubahan di sini dapat mempengaruhi performa aplikasi. Lakukan dengan hati-hati dan hubungi developer jika ada masalah.
                </small>
            </div>

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Performa</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">CPU Usage</small>
                        <div class="progress" role="progressbar" style="height: 20px;">
                            <div class="progress-bar bg-success" style="width: 35%"></div>
                        </div>
                        <small class="text-muted">35%</small>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Memory Usage</small>
                        <div class="progress" role="progressbar" style="height: 20px;">
                            <div class="progress-bar bg-warning" style="width: 62%"></div>
                        </div>
                        <small class="text-muted">62%</small>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Disk Usage</small>
                        <div class="progress" role="progressbar" style="height: 20px;">
                            <div class="progress-bar bg-info" style="width: 45%"></div>
                        </div>
                        <small class="text-muted">45%</small>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Bantuan</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-question-circle"></i> Butuh bantuan?
                    </p>
                    <button class="btn btn-sm btn-outline-primary w-100">
                        <i class="bi bi-chat-dots"></i> Hubungi Support
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>