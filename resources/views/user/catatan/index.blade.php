@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Catatan Saya</h2>
            <p class="text-muted">Kelola catatan dan dokumen pribadi</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Catatan</h5>
                <a href="#" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Catatan Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($notes->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                        <tr>
                            <td><strong>{{ $note->title }}</strong></td>
                            <td>
                                @if($note->category)
                                <span class="badge bg-secondary">{{ $note->category }}</span>
                                @else
                                <span class="badge bg-light text-dark">Umum</span>
                                @endif
                            </td>
                            <td><small class="text-muted">{{ $note->created_at->format('d M Y') }}</small></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $notes->links() }}
            </div>
            @else
            <div class="alert alert-info">
                Belum ada catatan. <a href="#">Buat catatan baru</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection