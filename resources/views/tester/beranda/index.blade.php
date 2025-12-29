@extends('layouts.app')

@section('title', 'Dashboard Tester - K-AMU')
@section('page-title', 'Dashboard Tester')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Testing</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_tests'] }}</p>
            </div>
            <i class="fas fa-vial text-4xl text-blue-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Testing Berhasil</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['passed_tests'] }}</p>
            </div>
            <i class="fas fa-check-circle text-4xl text-green-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Testing Gagal</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['failed_tests'] }}</p>
            </div>
            <i class="fas fa-times-circle text-4xl text-red-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Level / Poin</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['level'] }} / {{ $stats['points'] }}</p>
            </div>
            <i class="fas fa-star text-4xl text-yellow-500 opacity-20"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6 col-span-2">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Testing Terbaru</h3>
        <div class="space-y-3">
            @forelse($testResults as $result)
            <div class="flex items-center justify-between p-3 border rounded">
                <div>
                    <p class="font-semibold text-gray-800">{{ $result->feature_name }}</p>
                    <p class="text-sm text-gray-600">{{ $result->test_description }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($result->status === 'passed') bg-green-100 text-green-800
                        @elseif($result->status === 'failed') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                    {{ $result->status }}
                </span>
            </div>
            @empty
            <p class="text-gray-600">Belum ada hasil testing</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Akses Cepat</h3>
        <div class="space-y-2">
            <a href="{{ route('tester.tools') }}" class="block p-3 bg-blue-50 rounded hover:bg-blue-100 transition">
                <i class="fas fa-tools text-blue-600 mr-2"></i>
                <span class="font-semibold text-gray-800">Tools & Bug</span>
            </a>
            <a href="{{ route('tester.monitoring') }}" class="block p-3 bg-green-50 rounded hover:bg-green-100 transition">
                <i class="fas fa-eye text-green-600 mr-2"></i>
                <span class="font-semibold text-gray-800">Monitoring</span>
            </a>
            <a href="{{ route('tester.laporan') }}" class="block p-3 bg-purple-50 rounded hover:bg-purple-100 transition">
                <i class="fas fa-chart-bar text-purple-600 mr-2"></i>
                <span class="font-semibold text-gray-800">Laporan</span>
            </a>
            <a href="{{ route('tester.statistik') }}" class="block p-3 bg-yellow-50 rounded hover:bg-yellow-100 transition">
                <i class="fas fa-percent text-yellow-600 mr-2"></i>
                <span class="font-semibold text-gray-800">Statistik</span>
            </a>
        </div>
    </div>
</div>
@endsection