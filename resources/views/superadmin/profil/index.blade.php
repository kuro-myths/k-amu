@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-person-circle"></i> Profil Saya
            </h2>
            <p class="text-muted mt-1">Kelola informasi profil pribadi Anda</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Profile Tabs -->
    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button">
                <i class="bi bi-person"></i> Informasi Pribadi
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button">
                <i class="bi bi-shield-lock"></i> Keamanan
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button">
                <i class="bi bi-clock-history"></i> Aktivitas
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Personal Information -->
        <div class="tab-pane fade show active" id="personal" role="tabpanel">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <!-- Profile Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="avatar bg-primary text-white mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </div>
                            <h5 class="card-title">{{ auth()->user()->name }}</h5>
                            <p class="text-muted mb-3">{{ ucfirst(auth()->user()->role) }}</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <span class="badge bg-primary">{{ ucfirst(auth()->user()->user_type) }}</span>
                                <span class="badge bg-success">Level {{ auth()->user()->level }}</span>
                                <span class="badge bg-info">{{ auth()->user()->points }} pts</span>
                            </div>
                            <hr>
                            <p class="small text-muted mb-0">
                                <i class="bi bi-calendar3"></i>
                                Bergabung: {{ auth()->user()->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mb-4">
                    <!-- Edit Profile Form -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Edit Informasi Pribadi</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('superadmin.profil.update') }}">
                                @csrf
                                @method('PUT')

                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="bi bi-person"></i> Nama Lengkap
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                        value="{{ auth()->user()->name }}" required>
                                    @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email (Read Only) -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="bi bi-envelope"></i> Email
                                    </label>
                                    <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
                                    <small class="text-muted">Email tidak dapat diubah</small>
                                </div>

                                <!-- Bio -->
                                <div class="mb-3">
                                    <label for="bio" class="form-label fw-semibold">
                                        <i class="bi bi-file-text"></i> Bio
                                    </label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3"
                                        maxlength="500">{{ auth()->user()->bio }}</textarea>
                                    @error('bio')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Maksimal 500 karakter</small>
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">
                                        <i class="bi bi-telephone"></i> Nomor Telepon
                                    </label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                        value="{{ auth()->user()->phone }}">
                                    @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label fw-semibold">
                                        <i class="bi bi-geo-alt"></i> Alamat
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ auth()->user()->address }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- CV -->
                                <div class="mb-3">
                                    <label for="cv" class="form-label fw-semibold">
                                        <i class="bi bi-file-earmark-pdf"></i> CV / Portofolio
                                    </label>
                                    <input type="url" class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv"
                                        placeholder="https://..." value="{{ auth()->user()->cv }}">
                                    @error('cv')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Berikan link CV atau portofolio Anda</small>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div class="tab-pane fade" id="security" role="tabpanel">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <!-- Change Password -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Ubah Password</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('superadmin.profil.changePassword') }}">
                                @csrf

                                <!-- Current Password -->
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label fw-semibold">
                                        <i class="bi bi-lock"></i> Password Saat Ini
                                    </label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword"
                                        name="current_password" required>
                                    @error('current_password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill"></i> Password Baru
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword"
                                        name="password" required>
                                    @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Minimal 8 karakter</small>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill"></i> Konfirmasi Password
                                    </label>
                                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-shield-lock"></i> Ubah Password
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Login Sessions -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Sesi Login Aktif</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Kelola sesi login Anda di berbagai perangkat</p>
                            <div class="list-group">
                                <div class="list-group-item py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-semibold d-block">Windows - Chrome</small>
                                            <small class="text-muted">IP: 127.0.0.1 | {{ now()->format('d M Y H:i') }}</small>
                                        </div>
                                        <span class="badge bg-success">Saat Ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity -->
        <div class="tab-pane fade" id="activity" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header border-0 bg-light p-3">
                            <h6 class="mb-0">Riwayat Aktivitas Terbaru</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal & Waktu</th>
                                        <th>Aktivitas</th>
                                        <th>Deskripsi</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(auth()->user()->activityLogs()->latest()->limit(20)->get() ?? [] as $activity)
                                    <tr>
                                        <td>
                                            <small class="text-muted">{{ $activity->created_at->format('d M H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $activity->action ?? 'Unknown' }}</span>
                                        </td>
                                        <td>
                                            <small>{{ $activity->description ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <code class="text-muted" style="font-size: 0.75rem;">{{ $activity->ip_address ?? '-' }}</code>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Belum ada aktivitas
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection