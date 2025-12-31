@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Analisis & Laporan</h2>
            <p class="text-muted">Analisis performa proyek dan laporan perkembangan</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Grafik Performa Proyek</h5>
                </div>
                <div class="card-body">
                    <div id="performanceChart" style="height: 300px; background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                        <p class="text-muted">Grafik performa akan ditampilkan di sini</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted mb-1">Proyek Selesai</p>
                        <h4>5 / 12</h4>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1">Rata-rata Progress</p>
                        <h4>65%</h4>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1">Tim Aktif</p>
                        <h4>24 Orang</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Proyek</h5>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sistem K-AMU</td>
                                    <td><span class="badge bg-primary">Berjalan</span></td>
                                    <td>75%</td>
                                    <td>31 Des 2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection