@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Kelola Pengguna</h2>
            <p class="text-muted">Manage semua pengguna sistem</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Pengguna ({{ $users->total() }})</h5>
            </div>
        </div>
        <div class="card-body">
            @if($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tipe</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-info">{{ ucfirst($user->role) }}</span></td>
                            <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}</span></td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $users->links() }}
            </div>
            @else
            <div class="alert alert-info">
                <p class="mb-0">Tidak ada pengguna tipe user</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection