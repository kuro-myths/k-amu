@extends('layouts.app')

@section('title', 'Panduan Lengkap SuperAdmin')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-book-fill"></i> Panduan Lengkap SuperAdmin
            </h2>
            <p class="text-muted mt-1">Dokumentasi lengkap fitur dan cara penggunaan K-AMU</p>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs mb-4" id="panduan-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="manajemen-tab" data-bs-toggle="tab"
                        data-bs-target="#manajemen" type="button" role="tab" aria-controls="manajemen">
                        <i class="bi bi-gear me-2"></i>Manajemen
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="monitoring-tab" data-bs-toggle="tab"
                        data-bs-target="#monitoring" type="button" role="tab" aria-controls="monitoring">
                        <i class="bi bi-binoculars me-2"></i>Monitoring
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="konten-tab" data-bs-toggle="tab"
                        data-bs-target="#konten" type="button" role="tab" aria-controls="konten">
                        <i class="bi bi-file-text me-2"></i>Konten
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="alat-tab" data-bs-toggle="tab"
                        data-bs-target="#alat" type="button" role="tab" aria-controls="alat">
                        <i class="bi bi-tools me-2"></i>Alat
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="panduan-content">
        <!-- MANAJEMEN -->
        <div class="tab-pane fade show active" id="manajemen" role="tabpanel" aria-labelledby="manajemen-tab">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Kelola Pengguna -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-people-fill"></i> Kelola Pengguna
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Lihat Daftar Pengguna</strong> - Tampilkan semua pengguna terdaftar</li>
                                <li><strong>Cari & Filter</strong> - Cari pengguna berdasarkan nama/email dan filter dengan role</li>
                                <li><strong>Tambah Pengguna Baru</strong> - Buat akun pengguna baru</li>
                                <li><strong>Edit Pengguna</strong> - Ubah informasi pengguna</li>
                                <li><strong>Hapus Pengguna</strong> - Hapus akun pengguna</li>
                            </ul>
                            <h6 class="mt-3">Cara Menggunakan:</h6>
                            <ol>
                                <li>Masuk ke menu Manajemen → Kelola Pengguna</li>
                                <li>Gunakan search untuk mencari pengguna berdasarkan nama/email</li>
                                <li>Gunakan filter Role untuk menyaring berdasarkan peran</li>
                                <li>Klik "Tambah Pengguna" untuk membuat pengguna baru</li>
                                <li>Klik ikon edit atau hapus untuk aksi pada pengguna tertentu</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Proyek -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-folder-fill"></i> Proyek
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Lihat Daftar Proyek</strong> - Tampilkan semua proyek yang ada</li>
                                <li><strong>Cari Proyek</strong> - Temukan proyek tertentu dengan cepat</li>
                                <li><strong>Status Proyek</strong> - Lihat status setiap proyek</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Laporan Bug -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-bug-fill"></i> Laporan Bug
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Lihat Bug Reports</strong> - Tampilkan semua laporan bug</li>
                                <li><strong>Filter Berdasarkan Status</strong> - Lihat bug yang belum/sudah diperbaiki</li>
                                <li><strong>Prioritas</strong> - Identifikasi bug berdasarkan tingkat prioritas</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Hasil Testing -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-check-circle-fill"></i> Hasil Testing
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Lihat Hasil Test</strong> - Tampilkan hasil test semua modul</li>
                                <li><strong>Progress Bar</strong> - Visualisasi persentase keberhasilan test</li>
                                <li><strong>Statistik</strong> - Total, passed, dan failed test count</li>
                                <li><strong>Color Coding</strong> - Warna hijau (80%+), kuning (50%+), merah (<50%)< /li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MONITORING -->
        <div class="tab-pane fade" id="monitoring" role="tabpanel" aria-labelledby="monitoring-tab">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Log Aktivitas -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-clock-history"></i> Log Aktivitas
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Catat Semua Aktivitas</strong> - Setiap aksi user dicatat otomatis</li>
                                <li><strong>Filter & Cari</strong> - Cari aktivitas berdasarkan user, aksi, atau waktu</li>
                                <li><strong>Timeline</strong> - Lihat urutan aktivitas chronological</li>
                            </ul>
                            <h6 class="mt-3">Informasi yang Dicatat:</h6>
                            <ul>
                                <li>Pengguna yang melakukan aksi</li>
                                <li>Jenis aksi (create, read, update, delete)</li>
                                <li>Model/tabel yang dipengaruhi</li>
                                <li>Waktu aksi terjadi</li>
                                <li>Perubahan data (sebelum & sesudah)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Laporan -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-graph-up"></i> Laporan
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Jenis Laporan Tersedia:</h6>
                            <ul>
                                <li><strong>Laporan User</strong> - Data & statistik pengguna</li>
                                <li><strong>Laporan Proyek</strong> - Progress dan status proyek</li>
                                <li><strong>Laporan Bug</strong> - Bug reports summary</li>
                                <li><strong>Laporan Testing</strong> - Test results dan coverage</li>
                                <li><strong>Laporan Performa</strong> - Sistem performance metrics</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Notifikasi -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-bell-fill"></i> Notifikasi
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Kirim Notifikasi</strong> - Kirim pesan ke semua user, role tertentu, atau user spesifik</li>
                                <li><strong>Tipe Notifikasi</strong> - Info, Success, Warning, Danger, Notification, System</li>
                                <li><strong>Dengan Icon</strong> - Tambahkan icon dan URL action</li>
                                <li><strong>Real-time Badge</strong> - Badge notifikasi otomatis update setiap 30 detik</li>
                            </ul>
                            <h6 class="mt-3">Cara Mengirim Notifikasi:</h6>
                            <ol>
                                <li>Klik tombol "Kirim Notifikasi" di halaman Notifikasi</li>
                                <li>Pilih tipe penerima:
                                    <ul>
                                        <li>Semua Pengguna - Ke seluruh user kecuali diri sendiri</li>
                                        <li>Berdasarkan Role - Ke user dengan role spesifik (superadmin, mastercard, dll)</li>
                                        <li>Pengguna Spesifik - Ke user terpilih saja</li>
                                    </ul>
                                </li>
                                <li>Pilih tipe notifikasi (icon akan otomatis sesuai tipe)</li>
                                <li>Masukkan judul dan isi notifikasi</li>
                                <li>Opsional: Masukkan URL action untuk link di notifikasi</li>
                                <li>Klik "Kirim"</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KONTEN -->
        <div class="tab-pane fade" id="konten" role="tabpanel" aria-labelledby="konten-tab">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Catatan -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-sticky"></i> Catatan (Notes)
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Buat Catatan</strong> - Tambah catatan dengan judul dan konten</li>
                                <li><strong>Kategori</strong> - Organisir catatan dengan kategori</li>
                                <li><strong>Pin Catatan</strong> - Pin catatan penting ke atas</li>
                                <li><strong>Edit & Hapus</strong> - Modifikasi atau hapus catatan</li>
                                <li><strong>Cari Catatan</strong> - Temukan catatan dengan cepat</li>
                            </ul>
                            <h6 class="mt-3">Cara Menggunakan:</h6>
                            <ol>
                                <li>Masuk ke Konten → Catatan</li>
                                <li>Klik "Tambah Catatan" untuk membuat catatan baru</li>
                                <li>Gunakan checkbox untuk pin catatan penting</li>
                                <li>Edit icon untuk mengubah catatan yang ada</li>
                                <li>Trash icon untuk menghapus catatan</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Obrolan/Chat -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-chat-dots-fill"></i> Obrolan/Chat
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur Utama:</h6>
                            <ul>
                                <li><strong>Chat Pribadi</strong> - Kirim pesan ke user tertentu</li>
                                <li><strong>Daftar User</strong> - Lihat semua pengguna yang tersedia</li>
                                <li><strong>Cari User</strong> - Cari user berdasarkan nama/email</li>
                                <li><strong>Bubble Chat</strong> - Visualisasi pesan yang rapi</li>
                                <li><strong>Real-time Update</strong> - Pesan terkirim langsung tanpa reload halaman</li>
                            </ul>
                            <h6 class="mt-3">Cara Menggunakan:</h6>
                            <ol>
                                <li>Masuk ke Konten → Obrolan/Chat</li>
                                <li>Cari user di kolom sebelah kiri</li>
                                <li>Klik user untuk membuka chat</li>
                                <li>Ketik pesan di input box dan tekan Send atau Enter</li>
                                <li>Pesan akan terkirim via AJAX tanpa perlu reload halaman</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ALAT -->
        <div class="tab-pane fade" id="alat" role="tabpanel" aria-labelledby="alat-tab">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Cadangan Data -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-cloud-download"></i> Cadangan Data
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur:</h6>
                            <ul>
                                <li>Buat backup database otomatis</li>
                                <li>Backup file media dan data</li>
                                <li>Schedule backup berkala</li>
                                <li>Download backup file untuk disimpan offline</li>
                            </ul>
                            <p class="mt-3">
                                <span class="badge bg-info">Tips:</span> Lakukan backup secara berkala untuk mencegah kehilangan data penting.
                            </p>
                        </div>
                    </div>

                    <!-- Ekspor Data -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-file-earmark-arrow-down"></i> Ekspor Data
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur:</h6>
                            <ul>
                                <li>Ekspor data user ke CSV/Excel</li>
                                <li>Ekspor log aktivitas ke Excel</li>
                                <li>Ekspor proyek dan bug reports</li>
                                <li>Ekspor test results dengan statistik</li>
                                <li>Custom field selection sebelum ekspor</li>
                            </ul>
                            <p class="mt-3">
                                <span class="badge bg-success">Gunakan untuk:</span> Analisis data, reporting, dan integrasi dengan sistem lain.
                            </p>
                        </div>
                    </div>

                    <!-- Impor Data -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-file-earmark-arrow-up"></i> Impor Data
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Fitur:</h6>
                            <ul>
                                <li>Impor user dari file CSV/Excel</li>
                                <li>Validasi data sebelum import</li>
                                <li>Error handling dan preview data</li>
                                <li>Mapping field otomatis atau manual</li>
                                <li>Duplicate handling (skip/replace)</li>
                            </ul>
                            <h6 class="mt-3">Format File yang Didukung:</h6>
                            <ul>
                                <li>CSV (.csv)</li>
                                <li>Excel (.xlsx, .xls)</li>
                            </ul>
                            <p class="mt-3">
                                <span class="badge bg-warning">Perhatian:</span> Pastikan format file sesuai template sebelum import.
                            </p>
                        </div>
                    </div>

                    <!-- Maintenance -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-gear-fill"></i> Pemeliharaan Sistem
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Tools Tersedia:</h6>
                            <ul>
                                <li><strong>Clear Cache</strong> - Bersihkan cache aplikasi untuk performa optimal</li>
                                <li><strong>Optimize Database</strong> - Optimalkan database untuk kecepatan query</li>
                                <li><strong>Sync Permissions</strong> - Sinkronisasi permissions dengan role terbaru</li>
                                <li><strong>Clear Logs</strong> - Hapus log sistem yang lama</li>
                                <li><strong>Reset Demo</strong> - Reset data demo ke kondisi awal</li>
                            </ul>
                            <p class="mt-3">
                                <span class="badge bg-danger">Hati-hati:</span> Beberapa aksi tidak dapat dibatalkan. Pastikan memiliki backup sebelum melakukan maintenance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Navigation -->
    <div class="row mt-5 mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="alert alert-info d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-3"></i>
                <div>
                    <strong>Butuh Bantuan Lebih?</strong> Lihat halaman <a href="{{ route('superadmin.bantuan.faq') }}" class="alert-link">FAQ</a> atau <a href="{{ route('superadmin.bantuan') }}" class="alert-link">Panduan Umum</a> untuk pertanyaan yang lebih spesifik.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        color: #6c757d;
        border: 0;
        border-bottom: 2px solid transparent;
        font-weight: 500;
    }

    .nav-tabs .nav-link:hover {
        border-bottom-color: #0d6efd;
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background-color: transparent;
        border-bottom-color: #0d6efd;
    }

    .card-header {
        border-bottom: 0;
    }

    .card-header h5 {
        font-weight: 600;
    }

    .tab-content {
        animation: fadeIn 0.3s ease-in;
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

<script>
    // Smooth scroll untuk tab content
    document.querySelectorAll('#panduan-tabs button').forEach(button => {
        button.addEventListener('click', function() {
            window.scrollTo({
                top: 300,
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection