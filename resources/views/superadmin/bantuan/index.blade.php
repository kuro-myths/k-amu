@extends('layouts.app')

@section('title', 'Bantuan & Dokumentasi')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-question-circle-fill"></i> Bantuan & Dokumentasi
            </h2>
            <p class="text-muted mt-1">Panduan penggunaan K-AMU</p>
        </div>
    </div>

    <!-- Search Help -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <input type="text" class="form-control form-control-lg" id="helpSearch" placeholder="Cari bantuan..."
                style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
        </div>
    </div>

    <!-- FAQ Accordion -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="accordion" id="helpAccordion">
                <!-- Getting Started -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#getStarted" aria-expanded="false">
                            <i class="bi bi-rocket-fill me-2 text-primary"></i>
                            <strong>Memulai dengan K-AMU</strong>
                        </button>
                    </h2>
                    <div id="getStarted" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>1. Login ke Aplikasi</h6>
                            <p>Gunakan email dan password Anda untuk masuk ke sistem. Setiap user mempunyai role berbeda yang menentukan akses mereka.</p>

                            <h6>2. Memahami Dashboard</h6>
                            <p>Setelah login, Anda akan melihat dashboard sesuai role Anda. Dashboard menampilkan ringkasan informasi penting.</p>

                            <h6>3. Navigasi Menu</h6>
                            <p>Gunakan menu samping atau top navigation untuk mengakses berbagai fitur aplikasi.</p>
                        </div>
                    </div>
                </div>

                <!-- User Management -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#userMgmt" aria-expanded="false">
                            <i class="bi bi-people-fill me-2 text-success"></i>
                            <strong>Manajemen Pengguna</strong>
                        </button>
                    </h2>
                    <div id="userMgmt" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>Tambah Pengguna Baru</h6>
                            <p>Klik "Pengguna Baru" untuk menambahkan user. Isi semua field yang diperlukan seperti nama, email, dan role.</p>

                            <h6>Edit Pengguna</h6>
                            <p>Klik tombol edit pada baris pengguna untuk mengubah informasi. Tidak semua field dapat diubah untuk alasan keamanan.</p>

                            <h6>Hapus Pengguna</h6>
                            <p>Klik tombol hapus dan konfirmasi. Data pengguna akan dihapus secara soft delete (tidak permanen).</p>

                            <h6>Filter & Pencarian</h6>
                            <p>Gunakan kotak pencarian untuk cari nama atau email, dan gunakan filter role untuk menampilkan pengguna tertentu.</p>
                        </div>
                    </div>
                </div>

                <!-- Notes Management -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#notesMgmt" aria-expanded="false">
                            <i class="bi bi-sticky-fill me-2 text-warning"></i>
                            <strong>Manajemen Catatan</strong>
                        </button>
                    </h2>
                    <div id="notesMgmt" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>Membuat Catatan</h6>
                            <p>Klik "Catatan Baru" untuk membuat catatan pribadi. Anda dapat memilih kategori dan warna untuk memudahkan identifikasi.</p>

                            <h6>Kategori Catatan</h6>
                            <ul>
                                <li><strong>Pribadi:</strong> Catatan pribadi Anda</li>
                                <li><strong>Pekerjaan:</strong> Catatan terkait pekerjaan</li>
                                <li><strong>Ide:</strong> Ide atau brainstorm</li>
                                <li><strong>Ingatkan:</strong> Reminder penting</li>
                                <li><strong>Lainnya:</strong> Kategori lainnya</li>
                            </ul>

                            <h6>Pin Catatan</h6>
                            <p>Gunakan checkbox "Pin" saat membuat/edit catatan agar selalu muncul di atas.</p>
                        </div>
                    </div>
                </div>

                <!-- Projects -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#projects" aria-expanded="false">
                            <i class="bi bi-briefcase-fill me-2 text-info"></i>
                            <strong>Manajemen Proyek</strong>
                        </button>
                    </h2>
                    <div id="projects" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>Membuat Proyek</h6>
                            <p>Hanya Leader yang dapat membuat proyek. Isi nama proyek, deskripsi, dan tambahkan anggota tim.</p>

                            <h6>Status Proyek</h6>
                            <ul>
                                <li><strong>Planning:</strong> Fase perencanaan</li>
                                <li><strong>In Progress:</strong> Sedang dikerjakan</li>
                                <li><strong>Testing:</strong> Fase testing</li>
                                <li><strong>Completed:</strong> Selesai</li>
                                <li><strong>On Hold:</strong> Ditangguhkan</li>
                            </ul>

                            <h6>Progress Tracking</h6>
                            <p>Update progress proyek secara berkala agar semua anggota tim selalu terinformasi.</p>
                        </div>
                    </div>
                </div>

                <!-- Bug Reports -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#bugs" aria-expanded="false">
                            <i class="bi bi-bug-fill me-2 text-danger"></i>
                            <strong>Bug Reporting</strong>
                        </button>
                    </h2>
                    <div id="bugs" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>Melaporkan Bug</h6>
                            <p>Jika Anda menemukan kesalahan, klik "Laporkan Bug" dan isi detail bug dengan jelas.</p>

                            <h6>Severity Levels</h6>
                            <ul>
                                <li><strong>Critical:</strong> Sistem tidak berfungsi</li>
                                <li><strong>High:</strong> Fitur utama terganggu</li>
                                <li><strong>Medium:</strong> Masalah minor tapi berpengaruh</li>
                                <li><strong>Low:</strong> Masalah kosmetik</li>
                            </ul>

                            <h6>Status Bug</h6>
                            <p>Monitor status bug Anda dari open, assigned, in review, hingga resolved.</p>
                        </div>
                    </div>
                </div>

                <!-- Communication -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#communication" aria-expanded="false">
                            <i class="bi bi-chat-dots-fill me-2 text-secondary"></i>
                            <strong>Komunikasi & Chat</strong>
                        </button>
                    </h2>
                    <div id="communication" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>Obrolan Global</h6>
                            <p>Gunakan fitur chat global untuk berkomunikasi dengan semua pengguna di sistem.</p>

                            <h6>Pesan Pribadi</h6>
                            <p>Kirim pesan langsung ke pengguna lain melalui menu pesan pribadi.</p>

                            <h6>Notifikasi</h6>
                            <p>Anda akan menerima notifikasi untuk pesan baru, update proyek, dan aktivitas penting lainnya.</p>
                        </div>
                    </div>
                </div>

                <!-- Security & Privacy -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#security" aria-expanded="false">
                            <i class="bi bi-shield-lock me-2 text-primary"></i>
                            <strong>Keamanan & Privasi</strong>
                        </button>
                    </h2>
                    <div id="security" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>Password Aman</h6>
                            <p>Gunakan password yang kuat dengan kombinasi huruf besar, kecil, angka, dan simbol.</p>

                            <h6>Jangan Bagikan Akun</h6>
                            <p>Jangan pernah bagikan akun atau password Anda kepada orang lain.</p>

                            <h6>Logout</h6>
                            <p>Selalu logout setelah selesai menggunakan aplikasi, terutama di komputer publik.</p>

                            <h6>Lapor Masalah Keamanan</h6>
                            <p>Jika Anda menemukan masalah keamanan, hubungi admin segera.</p>
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#troubleshooting" aria-expanded="false">
                            <i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i>
                            <strong>Troubleshooting</strong>
                        </button>
                    </h2>
                    <div id="troubleshooting" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <h6>Lupa Password</h6>
                            <p>Klik "Lupa Password" di halaman login dan ikuti instruksi untuk reset password.</p>

                            <h6>Halaman Tidak Memuat</h6>
                            <p>Refresh halaman atau clear browser cache. Jika tetap bermasalah, hubungi support.</p>

                            <h6>Error 403/404</h6>
                            <p>Error ini biasanya berarti Anda tidak memiliki akses. Hubungi admin jika ini kesalahan.</p>

                            <h6>Masalah Lainnya</h6>
                            <p>Jika mengalami masalah, hubungi support dengan mengirim deskripsi masalah yang detail.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="row mt-5">
        <div class="col-md-6 mx-auto">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body text-center p-5">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-headset"></i> Butuh Bantuan Lebih Lanjut?
                    </h5>
                    <p class="text-muted mb-3">Hubungi tim support kami</p>
                    <a href="mailto:support@k-amu.test" class="btn btn-primary me-2">
                        <i class="bi bi-envelope"></i> Email Support
                    </a>
                    <a href="tel:+628123456789" class="btn btn-outline-primary">
                        <i class="bi bi-telephone"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('helpSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const accordionItems = document.querySelectorAll('.accordion-item');

        accordionItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? 'block' : 'none';
        });
    });
</script>
@endsection