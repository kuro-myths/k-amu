<!-- Theme Settings Modal -->
<div class="modal fade" id="themeModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border: none; border-radius: 15px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
            <!-- Header -->
            <div class="modal-header border-0 pb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0;">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center">
                    <i class="bi bi-palette-fill me-2" style="font-size: 1.5rem;"></i>
                    Pengaturan Tema
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4" style="max-height: 70vh;">
                <form id="themeFormModal" class="space-y-4">
                    <!-- Mode Selection -->
                    <div class="theme-section">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-eye-fill me-2" style="color: #667eea;"></i>
                            Mode Tampilan
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <button type="button" class="mode-btn-modal btn btn-outline-secondary w-100 p-3 mode-card" data-mode="normal" style="border-radius: 10px; transition: all 0.3s;">
                                    <div style="font-size: 1.5rem;">🌤️</div>
                                    <div class="fw-semibold">Normal</div>
                                    <div class="small text-muted">Mode standar</div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="mode-btn-modal btn btn-outline-secondary w-100 p-3 mode-card" data-mode="private" style="border-radius: 10px; transition: all 0.3s;">
                                    <div style="font-size: 1.5rem;">🔒</div>
                                    <div class="fw-semibold">Private</div>
                                    <div class="small text-muted">Mode pribadi</div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="mode-btn-modal btn btn-outline-secondary w-100 p-3 mode-card" data-mode="tor" style="border-radius: 10px; transition: all 0.3s;">
                                    <div style="font-size: 1.5rem;">🕵️</div>
                                    <div class="fw-semibold">Tor</div>
                                    <div class="small text-muted">Mode anonim</div>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" id="modeInputModal" name="mode" value="normal">
                    </div>

                    <hr>

                    <!-- Color Customization -->
                    <div class="theme-section">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-droplet-fill me-2" style="color: #f093fb;"></i>
                            Warna Tema
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Warna Utama</label>
                                <input type="color" id="primaryColorModal" name="primary_color" value="#3b82f6" class="form-control form-control-color" style="height: 50px; border-radius: 8px; cursor: pointer;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Warna Sekunder</label>
                                <input type="color" id="secondaryColorModal" name="secondary_color" value="#8b5cf6" class="form-control form-control-color" style="height: 50px; border-radius: 8px; cursor: pointer;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Warna Latar</label>
                                <input type="color" id="backgroundColorModal" name="background_color" value="#ffffff" class="form-control form-control-color" style="height: 50px; border-radius: 8px; cursor: pointer;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Warna Teks</label>
                                <input type="color" id="textColorModal" name="text_color" value="#1f2937" class="form-control form-control-color" style="height: 50px; border-radius: 8px; cursor: pointer;">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-semibold">Warna Aksen</label>
                                <input type="color" id="accentColorModal" name="accent_color" value="#ec4899" class="form-control form-control-color" style="height: 50px; border-radius: 8px; cursor: pointer;">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Font Customization -->
                    <div class="theme-section">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-type me-2" style="color: #4f46e5;"></i>
                            Gaya Teks
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold">Jenis Font</label>
                                <select id="fontFamilyModal" name="font_family" class="form-select" style="border-radius: 8px;">
                                    <option value="sans">Sans Serif</option>
                                    <option value="serif">Serif</option>
                                    <option value="mono">Monospace</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold">Ukuran Font</label>
                                <select id="fontSizeModal" name="font_size" class="form-select" style="border-radius: 8px;">
                                    <option value="small">Kecil</option>
                                    <option value="normal" selected>Normal</option>
                                    <option value="large">Besar</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-semibold">Ketebalan Font</label>
                                <select id="fontWeightModal" name="font_weight" class="form-select" style="border-radius: 8px;">
                                    <option value="light">Ringan</option>
                                    <option value="normal" selected>Normal</option>
                                    <option value="bold">Tebal</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Toggles -->
                    <div class="theme-section">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-sliders me-2" style="color: #06b6d4;"></i>
                            Preferensi Tampilan
                        </h6>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="darkModeModal" name="dark_mode" style="width: 3rem; height: 1.5rem; cursor: pointer;">
                            <label class="form-check-label" for="darkModeModal">
                                Mode Gelap
                            </label>
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" id="compactModeModal" name="compact_mode" style="width: 3rem; height: 1.5rem; cursor: pointer;">
                            <label class="form-check-label" for="compactModeModal">
                                Mode Ringkas
                            </label>
                        </div>
                    </div>

                    <hr>

                    <!-- Presets -->
                    <div class="theme-section">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-palette me-2" style="color: #f59e0b;"></i>
                            Tema Preset
                        </h6>
                        <div id="presetsContainerModal" class="row g-2">
                            <!-- Presets akan dimuat dengan JavaScript -->
                        </div>
                    </div>

                    <!-- Live Preview -->
                    <hr>
                    <div class="theme-section">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-eye me-2" style="color: #8b5cf6;"></i>
                            Pratinjau
                        </h6>
                        <div class="preview-box p-4" style="border-radius: 10px; background: #f3f4f6; border: 2px dashed #d1d5db;">
                            <p class="mb-2"><strong>Judul Contoh</strong></p>
                            <p class="small text-muted">Ini adalah pratinjau bagaimana tema Anda akan terlihat.</p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 pt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 0.5rem 1.5rem;">
                    <i class="bi bi-x-lg me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-primary" id="savethemeModalBtn" style="border-radius: 8px; padding: 0.5rem 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <i class="bi bi-check-lg me-2"></i>Simpan Tema
                </button>
                <button type="button" class="btn btn-outline-warning" id="resetThemeModalBtn" style="border-radius: 8px; padding: 0.5rem 1.5rem;">
                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Show Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeModal = new bootstrap.Modal(document.getElementById('themeModal'), {
            keyboard: true,
            backdrop: true
        });

        // Expose to window for navbar links
        window.showThemeModal = function() {
            themeModal.show();
        };

        // Mode Selection
        document.querySelectorAll('.mode-btn-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.mode-btn-modal').forEach(b => {
                    b.classList.remove('active');
                    b.style.background = '';
                    b.style.color = '';
                });
                this.classList.add('active');
                this.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                this.style.color = 'white';
                document.getElementById('modeInputModal').value = this.dataset.mode;
            });
        });

        // Save Theme
        document.getElementById('savethemeModalBtn').addEventListener('click', async function() {
            const formData = new FormData(document.getElementById('themeFormModal'));
            const data = Object.fromEntries(formData);
            data.dark_mode = document.getElementById('darkModeModal').checked;
            data.compact_mode = document.getElementById('compactModeModal').checked;

            try {
                const response = await fetch('/api/theme', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    // Reload theme
                    if (window.themeManager) {
                        window.themeManager.loadTheme();
                    }
                    alert('Tema berhasil disimpan!');
                    themeModal.hide();
                } else {
                    alert('Gagal menyimpan tema');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        });

        // Reset Theme
        document.getElementById('resetThemeModalBtn').addEventListener('click', async function() {
            if (!confirm('Apakah Anda yakin ingin mereset tema ke default?')) return;

            try {
                const response = await fetch('/api/theme/reset', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    if (window.themeManager) {
                        window.themeManager.loadTheme();
                    }
                    alert('Tema berhasil direset!');
                    themeModal.hide();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });

        // Load Presets
        async function loadPresets() {
            try {
                const response = await fetch('/api/theme/presets');
                const presets = await response.json();
                const container = document.getElementById('presetsContainerModal');

                presets.forEach(preset => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'col-6 col-md-3 btn btn-outline-secondary p-3';
                    btn.style.borderRadius = '10px';
                    btn.innerHTML = `
                    <div style="display: flex; gap: 4px; margin-bottom: 0.5rem;">
                        <div style="width: 24px; height: 24px; border-radius: 4px; background: ${preset.primary_color};"></div>
                        <div style="width: 24px; height: 24px; border-radius: 4px; background: ${preset.secondary_color};"></div>
                        <div style="width: 24px; height: 24px; border-radius: 4px; background: ${preset.accent_color};"></div>
                    </div>
                    <div class="small">${preset.name}</div>
                `;
                    btn.addEventListener('click', function() {
                        document.getElementById('primaryColorModal').value = preset.primary_color;
                        document.getElementById('secondaryColorModal').value = preset.secondary_color;
                        document.getElementById('backgroundColorModal').value = preset.background_color;
                        document.getElementById('textColorModal').value = preset.text_color;
                        document.getElementById('accentColorModal').value = preset.accent_color;
                    });
                    container.appendChild(btn);
                });
            } catch (error) {
                console.error('Error loading presets:', error);
            }
        }

        loadPresets();
    });
</script>

<style>
    .mode-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .mode-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .mode-card.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .preview-box {
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>