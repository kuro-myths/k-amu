@extends('layouts.app')

@section('title', 'Impor Data')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-file-earmark-arrow-up"></i> Impor Data
            </h2>
            <p class="text-muted mt-1">Import data dari file Excel/CSV</p>
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Import Options -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-upload"></i> Upload File untuk Impor</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('superadmin.alat.impor') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pilih Tipe Data</label>
                            <select name="tipe" class="form-select" id="importType" required>
                                <option value="">-- Pilih Tipe Data --</option>
                                <option value="user">User Data</option>
                                <option value="project">Project Data</option>
                                <option value="bug">Bug Report Data</option>
                                <option value="note">Catatan/Note Data</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih File</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                            <small class="text-muted">Format yang didukung: Excel (.xlsx, .xls) atau CSV (.csv)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Duplicate Handling</label>
                            <select name="duplicate_action" class="form-select">
                                <option value="skip">Skip (Lewati data yang sudah ada)</option>
                                <option value="replace">Replace (Ganti data yang sudah ada)</option>
                                <option value="error">Error (Batalkan jika ada duplikat)</option>
                            </select>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="validate_only" id="validateOnly">
                            <label class="form-check-label" for="validateOnly">
                                Hanya Validasi (Preview tanpa import)
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-upload"></i> Impor Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Download Template</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Download template file untuk memastikan format yang benar</p>

                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-file-earmark-excel"></i> User Template
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-file-earmark-excel"></i> Project Template
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-file-earmark-excel"></i> Bug Report Template
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-file-earmark-excel"></i> Note Template
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Specifications -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-file-text"></i> Spesifikasi Template</h5>
                </div>
                <div class="card-body">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#userTemplate" data-bs-toggle="tab">User Template</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#projectTemplate" data-bs-toggle="tab">Project Template</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#bugTemplate" data-bs-toggle="tab">Bug Report Template</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="userTemplate">
                            <h6>Kolom yang Diperlukan:</h6>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Kolom</th>
                                        <th>Tipe</th>
                                        <th>Required</th>
                                        <th>Contoh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>name</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>John Doe</td>
                                    </tr>
                                    <tr>
                                        <td><code>email</code></td>
                                        <td>Email</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>john@example.com</td>
                                    </tr>
                                    <tr>
                                        <td><code>role</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>superadmin, user, leader, tester</td>
                                    </tr>
                                    <tr>
                                        <td><code>password</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-warning">Optional</span></td>
                                        <td>password123</td>
                                    </tr>
                                    <tr>
                                        <td><code>status</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-warning">Optional</span></td>
                                        <td>active, inactive</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="projectTemplate">
                            <h6>Kolom yang Diperlukan:</h6>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Kolom</th>
                                        <th>Tipe</th>
                                        <th>Required</th>
                                        <th>Contoh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>name</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>Project ABC</td>
                                    </tr>
                                    <tr>
                                        <td><code>description</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-warning">Optional</span></td>
                                        <td>Deskripsi proyek</td>
                                    </tr>
                                    <tr>
                                        <td><code>status</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>planning, ongoing, completed</td>
                                    </tr>
                                    <tr>
                                        <td><code>start_date</code></td>
                                        <td>Date</td>
                                        <td><span class="badge bg-warning">Optional</span></td>
                                        <td>2025-01-01</td>
                                    </tr>
                                    <tr>
                                        <td><code>end_date</code></td>
                                        <td>Date</td>
                                        <td><span class="badge bg-warning">Optional</span></td>
                                        <td>2025-12-31</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="bugTemplate">
                            <h6>Kolom yang Diperlukan:</h6>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Kolom</th>
                                        <th>Tipe</th>
                                        <th>Required</th>
                                        <th>Contoh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>title</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>Bug Title</td>
                                    </tr>
                                    <tr>
                                        <td><code>description</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-warning">Optional</span></td>
                                        <td>Bug description</td>
                                    </tr>
                                    <tr>
                                        <td><code>priority</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>low, medium, high, critical</td>
                                    </tr>
                                    <tr>
                                        <td><code>status</code></td>
                                        <td>Text</td>
                                        <td><span class="badge bg-danger">Ya</span></td>
                                        <td>open, in_progress, resolved, closed</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Import History -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-history"></i> Riwayat Impor</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tipe Data</th>
                                    <th>File Name</th>
                                    <th>Rows</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ now()->format('d M Y H:i') }}</td>
                                    <td><span class="badge bg-primary">User</span></td>
                                    <td>users_import.xlsx</td>
                                    <td>25</td>
                                    <td><span class="badge bg-success">Success</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ now()->subDays(1)->format('d M Y H:i') }}</td>
                                    <td><span class="badge bg-success">Project</span></td>
                                    <td>projects_import.xlsx</td>
                                    <td>10</td>
                                    <td><span class="badge bg-success">Success</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ now()->subDays(2)->format('d M Y H:i') }}</td>
                                    <td><span class="badge bg-danger">Bug</span></td>
                                    <td>bugs_import.xlsx</td>
                                    <td>5</td>
                                    <td><span class="badge bg-warning">Partial</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Important Notes -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <h5 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Perhatian Penting</h5>
                <ul class="mb-0">
                    <li>Pastikan format file sesuai dengan template yang disediakan</li>
                    <li>Validasi data sebelum import, terutama email dan data unik lainnya</li>
                    <li>Gunakan opsi "Validate Only" untuk preview terlebih dahulu</li>
                    <li>Backup data sebelum melakukan import data besar</li>
                    <li>File maksimal 10MB, bagi data besar menjadi beberapa file</li>
                    <li>Encoding file harus UTF-8 untuk mendukung karakter khusus</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection