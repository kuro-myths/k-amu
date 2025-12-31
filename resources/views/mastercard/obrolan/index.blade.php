@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="page-title">Obrolan</h2>
            <p class="text-muted">Chat dengan pengguna</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Kontak</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <div class="d-flex justify-content-between">
                                <strong>Budi Santoso</strong>
                                <small>14:30</small>
                            </div>
                            <small class="text-muted">Halo...</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Chat</h5>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: auto;">
                    <div class="mb-3">
                        <small class="text-muted">14:30 - Budi Santoso</small>
                        <p>Halo, ada pertanyaan tentang sistem</p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Ketik pesan...">
                        <button class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection