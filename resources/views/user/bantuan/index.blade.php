@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Bantuan & Panduan</h2>
            <p class="text-muted">Panduan penggunaan platform K-AMU</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="accordion" id="helpAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Bagaimana cara mengakses proyek?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk mengakses proyek:</p>
                            <ol>
                                <li>Buka menu <strong>Proyek</strong> di sidebar</li>
                                <li>Lihat daftar proyek yang tersedia</li>
                                <li>Klik <strong>Lihat</strong> untuk melihat detail proyek</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana cara membuat catatan?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk membuat catatan:</p>
                            <ol>
                                <li>Buka menu <strong>Catatan</strong></li>
                                <li>Klik tombol <strong>Catatan Baru</strong></li>
                                <li>Isi formulir dengan judul dan konten</li>
                                <li>Klik <strong>Simpan</strong></li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Bagaimana cara berkomunikasi dengan guru?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk berkomunikasi:</p>
                            <ol>
                                <li>Buka menu <strong>Obrolan</strong></li>
                                <li>Pilih kontak guru atau teman</li>
                                <li>Ketik pesan Anda</li>
                                <li>Klik <strong>Kirim</strong></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Hubungi Kami</h5>
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