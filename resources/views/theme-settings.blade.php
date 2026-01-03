@extends('layouts.app')

@section('title', 'Pengaturan Tema')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Pengaturan Tema</h1>
            <p class="text-gray-600">Sesuaikan warna, gaya teks, dan mode tampilan Anda</p>
        </div>

        <!-- Theme Settings Card -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form id="themeForm" class="space-y-6">
                <!-- Mode Selection -->
                <div>
                    <label class="block text-lg font-semibold mb-3">Mode Tampilan</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <button type="button" class="mode-btn p-4 rounded-lg border-2 border-gray-300 hover:border-blue-500 transition text-center" data-mode="normal">
                            <div class="font-semibold mb-2">🌤️ Normal</div>
                            <div class="text-sm text-gray-600">Mode standar</div>
                        </button>
                        <button type="button" class="mode-btn p-4 rounded-lg border-2 border-gray-300 hover:border-blue-500 transition text-center" data-mode="private">
                            <div class="font-semibold mb-2">🔒 Private</div>
                            <div class="text-sm text-gray-600">Mode pribadi</div>
                        </button>
                        <button type="button" class="mode-btn p-4 rounded-lg border-2 border-gray-300 hover:border-blue-500 transition text-center" data-mode="tor">
                            <div class="font-semibold mb-2">🕵️ Tor</div>
                            <div class="text-sm text-gray-600">Mode anonim</div>
                        </button>
                    </div>
                    <input type="hidden" id="modeInput" name="mode" value="normal">
                </div>

                <!-- Color Customization -->
                <div class="border-t pt-6">
                    <label class="block text-lg font-semibold mb-4">Warna Tema</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <!-- Primary Color -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Warna Utama</label>
                            <input type="color" id="primaryColor" name="primary_color" value="#3b82f6" class="w-full h-10 rounded cursor-pointer">
                        </div>

                        <!-- Secondary Color -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Warna Sekunder</label>
                            <input type="color" id="secondaryColor" name="secondary_color" value="#8b5cf6" class="w-full h-10 rounded cursor-pointer">
                        </div>

                        <!-- Background Color -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Warna Latar</label>
                            <input type="color" id="backgroundColor" name="background_color" value="#ffffff" class="w-full h-10 rounded cursor-pointer">
                        </div>

                        <!-- Text Color -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Warna Teks</label>
                            <input type="color" id="textColor" name="text_color" value="#000000" class="w-full h-10 rounded cursor-pointer">
                        </div>

                        <!-- Accent Color -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Warna Aksen</label>
                            <input type="color" id="accentColor" name="accent_color" value="#ec4899" class="w-full h-10 rounded cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Text Style -->
                <div class="border-t pt-6">
                    <label class="block text-lg font-semibold mb-4">Gaya Teks</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Font Family -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Jenis Font</label>
                            <select id="fontFamily" name="font_family" class="w-full p-2 border border-gray-300 rounded">
                                <option value="sans">Sans Serif (Modern)</option>
                                <option value="serif">Serif (Klasik)</option>
                                <option value="mono">Monospace (Kode)</option>
                            </select>
                        </div>

                        <!-- Font Size -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Ukuran Font</label>
                            <select id="fontSize" name="font_size" class="w-full p-2 border border-gray-300 rounded">
                                <option value="small">Kecil</option>
                                <option value="normal">Normal</option>
                                <option value="large">Besar</option>
                            </select>
                        </div>

                        <!-- Font Weight -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Ketebalan Font</label>
                            <select id="fontWeight" name="font_weight" class="w-full p-2 border border-gray-300 rounded">
                                <option value="light">Ringan</option>
                                <option value="normal">Normal</option>
                                <option value="bold">Tebal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Toggle Options -->
                <div class="border-t pt-6">
                    <div class="space-y-3">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" id="darkMode" name="dark_mode" class="w-4 h-4 rounded">
                            <span class="text-sm font-medium">Mode Gelap</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" id="compactMode" name="compact_mode" class="w-4 h-4 rounded">
                            <span class="text-sm font-medium">Mode Ringkas</span>
                        </label>
                    </div>
                </div>

                <!-- Preview -->
                <div class="border-t pt-6">
                    <label class="block text-lg font-semibold mb-4">Pratinjau</label>
                    <div id="preview" class="p-6 rounded-lg border-2 border-gray-300">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold mb-2">Judul Contoh</h3>
                            <p>Ini adalah teks contoh untuk menunjukkan bagaimana tema Anda akan terlihat. Anda dapat melihat perubahan warna dan gaya teks secara real-time.</p>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" class="px-4 py-2 rounded font-medium">Tombol Utama</button>
                            <button type="button" class="px-4 py-2 rounded font-medium">Tombol Sekunder</button>
                        </div>
                    </div>
                </div>

                <!-- Preset Themes -->
                <div class="border-t pt-6">
                    <label class="block text-lg font-semibold mb-4">Preset Tema</label>
                    <div id="presetsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <!-- Presets akan dimuat via JavaScript -->
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="border-t pt-6 flex gap-3">
                    <button type="submit" class="px-6 py-2 rounded-lg font-semibold text-white transition">
                        Simpan Tema
                    </button>
                    <button type="button" id="resetBtn" class="px-6 py-2 rounded-lg border-2 border-gray-300 font-semibold hover:bg-gray-100 transition">
                        Reset ke Default
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Load theme settings on page load
    document.addEventListener('DOMContentLoaded', async () => {
        await loadTheme();
        await loadPresets();
        setupEventListeners();
    });

    async function loadTheme() {
        try {
            const response = await fetch('/api/theme');
            const theme = await response.json();

            // Set form values
            document.getElementById('modeInput').value = theme.mode;
            document.getElementById('primaryColor').value = theme.primary_color;
            document.getElementById('secondaryColor').value = theme.secondary_color;
            document.getElementById('backgroundColor').value = theme.background_color;
            document.getElementById('textColor').value = theme.text_color;
            document.getElementById('accentColor').value = theme.accent_color;
            document.getElementById('fontFamily').value = theme.font_family;
            document.getElementById('fontSize').value = theme.font_size;
            document.getElementById('fontWeight').value = theme.font_weight;
            document.getElementById('darkMode').checked = theme.dark_mode;
            document.getElementById('compactMode').checked = theme.compact_mode;

            updateModeButton(theme.mode);
            updatePreview();
        } catch (error) {
            console.error('Error loading theme:', error);
        }
    }

    async function loadPresets() {
        try {
            const response = await fetch('/api/theme/presets');
            const presets = await response.json();
            const container = document.getElementById('presetsContainer');

            container.innerHTML = '';
            Object.entries(presets).forEach(([key, preset]) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'p-4 rounded-lg border-2 border-gray-300 hover:border-blue-500 transition text-left';
                btn.innerHTML = `
                    <div class="font-semibold mb-2">${preset.name}</div>
                    <div class="flex gap-1">
                        <div class="w-6 h-6 rounded" style="background-color: ${preset.primary_color}"></div>
                        <div class="w-6 h-6 rounded" style="background-color: ${preset.secondary_color}"></div>
                        <div class="w-6 h-6 rounded" style="background-color: ${preset.accent_color}"></div>
                    </div>
                `;
                btn.addEventListener('click', () => applyPreset(preset));
                container.appendChild(btn);
            });
        } catch (error) {
            console.error('Error loading presets:', error);
        }
    }

    function applyPreset(preset) {
        document.getElementById('modeInput').value = preset.mode;
        document.getElementById('primaryColor').value = preset.primary_color;
        document.getElementById('secondaryColor').value = preset.secondary_color;
        document.getElementById('backgroundColor').value = preset.background_color;
        document.getElementById('textColor').value = preset.text_color;
        document.getElementById('accentColor').value = preset.accent_color;
        document.getElementById('darkMode').checked = preset.dark_mode;

        updateModeButton(preset.mode);
        updatePreview();
    }

    function setupEventListeners() {
        // Mode buttons
        document.querySelectorAll('.mode-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('border-blue-500', 'bg-blue-50'));
                btn.classList.add('border-blue-500', 'bg-blue-50');
                document.getElementById('modeInput').value = btn.dataset.mode;
            });
        });

        // Color and style inputs
        ['primaryColor', 'secondaryColor', 'backgroundColor', 'textColor', 'accentColor', 'fontFamily', 'fontSize', 'fontWeight', 'darkMode', 'compactMode'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener('change', updatePreview);
                element.addEventListener('input', updatePreview);
            }
        });

        // Form submit
        document.getElementById('themeForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            await saveTheme();
        });

        // Reset button
        document.getElementById('resetBtn').addEventListener('click', async () => {
            if (confirm('Anda yakin ingin mereset tema ke pengaturan default?')) {
                await resetTheme();
            }
        });
    }

    function updateModeButton(mode) {
        document.querySelectorAll('.mode-btn').forEach(btn => {
            btn.classList.remove('border-blue-500', 'bg-blue-50');
            if (btn.dataset.mode === mode) {
                btn.classList.add('border-blue-500', 'bg-blue-50');
            }
        });
    }

    function updatePreview() {
        const preview = document.getElementById('preview');
        const primaryColor = document.getElementById('primaryColor').value;
        const secondaryColor = document.getElementById('secondaryColor').value;
        const backgroundColor = document.getElementById('backgroundColor').value;
        const textColor = document.getElementById('textColor').value;
        const accentColor = document.getElementById('accentColor').value;
        const darkMode = document.getElementById('darkMode').checked;
        const fontSize = document.getElementById('fontSize').value;
        const fontFamily = document.getElementById('fontFamily').value;
        const fontWeight = document.getElementById('fontWeight').value;

        let fontSizeValue = '1rem';
        if (fontSize === 'small') fontSizeValue = '0.875rem';
        if (fontSize === 'large') fontSizeValue = '1.25rem';

        let fontFamilyValue = 'system-ui, -apple-system, sans-serif';
        if (fontFamily === 'serif') fontFamilyValue = 'Georgia, serif';
        if (fontFamily === 'mono') fontFamilyValue = 'Courier New, monospace';

        let fontWeightValue = '400';
        if (fontWeight === 'light') fontWeightValue = '300';
        if (fontWeight === 'bold') fontWeightValue = '700';

        preview.style.backgroundColor = backgroundColor;
        preview.style.color = textColor;
        preview.style.fontSize = fontSizeValue;
        preview.style.fontFamily = fontFamilyValue;
        preview.style.fontWeight = fontWeightValue;

        const buttons = preview.querySelectorAll('button');
        buttons[0].style.backgroundColor = primaryColor;
        buttons[0].style.color = '#fff';

        buttons[1].style.backgroundColor = secondaryColor;
        buttons[1].style.color = '#fff';

        const heading = preview.querySelector('h3');
        heading.style.color = primaryColor;

        if (darkMode) {
            preview.classList.add('bg-gray-800', 'text-white');
        } else {
            preview.classList.remove('bg-gray-800', 'text-white');
        }
    }

    async function saveTheme() {
        const formData = new FormData(document.getElementById('themeForm'));
        const data = Object.fromEntries(formData);

        try {
            const response = await fetch('/api/theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(data),
            });

            if (response.ok) {
                alert('Tema berhasil disimpan!');
                applyThemeToPage();
            } else {
                alert('Gagal menyimpan tema');
            }
        } catch (error) {
            console.error('Error saving theme:', error);
            alert('Terjadi kesalahan saat menyimpan tema');
        }
    }

    async function resetTheme() {
        try {
            const response = await fetch('/api/theme/reset', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            if (response.ok) {
                alert('Tema berhasil direset!');
                location.reload();
            }
        } catch (error) {
            console.error('Error resetting theme:', error);
        }
    }

    function applyThemeToPage() {
        // Terapkan tema ke seluruh halaman
        const primaryColor = document.getElementById('primaryColor').value;
        const root = document.documentElement;
        root.style.setProperty('--primary-color', primaryColor);
    }
</script>

<style>
    :root {
        --primary-color: #3b82f6;
    }

    button[type="submit"] {
        background-color: var(--primary-color);
    }

    button[type="submit"]:hover {
        opacity: 0.9;
    }
</style>
@endsection