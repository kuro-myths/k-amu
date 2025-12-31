@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="page-title">Detail Bimbingan</h2>
                <a href="{{ route('leader.bimbingan') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <p class="text-muted">Informasi lengkap bimbingan</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Bimbingan Pengembangan Web</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Peserta</label>
                            <p>Budi Santoso</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <p><span class="badge bg-success">Aktif</span></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Topik</label>
                            <p>Pengembangan Web</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jadwal</label>
                            <p>Setiap Rabu, 14:00</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <p>Bimbingan teknis untuk mengembangkan skills pengembangan web modern termasuk frontend dan backend.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Peserta</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> Budi Santoso</p>
                    <p><strong>Email:</strong> budi@example.com</p>
                    <p><strong>Role:</strong> <span class="badge bg-info">User</span></p>
                    <p><strong>Bergabung:</strong> 15 Jan 2025</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection