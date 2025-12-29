@extends('layouts.app')

@section('title', 'Obrolan Global')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">
                <i class="bi bi-chat-dots-fill"></i> Obrolan Global
            </h2>
            <p class="text-muted mt-1">Komunikasi dengan semua pengguna sistem</p>
        </div>
    </div>

    <!-- Chat Container -->
    <div class="row">
        <!-- Sidebar Users -->
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-0 bg-light p-3">
                    <h6 class="mb-3">
                        <i class="bi bi-person-circle"></i> Pengguna Online
                    </h6>
                    <input type="text" class="form-control form-control-sm" placeholder="Cari pengguna..." id="searchUser">
                </div>
                <div class="list-group list-group-flush" id="userList" style="max-height: 500px; overflow-y: auto;">
                    @forelse($users ?? [] as $user)
                    <a href="#" class="list-group-item list-group-item-action py-2" data-user-id="{{ $user->id }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="d-block fw-semibold">{{ $user->name }}</small>
                                <small class="text-muted">{{ ucfirst($user->role) }}</small>
                            </div>
                            <span class="badge bg-success rounded-pill" style="width: 8px; height: 8px; padding: 0;"></span>
                        </div>
                    </a>
                    @empty
                    <div class="p-3 text-center text-muted">
                        <small>Tidak ada pengguna online</small>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="col-md-9 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <!-- Chat Header -->
                <div class="card-header border-bottom bg-light p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0" id="chatTitle">
                            <i class="bi bi-chat-fill"></i> Obrolan Global
                        </h6>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-info-circle"></i>
                        </button>
                    </div>
                </div>

                <!-- Messages Area -->
                <div class="card-body p-3" id="messagesArea" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                    @forelse($messages ?? [] as $message)
                    <div class="mb-3">
                        <div class="d-flex gap-2">
                            <div class="flex-shrink-0">
                                <div class="avatar bg-primary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <small>{{ substr($message->user->name, 0, 1) }}</small>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <small class="d-block fw-semibold">{{ $message->user->name }}</small>
                                <div class="bg-white p-2 rounded" style="max-width: 80%;">
                                    <p class="mb-0">{{ $message->content }}</p>
                                </div>
                                <small class="text-muted d-block mt-1">{{ $message->created_at->format('H:i') }}</small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-chat-left-dots" style="font-size: 2rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">Mulai percakapan baru</p>
                    </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="card-footer border-top p-3">
                    <form id="messageForm" method="POST" action="{{ route('superadmin.obrolan.send') }}">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" id="messageInput" name="content" placeholder="Ketik pesan..." required>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-send"></i> Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #messagesArea::-webkit-scrollbar {
        width: 8px;
    }

    #messagesArea::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    #messagesArea::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    #messagesArea::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<script>
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const content = document.getElementById('messageInput').value;
        if (content.trim()) {
            // Implement message sending via AJAX
            console.log('Sending message:', content);
            document.getElementById('messageInput').value = '';
        }
    });

    // Search user functionality
    document.getElementById('searchUser').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('#userList a').forEach(userItem => {
            const userName = userItem.textContent.toLowerCase();
            userItem.style.display = userName.includes(searchTerm) ? 'block' : 'none';
        });
    });
</script>
@endsection