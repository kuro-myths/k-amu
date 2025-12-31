@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Tambah Bimbingan</h2>
            <p class="text-muted">Tambahkan bimbingan baru untuk anggota tim</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Bimbingan Baru</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Peserta Bimbingan</label>
                            <select class="form-control" required>
                                <option value="">Pilih Peserta</option>
                                <option>Budi Santoso</option>
                                <option>Andi Wijaya</option>
                                <option>Siti Nurhaliza</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Topik Bimbingan</label>
                            <input type="text" class="form-control" placeholder="Contoh: Pengembangan Web" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="4" placeholder="Deskripsi bimbingan..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jadwal</label>
                            <input type="text" class="form-control" placeholder="Contoh: Setiap Rabu, 14:00" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control">
                                <option>Aktif</option>
                                <option>Nonaktif</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('leader.bimbingan') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection