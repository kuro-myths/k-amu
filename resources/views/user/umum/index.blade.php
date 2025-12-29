@extends('layouts.app')

@section('title', 'Dashboard - K-AMU')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="header-info">
            <h1 class="header-title">Dashboard</h1>
            <p class="header-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->format('l, d F Y H:i') }}
            </p>
        </div>
        <div class="header-icon">
            <i class="bi bi-house"></i>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="card">
        <div class="card-body">
            <h2>Selamat Datang di K-AMU</h2>
            <p>Sistem manajemen pembelajaran terintegrasi untuk mendukung aktivitas belajar mengajar yang lebih efektif.</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="stats-grid">
        <div class="stat-card stat-blue">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Catatan Saya</p>
                    <h2 class="stat-value">{{ $notes ?? 0 }}</h2>
                </div>
                <i class="bi bi-sticky stat-icon"></i>
            </div>
        </div>

        <div class="stat-card stat-cyan">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Laporan</p>
                    <h2 class="stat-value">{{ $reports ?? 0 }}</h2>
                </div>
                <i class="bi bi-file-earmark stat-icon"></i>
            </div>
        </div>

        <div class="stat-card stat-green">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Pesan</p>
                    <h2 class="stat-value">{{ $messages ?? 0 }}</h2>
                </div>
                <i class="bi bi-chat-left stat-icon"></i>
            </div>
        </div>
    </div>
</div>
@endsection