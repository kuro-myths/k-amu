@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-people-fill text-warning"></i> Manajemen Pengguna
            </h1>
            <p class="text-muted mb-0">Kelola akun dan data semua pengguna sistem</p>
        </div>
        <a href="{{ route('superadmin.pengguna.create') }}" class="btn btn-warning">
            <i class="bi bi-plus-circle"></i> Tambah Pengguna
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filter & Search -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('superadmin.pengguna') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>
                        <option value="superadmin" {{ request('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="mastercard" {{ request('role') === 'mastercard' ? 'selected' : '' }}>Mastercard</option>
                        <option value="leader" {{ request('role') === 'leader' ? 'selected' : '' }}>Leader</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                        <option value="tester" {{ request('role') === 'tester' ? 'selected' : '' }}>Tester</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('superadmin.pengguna') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-bold">No</th>
                        <th class="fw-bold">Nama</th>
                        <th class="fw-bold">Email</th>
                        <th class="fw-bold">Role</th>
                        <th class="fw-bold">Tipe</th>
                        <th class="fw-bold">Poin</th>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong><br>
                            <small class="text-muted">Lv. {{ $user->level }}</small>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'superadmin')
                            <span class="badge bg-danger"><i class="bi bi-shield-lock"></i> Admin</span>
                            @elseif($user->role === 'mastercard')
                            <span class="badge bg-primary"><i class="bi bi-crown"></i> Mastercard</span>
                            @elseif($user->role === 'leader')
                            <span class="badge bg-info"><i class="bi bi-person-check"></i> Leader</span>
                            @elseif($user->role === 'tester')
                            <span class="badge bg-warning"><i class="bi bi-bug"></i> Tester</span>
                            @else
                            <span class="badge bg-secondary">User</span>
                            @endif
                        </td>
                        <td>
                            <small class="badge bg-light text-dark">{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}</small>
                        </td>
                        <td>
                            <span class="badge bg-success">{{ $user->points }}</span>
                        </td>
                        <td>
                            @if($user->deleted_at === null)
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('superadmin.pengguna.edit', $user->id) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header border-danger">
                                            <h5 class="modal-title text-danger"><i class="bi bi-exclamation-triangle"></i> Hapus Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus <strong>{{ $user->name }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form method="POST" action="{{ route('superadmin.pengguna.destroy', $user->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Tidak ada pengguna</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    @endif

</div>
@endsection
<tr>
    <td colspan="5" class="px-6 py-4 text-center text-gray-600">Tidak ada pengguna</td>
</tr>
@endforelse
</tbody>
</table>
</div>

<div class="p-4">
    {{ $users->links() }}
</div>
</div>
@endsection