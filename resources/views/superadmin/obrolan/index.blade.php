@extends('layouts.app')

@section('title', 'Obrolan - SuperAdmin')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark">
                <i class="bi bi-chat-dots-fill text-warning"></i> Obrolan Pribadi
            </h1>
            <p class="text-muted mb-0">Berkomunikasi dengan pengguna lain secara privat</p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i> Ada kesalahan:
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row" style="height: 70vh;">
        <!-- Users List Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                <div class="card-header border-0 bg-light">
                    <h6 class="mb-3 fw-bold">
                        <i class="bi bi-people-fill"></i> Daftar Pengguna
                    </h6>
                    <input type="text" class="form-control form-control-sm" id="searchUser" placeholder="Cari pengguna...">
                </div>
                <div class="list-group list-group-flush flex-grow-1" id="usersList" style="overflow-y: auto;">
                    @forelse($users as $user)
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action py-3 border-0 user-item"
                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}"
                        onclick="selectUser(this)">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-5">{{ $user->name }}</h6>
                                <small class="text-muted d-block">{{ $user->email }}</small>
                                @if($user->role)
                                <span class="badge bg-info mt-1">{{ ucfirst($user->role) }}</span>
                                @endif
                            </div>
                            <span class="badge bg-success rounded-circle" style="width: 10px; height: 10px;" title="Online"></span>
                        </div>
                    </a>
                    @empty
                    <div class="p-3 text-center text-muted">
                        <small><i class="bi bi-inbox"></i> Tidak ada pengguna tersedia</small>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                <!-- Chat Header -->
                <div class="card-header border-bottom bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div id="chatHeaderTitle">
                            <h6 class="mb-0 text-muted">
                                <i class="bi bi-chat-dots"></i> Pilih pengguna untuk memulai chat
                            </h6>
                        </div>
                    </div>
                </div>

                <!-- Messages Container -->
                <div class="card-body p-3 flex-grow-1" id="messagesContainer" style="overflow-y: auto; background-color: #f8f9fa; display: none;">
                    <!-- Messages will be loaded here -->
                </div>

                <!-- Empty State -->
                <div class="card-body d-flex align-items-center justify-content-center flex-grow-1" id="emptyState">
                    <div class="text-center text-muted">
                        <i class="bi bi-chat-left" style="font-size: 4rem; opacity: 0.3;"></i>
                        <p class="mt-3 mb-0"><strong>Belum ada percakapan</strong></p>
                        <p class="text-muted small">Pilih pengguna dari daftar untuk memulai obrolan</p>
                    </div>
                </div>

                <!-- Message Input Form -->
                <div class="card-footer border-top p-3" id="messageInputForm" style="display: none;">
                    <form method="POST" id="sendMessageForm" onsubmit="return sendMessage(event)">
                        @csrf
                        <input type="hidden" name="recipient_id" id="recipientId">
                        <div class="input-group">
                            <input type="text" class="form-control" name="content" id="messageInput" placeholder="Ketik pesan..." required>
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

<script>
    function selectUser(element) {
        const userId = element.dataset.userId;
        const userName = element.dataset.userName;
        const userEmail = element.dataset.userEmail;

        // Mark as active
        document.querySelectorAll('.user-item').forEach(item => {
            item.classList.remove('active');
        });
        element.classList.add('active');

        // Update form
        document.getElementById('recipientId').value = userId;
        document.getElementById('sendMessageForm').action = `{{ route('superadmin.obrolan') }}/${userId}/send`;

        // Show input form
        document.getElementById('messageInputForm').style.display = 'block';
        document.getElementById('emptyState').style.display = 'none';
        document.getElementById('messagesContainer').style.display = 'flex';
        document.getElementById('messagesContainer').style.flexDirection = 'column';

        // Update header
        document.getElementById('chatHeaderTitle').innerHTML = `
            <div>
                <h6 class="mb-0">
                    <i class="bi bi-chat-dots-fill"></i> 
                    <strong>${userName}</strong>
                    <small class="text-muted">${userEmail}</small>
                </h6>
            </div>
        `;

        // Load messages
        loadMessages(userId);

        // Focus input
        document.getElementById('messageInput').focus();
    }

    function loadMessages(userId) {
        const container = document.getElementById('messagesContainer');
        container.innerHTML = `<div class="text-center text-muted py-5">
            <p><i class="bi bi-chat-left-dots"></i> Mulai percakapan dengan pengguna ini</p>
        </div>`;
    }

    function sendMessage(e) {
        e.preventDefault();

        const form = document.getElementById('sendMessageForm');
        const content = document.getElementById('messageInput');

        if (!content.value.trim()) return false;

        // Add message to UI optimistically
        const messagesContainer = document.getElementById('messagesContainer');
        const messageBubble = document.createElement('div');
        messageBubble.className = 'message-bubble message-sent';
        messageBubble.innerHTML = `
            <div>${content.value}</div>
            <div class="message-time">Sekarang</div>
        `;
        messagesContainer.appendChild(messageBubble);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Send via AJAX
        fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'recipient_id=' + document.getElementById('recipientId').value +
                    '&content=' + encodeURIComponent(content.value)
            })
            .then(response => {
                if (response.ok) {
                    content.value = '';
                    content.focus();
                } else {
                    messageBubble.remove();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageBubble.remove();
            });

        return false;
    }

    // Search users
    document.getElementById('searchUser').addEventListener('keyup', function() {
        const search = this.value.toLowerCase();
        document.querySelectorAll('.user-item').forEach(item => {
            const name = item.dataset.userName.toLowerCase();
            const email = item.dataset.userEmail.toLowerCase();
            item.style.display = (name.includes(search) || email.includes(search)) ? '' : 'none';
        });
    });
</script>

<style>
    .user-item {
        transition: all 0.3s ease;
    }

    .user-item:hover {
        background-color: #f8f9fa;
    }

    .user-item.active {
        background-color: #e7f3ff;
        border-left: 3px solid #0d6efd;
    }

    .message-bubble {
        max-width: 70%;
        word-wrap: break-word;
        padding: 10px 14px;
        border-radius: 10px;
        margin-bottom: 8px;
    }

    .message-sent {
        background-color: #0d6efd;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 2px;
    }

    .message-received {
        background-color: #e9ecef;
        color: #333;
        align-self: flex-start;
        border-bottom-left-radius: 2px;
    }

    .message-time {
        font-size: 0.75rem;
        opacity: 0.6;
    }
</style>

@endsection