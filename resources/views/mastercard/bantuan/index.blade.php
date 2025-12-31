@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Bantuan & Panduan</h2>
            <p class="text-muted">Panduan penggunaan sistem admin</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="accordion" id="helpAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Bagaimana cara mengelola pengguna?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk mengelola pengguna:</p>
                            <ol>
                                <li>Buka menu <strong>Manajemen > Kelola Pengguna</strong></li>
                                <li>Lihat daftar semua pengguna sistem</li>
                                <li>Edit atau hapus pengguna sesuai kebutuhan</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana menggunakan fitur export/import?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk export/import data:</p>
                            <ol>
                                <li>Buka menu <strong>Alat & Utilitas</strong></li>
                                <li>Pilih <strong>Export</strong> untuk download data</li>
                                <li>Atau pilih <strong>Import</strong> untuk upload data</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Bagaimana membuat backup?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk membuat backup sistem:</p>
                            <ol>
                                <li>Buka menu <strong>Alat & Utilitas</strong></li>
                                <li>Klik <strong>Backup</strong></li>
                                <li>Tunggu proses backup selesai</li>
                                <li>Download file backup yang telah dibuat</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Hubungi Tim Support</h5>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong></p>
                    <p><a href="mailto:support@k-amu.com">support@k-amu.com</a></p>
                    
                    <p class="mt-3"><strong>Telepon:</strong></p>
                    <p>+62-xxx-xxxx-xxxx</p>
                    
                    <p class="mt-3"><strong>Jam Kerja:</strong></p>
                    <p>Senin - Jumat, 08:00 - 17:00</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
