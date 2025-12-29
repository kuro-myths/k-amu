@extends('layouts.app')

@section('title', isset($note) ? 'Edit Catatan' : 'Buat Catatan')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Header Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        {{ isset($note) ? 'Edit Catatan' : 'Buat Catatan Baru' }}
                    </h2>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ isset($note) ? route('superadmin.catatan.update', $note->id) : route('superadmin.catatan.store') }}">
                        @csrf
                        @if(isset($note))
                        @method('PUT')
                        @endif

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">
                                <i class="bi bi-card-text"></i> Judul Catatan
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                value="{{ $note->title ?? old('title') }}" required>
                            @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">
                                <i class="bi bi-file-text"></i> Isi Catatan
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                                rows="8" required>{{ $note->content ?? old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">Maksimal 5000 karakter</small>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">
                                <i class="bi bi-tag"></i> Kategori
                            </label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="pribadi" {{ ($note->category ?? old('category')) == 'pribadi' ? 'selected' : '' }}>Pribadi</option>
                                <option value="pekerjaan" {{ ($note->category ?? old('category')) == 'pekerjaan' ? 'selected' : '' }}>Pekerjaan</option>
                                <option value="ide" {{ ($note->category ?? old('category')) == 'ide' ? 'selected' : '' }}>Ide</option>
                                <option value="ingatkan" {{ ($note->category ?? old('category')) == 'ingatkan' ? 'selected' : '' }}>Ingatkan</option>
                                <option value="lainnya" {{ ($note->category ?? old('category')) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div class="mb-3">
                            <label for="color" class="form-label fw-semibold">
                                <i class="bi bi-palette"></i> Warna
                            </label>
                            <div class="d-flex gap-2">
                                @php
                                $colors = ['yellow' => 'bg-warning', 'blue' => 'bg-primary', 'green' => 'bg-success', 'pink' => 'bg-danger', 'purple' => 'bg-info'];
                                @endphp
                                @foreach($colors as $colorValue => $colorClass)
                                <label class="cursor-pointer">
                                    <input type="radio" name="color" value="{{ $colorValue }}" class="form-check-input color-radio"
                                        {{ ($note->color ?? old('color')) == $colorValue ? 'checked' : '' }}>
                                    <span class="{{ $colorClass }} d-inline-block color-swatch"></span>
                                </label>
                                @endforeach
                            </div>
                            @error('color')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pin -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_pinned" name="is_pinned" value="1"
                                    {{ ($note->is_pinned ?? old('is_pinned')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_pinned">
                                    <i class="bi bi-pin-fill"></i> Pin catatan ini agar selalu di atas
                                </label>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="d-flex gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> {{ isset($note) ? 'Perbarui' : 'Simpan' }}
                            </button>
                            <a href="{{ route('superadmin.catatan') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cursor-pointer {
        cursor: pointer;
    }

    .color-swatch {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        border: 2px solid transparent;
        transition: all 0.2s ease;
    }

    .color-radio:checked+.color-swatch {
        border-color: #333;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection