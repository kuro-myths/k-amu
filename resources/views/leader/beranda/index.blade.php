@extends('layouts.app')

@section('title', 'Dashboard Leader - K-AMU')
@section('page-title', 'Dashboard Leader')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Proyek</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_projects'] }}</p>
            </div>
            <i class="fas fa-briefcase text-4xl text-blue-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Proyek Aktif</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['active_projects'] }}</p>
            </div>
            <i class="fas fa-hourglass-start text-4xl text-green-500 opacity-20"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Anggota Tim</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['team_members'] }}</p>
            </div>
            <i class="fas fa-users text-4xl text-purple-500 opacity-20"></i>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6 pb-4 border-b">
        <h3 class="text-lg font-semibold text-gray-800">Proyek Terbaru</h3>
        <a href="{{ route('leader.proyek.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Buat Proyek
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($projects as $project)
        <div class="p-4 border rounded hover:shadow-lg transition">
            <div class="flex justify-between items-start mb-2">
                <h4 class="font-semibold text-gray-800">{{ $project->name }}</h4>
                <span class="px-2 py-1 text-xs font-semibold rounded-full
                        @if($project->status === 'in_progress') bg-green-100 text-green-800
                        @elseif($project->status === 'completed') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                    {{ $project->status }}
                </span>
            </div>
            <p class="text-sm text-gray-600 mb-3">{{ $project->description }}</p>
            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                <div class="bg-blue-600 h-2 rounded-full" @style(["width: " . ($project->progress ?? 0) . " %"])></div>
            </div>
            <p class="text-xs text-gray-500 mb-3">{{ $project->progress ?? 0 }}% Selesai</p>
            <div class="flex space-x-2">
                <a href="{{ route('leader.proyek.edit', $project) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                    <i class="fas fa-edit"></i>Edit
                </a>
            </div>
        </div>
        @empty
        <p class="text-gray-600 col-span-2">Belum ada proyek. <a href="{{ route('leader.proyek.create') }}" class="text-blue-600">Buat sekarang</a></p>
        @endforelse
    </div>
</div>
@endsection