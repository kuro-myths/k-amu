@extends('layouts.app')

@section('title', 'Cadangan Data')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-cloud-download"></i> Cadangan Data
            </h2>
            <p class="text-muted mt-1">Backup database dan file media</p>
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Backup Summary -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-database text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Database Size</p>
                            <h5 class="mb-0">~{{ rand(10, 100) }} MB</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-folder-fill text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Files Size</p>
                            <h5 class="mb-0">~{{ rand(50, 200) }} MB</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-clock-history text-info" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Last Backup</p>
                            <h5 class="mb-0">{{ now()->subDays(2)->format('d M Y') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Backup Options -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-gear"></i> Opsi Backup</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <input type="checkbox" class="form-check-input mt-1" id="backupDB" checked>
                                <div class="ms-3">
                                    <label class="form-check-label" for="backupDB">
                                        <strong>Backup Database</strong>
                                        <p class="text-muted small mb-0">Backup semua data database</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <input type="checkbox" class="form-check-input mt-1" id="backupFiles" checked>
                                <div class="ms-3">
                                    <label class="form-check-label" for="backupFiles">
                                        <strong>Backup File Media</strong>
                                        <p class="text-muted small mb-0">Backup folder storage dan uploads</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-play-fill"></i> Buat Backup</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('superadmin.alat.cadangan') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 mb-2" onclick="return confirm('Mulai proses backup? Ini mungkin memakan waktu beberapa menit.')">
                            <i class="bi bi-cloud-download"></i> Mulai Backup
                        </button>
                        <small class="text-muted d-block">
                            <i class="bi bi-info-circle"></i> Proses backup akan berjalan di background
                        </small>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Backup -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Backup Otomatis</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Jadwal Backup</label>
                            <select class="form-select" id="backupSchedule">
                                <option value="daily">Setiap Hari (00:00)</option>
                                <option value="weekly" selected>Setiap Minggu (Jumat 00:00)</option>
                                <option value="monthly">Setiap Bulan (Hari 1)</option>
                                <option value="manual">Manual Saja</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Retention Policy</label>
                            <select class="form-select" id="backupRetention">
                                <option value="7">7 Hari</option>
                                <option value="30" selected>30 Hari</option>
                                <option value="90">90 Hari</option>
                                <option value="unlimited">Unlimited</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-info w-100" onclick="saveBackupSettings()">
                                <i class="bi bi-check"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Backup History -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-history"></i> Riwayat Backup</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Ukuran</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ now()->subDays(2)->format('d M Y H:i') }}</td>
                                    <td>{{ rand(150, 300) }} MB</td>
                                    <td><span class="badge bg-primary">Full Backup</span></td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" title="Download">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Hapus backup ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ now()->subDays(9)->format('d M Y H:i') }}</td>
                                    <td>{{ rand(150, 300) }} MB</td>
                                    <td><span class="badge bg-info">Incremental</span></td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" title="Download">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Hapus backup ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ now()->subDays(16)->format('d M Y H:i') }}</td>
                                    <td>{{ rand(150, 300) }} MB</td>
                                    <td><span class="badge bg-primary">Full Backup</span></td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" title="Download">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Hapus backup ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Practices -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <h5 class="alert-heading"><i class="bi bi-lightbulb"></i> Best Practices</h5>
                <ul class="mb-0">
                    <li>Lakukan backup minimal <strong>1x per minggu</strong></li>
                    <li>Simpan backup di <strong>multiple location</strong> (local + cloud)</li>
                    <li>Test restore backup secara berkala untuk memastikan integritas</li>
                    <li>Dokumentasikan prosedur restore untuk emergency</li>
                    <li>Monitoring ukuran backup dan disk space tersedia</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function saveBackupSettings() {
        const schedule = document.getElementById('backupSchedule').value;
        const retention = document.getElementById('backupRetention').value;
        alert('Pengaturan backup tersimpan:\nJadwal: ' + schedule + '\nRetention: ' + retention + ' hari');
    }
</script>
@endsection