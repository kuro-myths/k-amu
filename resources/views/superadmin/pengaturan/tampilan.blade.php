<!-- Tampilan Settings Tab Content -->
<div class="tab-pane fade" id="display" role="tabpanel" aria-labelledby="display-tab">
    <div class="row">
        <div class="col-lg-8">
            <h5 class="mb-4">
                <i class="bi bi-palette text-primary"></i> Pengaturan Tampilan & Tema
            </h5>

            <!-- Theme Selection -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-palette-fill"></i> Pilih Tema
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Pilih tema yang sesuai dengan preferensi Anda:</p>

                    <div class="row g-3">
                        <!-- Light Theme -->
                        <div class="col-md-4">
                            <div class="card border-2 border-primary" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <div class="bg-light p-4 rounded mb-2" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-sun-fill" style="font-size: 2rem; color: #FFC107;"></i>
                                    </div>
                                    <h6 class="card-title">Terang (Light)</h6>
                                    <small class="text-muted d-block mb-2">Interface cerah dengan warna terang</small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeLight" value="light" checked>
                                        <label class="form-check-label" for="themeLight">
                                            Pilih
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dark Theme -->
                        <div class="col-md-4">
                            <div class="card border-2 border-secondary" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <div class="bg-dark p-4 rounded mb-2" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-moon-stars-fill" style="font-size: 2rem; color: #6C757D;"></i>
                                    </div>
                                    <h6 class="card-title">Gelap (Dark)</h6>
                                    <small class="text-muted d-block mb-2">Interface gelap untuk mata yang nyaman</small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeDark" value="dark">
                                        <label class="form-check-label" for="themeDark">
                                            Pilih
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Auto Theme -->
                        <div class="col-md-4">
                            <div class="card border-2 border-secondary" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <div class="p-4 rounded mb-2" style="height: 100px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f5f7fa 50%, #1a365d 50%);">
                                        <i class="bi bi-circle-half" style="font-size: 2rem; color: #495057;"></i>
                                    </div>
                                    <h6 class="card-title">Otomatis (Auto)</h6>
                                    <small class="text-muted d-block mb-2">Sesuai dengan setting sistem operasi</small>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeAuto" value="auto">
                                        <label class="form-check-label" for="themeAuto">
                                            Pilih
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accent Color -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-droplet-fill"></i> Warna Aksen
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Pilih warna aksen untuk tombol dan elemen interaktif:</p>

                    <div class="d-flex gap-2 flex-wrap">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accent-color" id="colorBlue" value="blue" checked>
                            <label class="form-check-label" for="colorBlue" style="cursor: pointer;">
                                <div class="rounded" style="width: 40px; height: 40px; background-color: #4f46e5; display: inline-block; margin-left: 5px; border: 2px solid #ccc;"></div>
                                <span>Biru (Default)</span>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accent-color" id="colorPurple" value="purple">
                            <label class="form-check-label" for="colorPurple" style="cursor: pointer;">
                                <div class="rounded" style="width: 40px; height: 40px; background-color: #7c3aed; display: inline-block; margin-left: 5px; border: 2px solid #ccc;"></div>
                                <span>Ungu</span>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accent-color" id="colorGreen" value="green">
                            <label class="form-check-label" for="colorGreen" style="cursor: pointer;">
                                <div class="rounded" style="width: 40px; height: 40px; background-color: #10b981; display: inline-block; margin-left: 5px; border: 2px solid #ccc;"></div>
                                <span>Hijau</span>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accent-color" id="colorRed" value="red">
                            <label class="form-check-label" for="colorRed" style="cursor: pointer;">
                                <div class="rounded" style="width: 40px; height: 40px; background-color: #ef4444; display: inline-block; margin-left: 5px; border: 2px solid #ccc;"></div>
                                <span>Merah</span>
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="accent-color" id="colorOrange" value="orange">
                            <label class="form-check-label" for="colorOrange" style="cursor: pointer;">
                                <div class="rounded" style="width: 40px; height: 40px; background-color: #f59e0b; display: inline-block; margin-left: 5px; border: 2px solid #ccc;"></div>
                                <span>Oranye</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Settings -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-layout-sidebar"></i> Pengaturan Sidebar
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="sidebarCollapse" checked>
                        <label class="form-check-label" for="sidebarCollapse">
                            <strong>Collapse Sidebar secara default</strong>
                            <br>
                            <small class="text-muted">Mulai dengan sidebar yang ditutup untuk ruang lebih luas</small>
                        </label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="sidebarSticky" checked>
                        <label class="form-check-label" for="sidebarSticky">
                            <strong>Sidebar tetap (Sticky)</strong>
                            <br>
                            <small class="text-muted">Sidebar tetap terlihat saat scroll</small>
                        </label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="sidebarSmooth" checked>
                        <label class="form-check-label" for="sidebarSmooth">
                            <strong>Animasi halus</strong>
                            <br>
                            <small class="text-muted">Gunakan transisi smooth untuk sidebar</small>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Font Settings -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-type"></i> Pengaturan Font & Ukuran Teks
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="fontSize" class="form-label">Ukuran Font Umum</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="range" class="form-range" id="fontSize" min="12" max="18" value="14">
                            <span class="badge bg-primary" id="fontSizeValue">14px</span>
                        </div>
                        <small class="text-muted">Sesuaikan ukuran font untuk kenyamanan membaca</small>
                    </div>

                    <div class="mb-3">
                        <label for="fontFamily" class="form-label">Jenis Font</label>
                        <select class="form-select" id="fontFamily">
                            <option selected>Segoe UI (Default)</option>
                            <option>Arial</option>
                            <option>Helvetica</option>
                            <option>Courier New</option>
                            <option>Georgia</option>
                        </select>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="fontSmoothing" checked>
                        <label class="form-check-label" for="fontSmoothing">
                            <strong>Font Smoothing</strong>
                            <br>
                            <small class="text-muted">Tampilkan font lebih smooth dan tajam</small>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Notification Display -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-bell"></i> Tampilan Notifikasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="notifPosition" class="form-label">Posisi Notifikasi</label>
                        <select class="form-select" id="notifPosition">
                            <option selected>Pojok Kanan Atas</option>
                            <option>Pojok Kiri Atas</option>
                            <option>Pojok Kanan Bawah</option>
                            <option>Pojok Kiri Bawah</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="notifDuration" class="form-label">Durasi Notifikasi (detik)</label>
                        <input type="number" class="form-control" id="notifDuration" value="5" min="2" max="15">
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="notifSound" checked>
                        <label class="form-check-label" for="notifSound">
                            <strong>Suara notifikasi</strong>
                            <br>
                            <small class="text-muted">Mainkan suara saat ada notifikasi baru</small>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Simpan Pengaturan
                </button>
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise"></i> Reset ke Default
                </button>
            </div>
        </div>

        <!-- Preview Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Preview</h6>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">Pratinjau perubahan tema Anda:</p>

                        <div class="bg-light p-3 rounded" style="border: 1px solid #dee2e6;">
                            <div class="bg-white p-3 rounded mb-2">
                                <i class="bi bi-house-door" style="color: #4f46e5;"></i> <span class="small">Beranda</span>
                            </div>
                            <div class="bg-light p-3 rounded">
                                <i class="bi bi-gear" style="color: #4f46e5;"></i> <span class="small">Manajemen</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info border-0">
                    <h6 class="alert-heading">
                        <i class="bi bi-info-circle"></i> Tips Tampilan
                    </h6>
                    <small class="text-muted">
                        <ul class="ps-3 mb-0">
                            <li>Tema Gelap cocok untuk bekerja malam</li>
                            <li>Ukuran font besar membantu kenyamanan mata</li>
                            <li>Tema otomatis menyesuaikan dengan sistem Anda</li>
                        </ul>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('fontSize').addEventListener('change', function(e) {
        document.getElementById('fontSizeValue').textContent = e.target.value + 'px';
    });
</script>