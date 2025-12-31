@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-bell-fill text-warning"></i> Notifikasi
            </h1>
            <p class="text-muted mb-0">Kelola dan kirim notifikasi ke pengguna sistem</p>
        </div>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#sendNotificationModal">
            <i class="bi bi-send"></i> Kirim Notifikasi
        </button>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> Ada kesalahan:
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filter & Info -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p class="mb-0">
                        <strong>{{ $unreadCount }}</strong> notifikasi yang belum dibaca
                        @if($unreadCount > 0)
                    <form action="{{ route('superadmin.notifikasi.read-all') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-check-all"></i> Tandai Semua Terbaca
                        </button>
                    </form>
                    @endif
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="btn-group" role="group">
                        <a href="{{ route('superadmin.notifikasi') }}" class="btn btn-sm btn-outline-secondary {{ !request('filter') ? 'active' : '' }}">
                            Semua
                        </a>
                        <a href="{{ route('superadmin.notifikasi', ['filter' => 'unread']) }}" class="btn btn-sm btn-outline-secondary {{ request('filter') === 'unread' ? 'active' : '' }}">
                            Belum Dibaca
                        </a>
                        <a href="{{ route('superadmin.notifikasi', ['filter' => 'read']) }}" class="btn btn-sm btn-outline-secondary {{ request('filter') === 'read' ? 'active' : '' }}">
                            Dibaca
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="card border-0 shadow-sm">
        @forelse($notifications as $notification)
        <div class="card-body border-bottom notification-item {{ !$notification->read_at ? 'bg-light' : '' }}" style="cursor: pointer;">
            <div class="row align-items-start">
                <div class="col-auto">
                    <div class="notification-icon">
                        @if($notification->type === 'success')
                        <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
                        @elseif($notification->type === 'warning')
                        <i class="bi bi-exclamation-triangle text-warning" style="font-size: 1.5rem;"></i>
                        @elseif($notification->type === 'danger')
                        <i class="bi bi-x-circle text-danger" style="font-size: 1.5rem;"></i>
                        @elseif($notification->type === 'system')
                        <i class="bi bi-gear text-secondary" style="font-size: 1.5rem;"></i>
                        @else
                        <i class="bi bi-{{ $notification->icon ?? 'info-circle' }} text-primary" style="font-size: 1.5rem;"></i>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <h6 class="mb-1 fw-bold">{{ $notification->title }}</h6>
                    <p class="mb-2 text-muted">{{ $notification->content }}</p>
                    <small class="text-muted">
                        <i class="bi bi-calendar"></i> {{ $notification->created_at->diffForHumans() }}
                        @if(!$notification->read_at)
                        <span class="badge bg-primary ms-2">Baru</span>
                        @endif
                    </small>
                </div>
                <div class="col-auto">
                    <div class="btn-group btn-group-sm">
                        @if(!$notification->read_at)
                        <form action="{{ route('superadmin.notifikasi.read', $notification) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-success" title="Tandai Terbaca">
                                <i class="bi bi-check"></i>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('superadmin.notifikasi.destroy', $notification) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus notifikasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox" style="font-size: 3rem;" class="text-muted"></i>
            <p class="text-muted mt-3 mb-0">Tidak ada notifikasi</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $notifications->links() }}
    </div>
    @endif
</div>

<!-- Send Notification Modal -->
<div class="modal fade" id="sendNotificationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kirim Notifikasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('superadmin.notifikasi.send') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Recipient Selection -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Penerima <span class="text-danger">*</span></label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="recipient_type" id="recipientAll" value="all" checked>
                            <label class="btn btn-outline-primary" for="recipientAll">
                                Semua Pengguna
                            </label>

                            <input type="radio" class="btn-check" name="recipient_type" id="recipientRole" value="role">
                            <label class="btn btn-outline-primary" for="recipientRole">
                                Berdasarkan Role
                            </label>

                            <input type="radio" class="btn-check" name="recipient_type" id="recipientUser" value="user">
                            <label class="btn btn-outline-primary" for="recipientUser">
                                Pengguna Spesifik
                            </label>
                        </div>
                    </div>

                    <!-- Role Selection (hidden by default) -->
                    <div class="mb-3" id="roleSelection" style="display: none;">
                        <label class="form-label">Pilih Role</label>
                        <select name="role" class="form-select">
                            <option value="">-- Pilih Role --</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="leader">Leader</option>
                            <option value="user">User</option>
                            <option value="tester">Tester</option>
                        </select>
                    </div>

                    <!-- User Selection (hidden by default) -->
                    <div class="mb-3" id="userSelection" style="display: none;">
                        <label class="form-label">Pilih Pengguna</label>
                        <select name="user_ids[]" class="form-select" multiple>
                            <option disabled>-- Pilih satu atau lebih pengguna --</option>
                            @foreach(\App\Models\User::where('id', '!=', auth()->id())->orderBy('name')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Gunakan Ctrl+Click untuk memilih multiple</small>
                    </div>

                    <!-- Notification Type -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipe Notifikasi <span class="text-danger">*</span></label>
                        <select name="type" class="form-select" required>
                            <option value="notification">Notifikasi</option>
                            <option value="info">Info</option>
                            <option value="success">Sukses</option>
                            <option value="warning">Peringatan</option>
                            <option value="danger">Bahaya</option>
                            <option value="system">Sistem</option>
                        </select>
                    </div>

                    <!-- Notification Title -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Judul notifikasi" maxlength="255" required>
                    </div>

                    <!-- Notification Content -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Konten <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control" rows="4" placeholder="Isi notifikasi" maxlength="1000" required></textarea>
                        <small class="text-muted">Maksimal 1000 karakter</small>
                    </div>

                    <!-- Icon -->
                    <div class="mb-3">
                        <label class="form-label">Icon (Bootstrap Icon name)</label>
                        <input type="text" name="icon" class="form-control" placeholder="Contoh: bell, check-circle, alert-triangle" value="info-circle">
                        <small class="text-muted">Lihat <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                    </div>

                    <!-- Action URL -->
                    <div class="mb-3">
                        <label class="form-label">URL Aksi (Optional)</label>
                        <input type="text" name="action_url" class="form-control" placeholder="/superadmin/dashboard">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-send"></i> Kirim Notifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="recipient_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('roleSelection').style.display = this.value === 'role' ? 'block' : 'none';
            document.getElementById('userSelection').style.display = this.value === 'user' ? 'block' : 'none';
        });
    });
</script>
@endsection