@extends('layouts.app')

@section('title', 'Kelola Peran')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-shield-lock-fill text-primary"></i> Kelola Peran & Izin
            </h1>
            <p class="text-muted mb-0">Atur peran pengguna dan izin akses dalam sistem</p>
        </div>
        <a href="#" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Peran
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Roles Overview -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h4 class="text-primary fw-bold">5</h4>
                    <p class="text-muted mb-0">Total Peran</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h4 class="text-success fw-bold">25+</h4>
                    <p class="text-muted mb-0">Total Izin</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h4 class="text-warning fw-bold">150+</h4>
                    <p class="text-muted mb-0">Pengguna Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h4 class="text-info fw-bold">8</h4>
                    <p class="text-muted mb-0">Izin Terakhir Diubah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Roles Table -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light border-0">
            <h5 class="mb-0">Daftar Peran</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">Nama Peran</th>
                        <th class="fw-bold">Deskripsi</th>
                        <th class="fw-bold">Jumlah Pengguna</th>
                        <th class="fw-bold">Jumlah Izin</th>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-muted">1</td>
                        <td>
                            <strong><i class="bi bi-star-fill text-warning"></i> Superadmin</strong>
                        </td>
                        <td>
                            <small class="text-muted">Akses penuh ke semua fitur sistem</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">2</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">Semua</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Aktif</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">2</td>
                        <td>
                            <strong><i class="bi bi-credit-card-fill text-info"></i> Mastercard</strong>
                        </td>
                        <td>
                            <small class="text-muted">Kelola proyek dan anggota tim</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">5</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">18</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Aktif</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">3</td>
                        <td>
                            <strong><i class="bi bi-people-fill text-success"></i> Leader</strong>
                        </td>
                        <td>
                            <small class="text-muted">Kelola anggota dan monitor progress</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">8</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">12</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Aktif</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">4</td>
                        <td>
                            <strong><i class="bi bi-bug-fill text-danger"></i> Tester</strong>
                        </td>
                        <td>
                            <small class="text-muted">Lakukan testing dan lapor bug</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">45</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">8</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Aktif</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">5</td>
                        <td>
                            <strong><i class="bi bi-person-fill text-secondary"></i> Pengguna</strong>
                        </td>
                        <td>
                            <small class="text-muted">Pengguna biasa dengan akses terbatas</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">95</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">5</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Aktif</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-outline-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="#" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Permissions Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light border-0">
            <h5 class="mb-0">Izin per Peran</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">Izin</th>
                            <th class="text-center">
                                <i class="bi bi-star-fill text-warning"></i> Superadmin
                            </th>
                            <th class="text-center">
                                <i class="bi bi-credit-card-fill text-info"></i> Mastercard
                            </th>
                            <th class="text-center">
                                <i class="bi bi-people-fill text-success"></i> Leader
                            </th>
                            <th class="text-center">
                                <i class="bi bi-bug-fill text-danger"></i> Tester
                            </th>
                            <th class="text-center">
                                <i class="bi bi-person-fill text-secondary"></i> Pengguna
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Kelola Pengguna</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><strong>Kelola Proyek</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><strong>Buat Laporan Bug</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><strong>Lakukan Testing</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><strong>Kelola Catatan</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center">-</td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                        </tr>
                        <tr>
                            <td><strong>Buat Pesan</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                        </tr>
                        <tr>
                            <td><strong>Lihat Laporan</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><strong>Kelola Setting Sistem</strong></td>
                            <td class="text-center"><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection