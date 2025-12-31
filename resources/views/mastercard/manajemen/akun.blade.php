@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Kelola Akun</h2>
            <p class="text-muted">Manage akun admin</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Admin</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="Mastercard" disabled>
                    </div>
                    <button class="btn btn-primary">Edit Akun</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Keamanan</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-warning w-100 mb-2">Ubah Password</button>
                    <button class="btn btn-info w-100 mb-2">Two Factor Authentication</button>
                    <button class="btn btn-outline-danger w-100">Logout Semua Perangkat</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection