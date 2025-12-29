@extends('layouts.app')

@section('title', 'Dashboard Siswa - K-AMU')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-sticky-note mr-2"></i>Catatan Terakhir
        </h3>
        <div class="space-y-3">
            @forelse($notes as $note)
            <div class="p-3 border rounded hover:bg-gray-50">
                <p class="font-semibold text-gray-800">{{ $note->title }}</p>
                <p class="text-sm text-gray-600 truncate">{{ $note->content }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $note->created_at->diffForHumans() }}</p>
            </div>
            @empty
            <p class="text-gray-600">Belum ada catatan. <a href="{{ route('user.catatan.create') }}" class="text-blue-600">Buat sekarang</a></p>
            @endforelse
        </div>
        <a href="{{ route('user.catatan') }}" class="block mt-4 text-center text-blue-600 hover:text-blue-900 text-sm font-semibold">
            Lihat Semua Catatan →
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-bell mr-2"></i>Notifikasi
        </h3>
        <div class="space-y-3">
            @forelse($notifications as $notif)
            <div class="p-3 border rounded hover:bg-gray-50">
                <p class="font-semibold text-gray-800">{{ $notif->title }}</p>
                <p class="text-sm text-gray-600">{{ $notif->content }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
            </div>
            @empty
            <p class="text-gray-600">Belum ada notifikasi baru</p>
            @endforelse
        </div>
    </div>
</div>

<div class="mt-6 bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Menu Cepat</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('user.catatan') }}" class="p-4 bg-blue-50 rounded hover:bg-blue-100 transition text-center">
            <i class="fas fa-sticky-note text-blue-600 text-2xl block mb-2"></i>
            <span class="text-sm font-semibold text-gray-800">Catatan</span>
        </a>
        <a href="#" class="p-4 bg-green-50 rounded hover:bg-green-100 transition text-center">
            <i class="fas fa-comments text-green-600 text-2xl block mb-2"></i>
            <span class="text-sm font-semibold text-gray-800">Obrolan</span>
        </a>
        <a href="#" class="p-4 bg-purple-50 rounded hover:bg-purple-100 transition text-center">
            <i class="fas fa-user text-purple-600 text-2xl block mb-2"></i>
            <span class="text-sm font-semibold text-gray-800">Profil</span>
        </a>
        <a href="#" class="p-4 bg-yellow-50 rounded hover:bg-yellow-100 transition text-center">
            <i class="fas fa-cog text-yellow-600 text-2xl block mb-2"></i>
            <span class="text-sm font-semibold text-gray-800">Pengaturan</span>
        </a>
    </div>
</div>
@endsection