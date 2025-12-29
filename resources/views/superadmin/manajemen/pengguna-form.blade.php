@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="h3 fw-bold text-dark">
                    <i class="bi bi-person-plus-fill text-warning"></i>
                    {{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
                </h1>
                <p class="text-muted mb-0">{{ isset($user) ? 'Ubah data pengguna' : 'Daftarkan pengguna baru ke sistem' }}</p>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ isset($user) ? route('superadmin.pengguna.update', $user->id) : route('superadmin.pengguna.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($user))
                        @method('PUT')
                        @endif

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name ?? '') }}" placeholder="Masukkan nama lengkap" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email ?? '') }}" placeholder="nama@contoh.com" {{ isset($user) ? 'readonly' : 'required' }}>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        @if(!isset($user))
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Minimal 6 karakter" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password" required>
                        </div>
                        @endif

                        <hr class="my-4">

                        <!-- Role -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="">Pilih Role</option>
                                    <option value="superadmin" {{ old('role', $user->role ?? '') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="mastercard" {{ old('role', $user->role ?? '') === 'mastercard' ? 'selected' : '' }}>Mastercard</option>
                                    <option value="leader" {{ old('role', $user->role ?? '') === 'leader' ? 'selected' : '' }}>Leader</option>
                                    <option value="tester" {{ old('role', $user->role ?? '') === 'tester' ? 'selected' : '' }}>Tester</option>
                                    <option value="user" {{ old('role', $user->role ?? '') === 'user' ? 'selected' : '' }}>User Biasa</option>
                                </select>
                                @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- User Type -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tipe User <span class="text-danger">*</span></label>
                                <select name="user_type" class="form-select @error('user_type') is-invalid @enderror" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="superadmin" {{ old('user_type', $user->user_type ?? '') === 'superadmin' ? 'selected' : '' }}>Admin</option>
                                    <option value="mastercard" {{ old('user_type', $user->user_type ?? '') === 'mastercard' ? 'selected' : '' }}>Mastercard</option>
                                    <option value="leader" {{ old('user_type', $user->user_type ?? '') === 'leader' ? 'selected' : '' }}>Leader</option>
                                    <option value="siswa" {{ old('user_type', $user->user_type ?? '') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                                    <option value="orang_tua" {{ old('user_type', $user->user_type ?? '') === 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="alumni" {{ old('user_type', $user->user_type ?? '') === 'alumni' ? 'selected' : '' }}>Alumni</option>
                                    <option value="tester" {{ old('user_type', $user->user_type ?? '') === 'tester' ? 'selected' : '' }}>Tester</option>
                                </select>
                                @error('user_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Level & Points -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Level <span class="text-danger">*</span></label>
                                <input type="number" name="level" class="form-control @error('level') is-invalid @enderror"
                                    value="{{ old('level', $user->level ?? 1) }}" min="1" max="10" required>
                                @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Poin</label>
                                <input type="number" name="points" class="form-control @error('points') is-invalid @enderror"
                                    value="{{ old('points', $user->points ?? 0) }}" min="0">
                                @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bio & Phone -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Biografi</label>
                            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror"
                                rows="3" placeholder="Deskripsi singkat tentang pengguna">{{ old('bio', $user->bio ?? '') }}</textarea>
                            @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $user->phone ?? '') }}" placeholder="08123456789">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Alamat</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address', $user->address ?? '') }}" placeholder="Jalan, Kota">
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-lg"></i> {{ isset($user) ? 'Perbarui' : 'Simpan' }}
                            </button>
                            <a href="{{ route('superadmin.pengguna') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-lg"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection