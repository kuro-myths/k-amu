<!-- Notifikasi Settings Tab Content -->
<div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
    <div class="row">
        <div class="col-lg-8">
            <h5 class="mb-4">
                <i class="bi bi-bell-fill text-primary"></i> Pengaturan Notifikasi
            </h5>

            <!-- Email Notifications -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-envelope"></i> Notifikasi Email
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailNewUser" checked>
                            <label class="form-check-label" for="emailNewUser">
                                <strong>Email saat ada pengguna baru</strong>
                                <br>
                                <small class="text-muted">Terima pemberitahuan email ketika ada registrasi pengguna baru</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailBugReport" checked>
                            <label class="form-check-label" for="emailBugReport">
                                <strong>Email saat ada laporan bug baru</strong>
                                <br>
                                <small class="text-muted">Terima pemberitahuan email untuk setiap bug report yang masuk</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailTestResult" checked>
                            <label class="form-check-label" for="emailTestResult">
                                <strong>Email untuk hasil testing</strong>
                                <br>
                                <small class="text-muted">Terima ringkasan hasil testing secara berkala</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailDailyDigest" checked>
                            <label class="form-check-label" for="emailDailyDigest">
                                <strong>Ringkasan harian</strong>
                                <br>
                                <small class="text-muted">Terima email dengan ringkasan aktivitas harian</small>
                            </label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="emailWeeklyReport">
                            <label class="form-check-label" for="emailWeeklyReport">
                                <strong>Laporan mingguan</strong>
                                <br>
                                <small class="text-muted">Terima laporan detail setiap minggu</small>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <!-- In-App Notifications -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-app-indicator"></i> Notifikasi Dalam Aplikasi
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="appNewMessage" checked>
                            <label class="form-check-label" for="appNewMessage">
                                <strong>Pesan baru</strong>
                                <br>
                                <small class="text-muted">Tampilkan notifikasi untuk pesan chat baru</small>
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="appUserActivity" checked>
                            <label class="form-check-label" for="appUserActivity">
                                <strong>Aktivitas pengguna</strong>
                                <br>
                                <small class="text-muted">Tampilkan notifikasi untuk aktivitas pengguna penting</small>
                            </label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="appSystemAlert" checked>
                            <label class="form-check-label" for="appSystemAlert">
                                <strong>Alert sistem</strong>
                                <br>
                                <small class="text-muted">Tampilkan alert penting dari sistem</small>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notification Channels -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-diagram-3"></i> Saluran Notifikasi
                    </h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="channelEmail" checked>
                                    <label class="form-check-label" for="channelEmail">
                                        Email
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="channelDatabase" checked>
                                    <label class="form-check-label" for="channelDatabase">
                                        Database (Dalam Aplikasi)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Save Button -->
            <div class="d-flex gap-2">
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
            <div class="alert alert-info border-0">
                <h6 class="alert-heading">
                    <i class="bi bi-info-circle"></i> Informasi
                </h6>
                <small class="text-muted">
                    Kelola preferensi notifikasi Anda di sini. Anda dapat memilih saluran dan jenis notifikasi yang ingin diterima.
                </small>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="small text-muted ps-3">
                        <li>Aktifkan notifikasi email untuk update penting</li>
                        <li>Gunakan ringkasan harian untuk monitoring efisien</li>
                        <li>Alert sistem selalu aktif untuk keamanan</li>
                        <li>Atur saluran sesuai kebutuhan Anda</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>