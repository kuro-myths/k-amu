@extends('layouts.app')

@section('title', 'Ekspor Data')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-file-earmark-arrow-down"></i> Ekspor Data
            </h2>
            <p class="text-muted mt-1">Export data ke format Excel/CSV</p>
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Export Options -->
    <div class="row">
        <!-- User Data Export -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-people"></i> Ekspor Data User</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Total user: <strong>{{ \App\Models\User::count() }}</strong></p>

                    <label class="form-label">Pilih Field yang ingin diexport:</label>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="userField1" checked>
                            <label class="form-check-label" for="userField1">Nama</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="userField2" checked>
                            <label class="form-check-label" for="userField2">Email</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="userField3" checked>
                            <label class="form-check-label" for="userField3">Role</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="userField4" checked>
                            <label class="form-check-label" for="userField4">Status</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="userField5" checked>
                            <label class="form-check-label" for="userField5">Tanggal Daftar</label>
                        </div>
                    </div>

                    <form action="{{ route('superadmin.alat.ekspor') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="tipe" value="user">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-download"></i> Ekspor User ke Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Activity Log Export -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-clock-history"></i> Ekspor Activity Log</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Total log: <strong>{{ \App\Models\ActivityLog::count() }}</strong></p>

                    <label class="form-label">Periode:</label>
                    <select class="form-select mb-3">
                        <option value="all">Semua Data</option>
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month" selected>Bulan Ini</option>
                        <option value="custom">Custom Range</option>
                    </select>

                    <form action="{{ route('superadmin.alat.ekspor') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="tipe" value="activity">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-download"></i> Ekspor Activity Log
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Project Export -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-folder"></i> Ekspor Data Proyek</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Total proyek: <strong>{{ \App\Models\Project::count() }}</strong></p>

                    <label class="form-label">Filter Status:</label>
                    <select class="form-select mb-3">
                        <option value="">Semua Status</option>
                        <option value="planning">Planning</option>
                        <option value="ongoing" selected>Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="archived">Archived</option>
                    </select>

                    <form action="{{ route('superadmin.alat.ekspor') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="tipe" value="project">
                        <button type="submit" class="btn btn-info w-100">
                            <i class="bi bi-download"></i> Ekspor Proyek
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bug Report Export -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="bi bi-bug"></i> Ekspor Laporan Bug</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Total bug: <strong>{{ \App\Models\BugReport::count() }}</strong></p>

                    <label class="form-label">Filter Status:</label>
                    <select class="form-select mb-3">
                        <option value="">Semua Status</option>
                        <option value="open" selected>Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                        <option value="closed">Closed</option>
                    </select>

                    <form action="{{ route('superadmin.alat.ekspor') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="tipe" value="bug">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-download"></i> Ekspor Bug Report
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Test Result Export -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="bi bi-check-circle"></i> Ekspor Hasil Testing</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Total testing: <strong>{{ \App\Models\TestResult::count() }}</strong></p>

                    <label class="form-label">Format Export:</label>
                    <select class="form-select mb-3">
                        <option value="excel" selected>Excel (.xlsx)</option>
                        <option value="csv">CSV (.csv)</option>
                        <option value="pdf">PDF</option>
                    </select>

                    <form action="{{ route('superadmin.alat.ekspor') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="tipe" value="testing">
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="bi bi-download"></i> Ekspor Testing Result
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Note Export -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-sticky"></i> Ekspor Catatan</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Total catatan: <strong>{{ \App\Models\Note::count() ?? 0 }}</strong></p>

                    <label class="form-label">Format Export:</label>
                    <select class="form-select mb-3">
                        <option value="excel" selected>Excel (.xlsx)</option>
                        <option value="csv">CSV (.csv)</option>
                    </select>

                    <form action="{{ route('superadmin.alat.ekspor') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="tipe" value="note">
                        <button type="submit" class="btn btn-secondary w-100">
                            <i class="bi bi-download"></i> Ekspor Catatan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Export History -->
    <div class="row mt-4 mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-history"></i> Riwayat Ekspor</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tipe Data</th>
                                    <th>Format</th>
                                    <th>Ukuran File</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ now()->format('d M Y H:i') }}</td>
                                    <td>User Data</td>
                                    <td>Excel</td>
                                    <td>2.5 MB</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="bi bi-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ now()->subHours(2)->format('d M Y H:i') }}</td>
                                    <td>Activity Log</td>
                                    <td>Excel</td>
                                    <td>5.2 MB</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="bi bi-download"></i> Download
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

    <!-- Tips -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <h5 class="alert-heading"><i class="bi bi-lightbulb"></i> Tips Ekspor</h5>
                <ul class="mb-0">
                    <li>Pilih field yang relevan untuk memperkecil ukuran file</li>
                    <li>Gunakan filter untuk mengekspor data spesifik saja</li>
                    <li>File akan tersimpan di folder downloads browser</li>
                    <li>Format Excel cocok untuk analisis di spreadsheet tools</li>
                    <li>Format CSV cocok untuk integrasi dengan sistem lain</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection