@extends('layouts.app')

@section('title', 'Frequently Asked Questions (FAQ)')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-question-circle-fill"></i> Frequently Asked Questions
            </h2>
            <p class="text-muted mt-1">Jawaban atas pertanyaan yang sering diajukan</p>
        </div>
    </div>

    <!-- Search FAQ -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <input type="text" class="form-control form-control-lg" id="faqSearch" placeholder="Cari pertanyaan..."
                style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
        </div>
    </div>

    <!-- FAQ Accordion -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="accordion" id="faqAccordion">
                <!-- User Management -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq1" aria-expanded="false">
                            <i class="bi bi-people-fill me-2 text-primary"></i>
                            <strong>Bagaimana cara menambah pengguna baru?</strong>
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk menambah pengguna baru:</p>
                            <ol>
                                <li>Masuk ke menu <strong>Manajemen → Kelola Pengguna</strong></li>
                                <li>Klik tombol <strong>"Tambah Pengguna"</strong></li>
                                <li>Isi form dengan data pengguna (Nama, Email, Role, dll)</li>
                                <li>Klik <strong>"Simpan"</strong></li>
                                <li>Email notifikasi akan dikirim ke pengguna baru</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Password Reset -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq2" aria-expanded="false">
                            <i class="bi bi-key-fill me-2 text-warning"></i>
                            <strong>Bagaimana cara me-reset password pengguna?</strong>
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk me-reset password:</p>
                            <ol>
                                <li>Buka halaman <strong>Manajemen → Kelola Pengguna</strong></li>
                                <li>Cari pengguna yang akan di-reset passwordnya</li>
                                <li>Klik ikon <strong>"Edit"</strong></li>
                                <li>Masukkan password baru di field yang tersedia</li>
                                <li>Klik <strong>"Simpan"</strong></li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Notification -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq3" aria-expanded="false">
                            <i class="bi bi-bell-fill me-2 text-danger"></i>
                            <strong>Bagaimana cara mengirim notifikasi ke pengguna?</strong>
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk mengirim notifikasi:</p>
                            <ol>
                                <li>Masuk ke <strong>Monitoring → Notifikasi</strong></li>
                                <li>Klik tombol <strong>"Kirim Notifikasi"</strong></li>
                                <li>Pilih tipe penerima:
                                    <ul>
                                        <li><strong>Semua Pengguna</strong> - Ke semua user</li>
                                        <li><strong>Berdasarkan Role</strong> - Ke user dengan role spesifik</li>
                                        <li><strong>Pengguna Spesifik</strong> - Ke user terpilih</li>
                                    </ul>
                                </li>
                                <li>Isi judul, konten, dan tipe notifikasi</li>
                                <li>Klik <strong>"Kirim"</strong></li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Chat -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq4" aria-expanded="false">
                            <i class="bi bi-chat-dots-fill me-2 text-info"></i>
                            <strong>Bagaimana cara menggunakan fitur chat?</strong>
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk menggunakan fitur chat:</p>
                            <ol>
                                <li>Masuk ke <strong>Konten → Obrolan/Chat</strong></li>
                                <li>Pilih pengguna dari daftar di sebelah kiri</li>
                                <li>Ketik pesan di input box di bawah</li>
                                <li>Tekan <strong>Enter</strong> atau klik tombol <strong>"Send"</strong></li>
                                <li>Pesan akan langsung terkirim tanpa perlu reload halaman</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Reports -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq5" aria-expanded="false">
                            <i class="bi bi-graph-up me-2 text-success"></i>
                            <strong>Bagaimana cara melihat laporan?</strong>
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk melihat laporan:</p>
                            <ol>
                                <li>Masuk ke <strong>Monitoring → Laporan</strong></li>
                                <li>Pilih tipe laporan yang ingin dilihat</li>
                                <li>Gunakan filter untuk menyaring data sesuai kebutuhan</li>
                                <li>Export ke Excel atau Print jika diperlukan</li>
                            </ol>
                            <p><strong>Jenis Laporan yang Tersedia:</strong></p>
                            <ul>
                                <li>Laporan Analisis - Ringkasan data sistem</li>
                                <li>Laporan Bug - Bug reports dan status</li>
                                <li>Laporan Penggunaan - Aktivitas user</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Backup -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq6" aria-expanded="false">
                            <i class="bi bi-cloud-download me-2 text-primary"></i>
                            <strong>Bagaimana cara membuat backup?</strong>
                        </button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk membuat backup:</p>
                            <ol>
                                <li>Masuk ke <strong>Alat → Cadangan Data</strong></li>
                                <li>Klik tombol <strong>"Buat Backup"</strong></li>
                                <li>Tunggu proses backup selesai</li>
                                <li>Download file backup yang telah dibuat</li>
                                <li>Simpan di tempat yang aman</li>
                            </ol>
                            <p><strong>Tips:</strong> Lakukan backup secara berkala (minimal seminggu sekali) untuk keamanan data.</p>
                        </div>
                    </div>
                </div>

                <!-- Export/Import -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq7" aria-expanded="false">
                            <i class="bi bi-arrow-left-right me-2 text-info"></i>
                            <strong>Bagaimana cara ekspor/impor data?</strong>
                        </button>
                    </h2>
                    <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p><strong>Ekspor Data:</strong></p>
                            <ol>
                                <li>Masuk ke <strong>Alat → Ekspor Data</strong></li>
                                <li>Pilih tipe data yang ingin diexpor (User, Log, dll)</li>
                                <li>Klik tombol <strong>"Ekspor"</strong></li>
                                <li>File Excel akan didownload otomatis</li>
                            </ol>
                            <p><strong>Impor Data:</strong></p>
                            <ol>
                                <li>Masuk ke <strong>Alat → Impor Data</strong></li>
                                <li>Upload file Excel dengan data yang sesuai format</li>
                                <li>Sistem akan preview data sebelum import</li>
                                <li>Klik <strong>"Impor"</strong> untuk memproses</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Cache -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq8" aria-expanded="false">
                            <i class="bi bi-lightning-fill me-2 text-warning"></i>
                            <strong>Kapan harus clear cache?</strong>
                        </button>
                    </h2>
                    <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Anda perlu clear cache ketika:</p>
                            <ul>
                                <li>Ada update fitur atau perubahan sistem</li>
                                <li>Halaman terasa lambat atau tidak responsif</li>
                                <li>Ada error yang berkaitan dengan cache</li>
                                <li>Secara periodik (1x seminggu) untuk performa optimal</li>
                            </ul>
                            <p><strong>Cara Clear Cache:</strong></p>
                            <ol>
                                <li>Masuk ke <strong>Alat → Dashboard Alat</strong></li>
                                <li>Klik tombol <strong>"Hapus Cache"</strong></li>
                                <li>Tunggu proses selesai</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq9" aria-expanded="false">
                            <i class="bi bi-tools me-2 text-danger"></i>
                            <strong>Bagaimana cara mengatasi error?</strong>
                        </button>
                    </h2>
                    <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p><strong>Solusi Umum untuk Error:</strong></p>
                            <ol>
                                <li><strong>Clear Browser Cache</strong> - Tekan Ctrl+Shift+Delete</li>
                                <li><strong>Clear Application Cache</strong> - Alat → Dashboard Alat → Hapus Cache</li>
                                <li><strong>Refresh Halaman</strong> - Tekan F5 atau Ctrl+R</li>
                                <li><strong>Logout dan Login Ulang</strong> - Keluar dan masuk kembali</li>
                                <li><strong>Check Browser Compatibility</strong> - Gunakan browser terbaru</li>
                            </ol>
                            <p><strong>Jika masalah tetap ada:</strong></p>
                            <ul>
                                <li>Hubungi administrator sistem</li>
                                <li>Lihat detail error di browser console (F12)</li>
                                <li>Check sistem requirements</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq10" aria-expanded="false">
                            <i class="bi bi-envelope-fill me-2 text-info"></i>
                            <strong>Bagaimana cara menghubungi support?</strong>
                        </button>
                    </h2>
                    <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Untuk mendapatkan support:</p>
                            <ul>
                                <li><strong>Email:</strong> support@k-amu.local</li>
                                <li><strong>In-App Chat:</strong> Gunakan fitur Konten → Obrolan</li>
                                <li><strong>Help Center:</strong> Lihat menu Bantuan</li>
                                <li><strong>Direct Contact:</strong> Hubungi admin system</li>
                            </ul>
                            <p><strong>Response Time:</strong> Biasanya dalam 24 jam kerja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="row mt-5 mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="alert alert-info d-flex align-items-center">
                <i class="bi bi-lightbulb me-3"></i>
                <div>
                    <strong>Tidak menemukan jawaban?</strong> Lihat <a href="{{ route('superadmin.bantuan.panduan') }}" class="alert-link">Panduan Lengkap</a> atau hubungi support kami.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-item {
        border: 0 !important;
    }

    .accordion-button {
        border: 0;
        background-color: #f8f9fa;
        color: #212529;
    }

    .accordion-button:not(.collapsed) {
        background-color: #e7f3ff;
        color: #0d6efd;
    }

    .accordion-button:focus {
        border-color: #0d6efd;
        box-shadow: none;
    }
</style>

<script>
    // FAQ Search functionality
    document.getElementById('faqSearch').addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.accordion-item');

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endsection