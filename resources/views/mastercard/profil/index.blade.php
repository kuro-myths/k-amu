@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Profil Saya</h2>
            <p class="text-muted">Kelola informasi profil admin</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar-container position-relative mb-3" style="display: inline-block;">
                        <img id="avatarPreview" src="{{ auth()->user()->avatar_url }}" alt="Avatar"
                            class="rounded-circle" width="150" height="150" style="object-fit: cover;">
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
                    <div id="dropZone" class="border-2 border-dashed rounded p-3 mb-3" style="border-color: #dee2e6; cursor: pointer;">
                        <small class="text-muted">
                            <i class="bi bi-image"></i><br>
                            Seret foto ke sini atau klik
                        </small>
                    </div>

                    <h5 class="card-title">{{ auth()->user()->name }}</h5>
                    <p class="text-muted">{{ auth()->user()->email }}</p>
                    <p class="badge bg-primary">Mastercard Admin</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <form id="profileForm">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Telepon</label>
                                <input type="tel" class="form-control" name="phone" value="{{ auth()->user()->phone ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" value="Mastercard" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" rows="3">{{ auth()->user()->bio ?? '' }}</textarea>
                                <small class="text-muted">Maksimal 500 karakter</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
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
        const profileForm = document.getElementById('profileForm');
        const deleteAvatarBtn = document.getElementById('deleteAvatarBtn');
        const avatarPreview = document.getElementById('avatarPreview');

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

            fetch('{{ route("mastercard.profile.upload-avatar") }}', {
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
                    fetch('{{ route("mastercard.profile.delete-avatar") }}', {
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

        // Update Profile Form
        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(profileForm);
            const submitBtn = profileForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

            fetch('{{ route("mastercard.profile.update") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', data.message);
                    } else {
                        showAlert('danger', data.message);
                    }
                })
                .catch(error => {
                    showAlert('danger', 'Error: ' + error.message);
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Simpan Perubahan';
                });
        });

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