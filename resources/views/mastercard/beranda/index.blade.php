@extends('layouts.app')

@section('title', 'Dashboard Mastercard - K-AMU')
@section('page-title', 'Dashboard Mastercard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
            </div>
            <i class="fas fa-users text-4xl text-blue-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Pengguna Aktif (7 hari)</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['active_users'] }}</p>
            </div>
            <i class="fas fa-user-check text-4xl text-green-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Akun Dibuat Hari Ini</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_accounts_created'] }}</p>
            </div>
            <i class="fas fa-user-plus text-4xl text-purple-500 opacity-20"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Fitur Cepat</h3>
        <div class="space-y-3">
            <a href="{{ route('mastercard.pengguna') }}" class="block p-4 bg-blue-50 rounded hover:bg-blue-100 transition">
                <i class="fas fa-users text-blue-600 mr-3"></i>
                <span class="font-semibold text-gray-800">Lihat Daftar Pengguna</span>
            </a>
            <a href="{{ route('mastercard.akun') }}" class="block p-4 bg-green-50 rounded hover:bg-green-100 transition">
                <i class="fas fa-user-plus text-green-600 mr-3"></i>
                <span class="font-semibold text-gray-800">Buat Akun Baru</span>
            </a>
            <a href="{{ route('mastercard.catatan-aktivitas') }}" class="block p-4 bg-yellow-50 rounded hover:bg-yellow-100 transition">
                <i class="fas fa-history text-yellow-600 mr-3"></i>
                <span class="font-semibold text-gray-800">Lihat Aktivitas</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi</h3>
        <div class="text-sm text-gray-600 space-y-2">
            <p><span class="font-semibold">Role:</span> Mastercard</p>
            <p><span class="font-semibold">Hak Akses:</span> Kelola pengguna & akun</p>
            <p><span class="font-semibold">Tanggal:</span> {{ now()->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection