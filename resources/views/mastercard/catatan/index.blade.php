@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="page-title">Catatan</h2>
            </div>
            <p class="text-muted">Kelola catatan dan memo</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($notes->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                        <tr>
                            <td>
                                <strong>{{ $note->title }}</strong>
                                <br />
                                <small class="text-muted">{{ Str::limit($note->content, 50) }}</small>
                            </td>
                            <td>{{ $note->user->name }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($note->category ?? 'General') }}</span></td>
                            <td><small class="text-muted">{{ $note->created_at->format('d M Y H:i') }}</small></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">Lihat</a>
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                {{ $notes->links() }}
            </nav>
            @else
            <div class="alert alert-info text-center">
                <p class="mb-0">Belum ada catatan</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection