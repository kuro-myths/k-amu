@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Bimbingan</h2>
            <p class="text-muted">Kelola bimbingan untuk pengguna</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Bimbingan</h5>
                <a href="{{ route('leader.bimbingan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Tambah Bimbingan
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Topik</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Budi Santoso</td>
                            <td>Pengembangan Web</td>
                            <td>Setiap Rabu, 14:00</td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <a href="{{ route('leader.bimbingan.detail', 1) }}" class="btn btn-sm btn-info">Lihat</a>
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
