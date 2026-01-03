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
                            <div class="avatar-container position-relative mb-3" style="display: inline-block;">
                                <img id="avatarPreview" src="{{ auth()->user()->avatar_url }}" alt="Avatar"
                                    class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                                <div class="avatar-overlay position-absolute bottom-0 end-0" style="display: none;">
                                    <button type="button" class="btn btn-sm btn-danger" id="deleteAvatarBtn" title="Hapus Avatar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Upload Form -->
                            <form id="avatarForm" enctype="multipart/form-data" class="mb-3">
                                @csrf
                                <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                                <button type="button" class="btn btn-primary btn-sm" id="uploadAvatarBtn">
                                    <i class="bi bi-cloud-upload"></i> Ganti Foto
                                </button>
                            </form>

                            <!-- Drag & Drop Zone -->
                            <div id="dropZone" class="border-2 border-dashed rounded p-2 mb-3" style="border-color: #dee2e6; cursor: pointer;">
                                <small class="text-muted">
                                    <i class="bi bi-image"></i><br>
                                    Seret foto ke sini
                                </small>
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

<style>
    .border-2 {
        border-width: 2px !important;
    }

    .avatar-container:hover .avatar-overlay {
        display: block !important;
    }

    #dropZone.drag-over {
        background-color: #e7f3ff;
        border-color: #0d6efd !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadAvatarBtn = document.getElementById('uploadAvatarBtn');
        const avatarInput = document.getElementById('avatarInput');
        const dropZone = document.getElementById('dropZone');
        const deleteAvatarBtn = document.getElementById('deleteAvatarBtn');
        const avatarPreview = document.getElementById('avatarPreview');

        if (!uploadAvatarBtn) return;

        // Click to upload
        uploadAvatarBtn.addEventListener('click', () => {
            avatarInput.click();
        });

        dropZone.addEventListener('click', () => {
            avatarInput.click();
        });

        // File input change
        avatarInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                uploadAvatar(e.target.files[0]);
            }
        });

        // Drag & Drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    avatarInput.files = files;
                    uploadAvatar(file);
                } else {
                    alert('Harap upload file gambar saja');
                }
            }
        });

        // Upload Avatar Function
        function uploadAvatar(file) {
            const formData = new FormData();
            formData.append('avatar', file);
            formData.append('_token', document.querySelector('[name="_token"]').value);

            uploadAvatarBtn.disabled = true;
            uploadAvatarBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';

            fetch('{{ route("superadmin.profile.upload-avatar") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update preview
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            avatarPreview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);

                        showAlert('success', data.message);
                        avatarInput.value = '';
                    } else {
                        showAlert('danger', data.message);
                    }
                })
                .catch(error => {
                    showAlert('danger', 'Error: ' + error.message);
                })
                .finally(() => {
                    uploadAvatarBtn.disabled = false;
                    uploadAvatarBtn.innerHTML = '<i class="bi bi-cloud-upload"></i> Ganti Foto';
                });
        }

        // Delete Avatar
        if (deleteAvatarBtn) {
            deleteAvatarBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus avatar?')) {
                    fetch('{{ route("superadmin.profile.delete-avatar") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                avatarPreview.src = data.avatar_url;
                                showAlert('success', data.message);
                            } else {
                                showAlert('danger', data.message);
                            }
                        })
                        .catch(error => {
                            showAlert('danger', 'Error: ' + error.message);
                        });
                }
            });
        }

        // Show Alert
        function showAlert(type, message) {
            const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
            const container = document.querySelector('.container-fluid');
            const alertDiv = document.createElement('div');
            alertDiv.innerHTML = alertHtml;
            container.insertBefore(alertDiv.firstElementChild, container.firstChild);
        }
    });
</script>
@endsection