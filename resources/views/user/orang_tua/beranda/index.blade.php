@extends('layouts.app')

@section('title', 'Dashboard Orang Tua - K-AMU')
@section('page-title', 'Dashboard Orang Tua')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="header-info">
            <h1 class="header-title">Dashboard Orang Tua</h1>
            <p class="header-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->format('l, d F Y H:i') }}
            </p>
        </div>
        <div class="header-icon">
            <i class="bi bi-people"></i>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <!-- Catatan Anak -->
        <div class="stat-card stat-blue">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Catatan Anak</p>
                    <h2 class="stat-value">{{ $childNotes ?? 0 }}</h2>
                </div>
                <i class="bi bi-sticky stat-icon"></i>
            </div>
        </div>

        <!-- Laporan Nilai -->
        <div class="stat-card stat-cyan">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Laporan Nilai</p>
                    <h2 class="stat-value">{{ $reports ?? 0 }}</h2>
                </div>
                <i class="bi bi-graph-up stat-icon"></i>
            </div>
        </div>

        <!-- Pesan -->
        <div class="stat-card stat-green">
            <div class="stat-header">
                <div>
                    <p class="stat-label">Pesan Baru</p>
                    <h2 class="stat-value">{{ $messages ?? 0 }}</h2>
                </div>
                <i class="bi bi-chat-left stat-icon"></i>
            </div>
        </div>
    </div>
</div>
@endsection