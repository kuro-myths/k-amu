@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Proyek Saya</h2>
            <p class="text-muted">Kelola proyek yang Anda pimpin</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Proyek</h5>
                <a href="{{ route('leader.proyek.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Buat Proyek Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Proyek</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Deadline</th>
                            <th>Anggota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sistem K-AMU</td>
                            <td><span class="badge bg-primary">Berjalan</span></td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" style="width: 75%">75%</div>
                                </div>
                            </td>
                            <td>31 Des 2025</td>
                            <td>12 Orang</td>
                            <td>
                                <a href="{{ route('leader.proyek.detail', 1) }}" class="btn btn-sm btn-info">Lihat</a>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
