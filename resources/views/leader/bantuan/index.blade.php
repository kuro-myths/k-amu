@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Bantuan & Panduan</h2>
            <p class="text-muted">Panduan penggunaan dan FAQ</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="accordion" id="helpAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Bagaimana cara membuat proyek baru?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk membuat proyek baru, ikuti langkah berikut:</p>
                            <ol>
                                <li>Masuk ke menu <strong>Proyek</strong></li>
                                <li>Klik tombol <strong>Buat Proyek</strong></li>
                                <li>Isi formulir dengan detail proyek</li>
                                <li>Klik <strong>Simpan</strong></li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana cara menambah anggota tim?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk menambah anggota tim ke proyek:</p>
                            <ol>
                                <li>Pilih proyek yang ingin dikelola</li>
                                <li>Buka tab <strong>Anggota Tim</strong></li>
                                <li>Klik <strong>Tambah Anggota</strong></li>
                                <li>Pilih pengguna dan tentukan role mereka</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Bagaimana cara memberikan bimbingan?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <p>Untuk memberikan bimbingan kepada pengguna:</p>
                            <ol>
                                <li>Masuk ke menu <strong>Bimbingan</strong></li>
                                <li>Klik <strong>Tambah Bimbingan</strong></li>
                                <li>Pilih pengguna yang akan dibimbing</li>
                                <li>Isi detail bimbingan dan jadwal</li>
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