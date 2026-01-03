@extends('layouts.app')

@section('title', $pet->name . ' - Pet Assistant')

@section('content')
<div class="mascot-page">
    <!-- Header -->
    <header class="page-header">
        <div class="header-wrapper">
            <a href="/" class="back-link">← Kembali</a>
            <div class="header-info">
                <h1>{{ $pet->name }}</h1>
                <p>{{ ucfirst($pet->role_type ?? 'User') }} Pet Assistant</p>
            </div>
            <div class="header-level">Lvl {{ $pet->level ?? 1 }}</div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="page-content">
        <!-- Left Panel -->
        <aside class="left-panel">
            <!-- Pet Card -->
            <div class="pet-card">
                <div class="pet-image">
                    <img src="{{ asset('vtuber-mascot.png') }}" alt="{{ $pet->name }}">
                    <span class="pet-type">{{ ucfirst($pet->pet_type) }}</span>
                    <span class="pet-role">{{ ucfirst($pet->role_type ?? 'User') }}</span>
                </div>
                <h2>{{ $pet->name }}</h2>
                <p>{{ $pet->biography ?? 'Pet Anda yang setia dan selalu siap membantu.' }}</p>
            </div>

            <!-- Experience -->
            <div class="card">
                <h3>Pengalaman</h3>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo ($pet->experience ?? 0); ?>%"></div>
                </div>
                <p class="progress-text">{{ $pet->experience ?? 0 }}/100</p>
            </div>

            <!-- Stats -->
            <div class="card">
                <h3>Kondisi Pet</h3>
                <div class="stat-item">
                    <span>Kesehatan</span>
                    <div class="stat-bar red">
                        <div class="stat-fill" style="width: <?php echo ($pet->health ?? 100); ?>%"></div>
                    </div>
                </div>
                <div class="stat-item">
                    <span>Kebahagiaan</span>
                    <div class="stat-bar pink">
                        <div class="stat-fill" style="width: <?php echo ($pet->happiness ?? 100); ?>%"></div>
                    </div>
                </div>
                <div class="stat-item">
                    <span>Energi</span>
                    <div class="stat-bar yellow">
                        <div class="stat-fill" style="width: <?php echo ($pet->energy ?? 100); ?>%"></div>
                    </div>
                </div>
            </div>

            <!-- Attributes -->
            @if($pet->stats && count($pet->stats) > 0)
            <div class="card">
                <h3>Atribut Spesial</h3>
                <div class="attributes">
                    @foreach($pet->stats as $name => $value)
                    <div class="attr">
                        <span class="attr-name">{{ ucfirst(str_replace('_', ' ', $name)) }}</span>
                        <span class="attr-value">{{ $value }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="actions">
                <button class="btn btn-primary" onclick="playWithPet()">Ajak Bermain</button>
                <button class="btn btn-secondary" onclick="restPet()">Istirahat</button>
            </div>

            <!-- Last Interaction -->
            @if($pet->last_interaction)
            <div class="card info-card">
                <strong>Interaksi Terakhir:</strong>
                <p>{{ $pet->last_interaction->diffForHumans() }}</p>
            </div>
            @endif

            <!-- Abilities -->
            @if($pet->abilities && count($pet->abilities) > 0)
            <div class="card">
                <h3>Kemampuan</h3>
                <div class="abilities">
                    @foreach($pet->abilities as $ability)
                    <span class="ability">{{ $ability }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </aside>

        <!-- Right Panel: Chat -->
        <main class="right-panel">
            <div class="chat-box">
                <div class="chat-header">
                    <h2>Chat dengan {{ $pet->name }}</h2>
                    <p>Tanya apa saja!</p>
                </div>

                <!-- Quick Buttons -->
                <div class="quick-buttons">
                    <button onclick="quickChat('Siapa kamu?')">Siapa?</button>
                    <button onclick="quickChat('Apa keahlianmu?')">Keahlian</button>
                    <button onclick="quickChat('Motivasi aku!')">Motivasi</button>
                    <button onclick="quickChat('Tips belajar?')">Tips</button>
                </div>

                <!-- Messages -->
                <div class="messages" id="chatMessages">
                    <div class="message bot">
                        <p>Halo! 👋 Nama saya {{ $pet->name }}. Ada yang bisa saya bantu?</p>
                    </div>
                </div>

                <!-- Input -->
                <div class="chat-input">
                    <input type="text" id="chatInput" placeholder="Ketik pertanyaan..." onkeypress="if(event.key==='Enter') sendChat()">
                    <button onclick="sendChat()">Kirim</button>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    .mascot-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .page-header {
        background: white;
        border-bottom: 4px solid #ffc107;
        padding: 20px 0;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .header-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .back-link {
        color: #333;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.3s;
    }

    .back-link:hover {
        background: #f0f0f0;
        color: #ffc107;
    }

    .header-info {
        flex: 1;
        text-align: center;
    }

    .header-info h1 {
        font-size: 2rem;
        font-weight: 900;
        margin: 0;
        color: #333;
    }

    .header-info p {
        font-size: 0.9rem;
        color: #666;
        margin: 4px 0 0 0;
    }

    .header-level {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: #333;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }

    .page-content {
        max-width: 1400px;
        margin: 30px auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        padding: 0 30px 30px;
    }

    @media (max-width: 1024px) {
        .page-content {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 0 20px 20px;
        }
    }

    .left-panel {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .right-panel {
        display: flex;
    }

    .pet-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 25px;
        text-align: center;
        transition: all 0.3s;
    }

    .pet-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .pet-image {
        position: relative;
        margin-bottom: 20px;
    }

    .pet-image img {
        width: 180px;
        height: 180px;
        border-radius: 12px;
        border: 4px solid #ffc107;
        margin: 0 auto;
        display: block;
        transition: all 0.3s;
        object-fit: cover;
    }

    .pet-image img:hover {
        transform: scale(1.05);
    }

    .pet-type,
    .pet-role {
        position: absolute;
        top: 12px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .pet-type {
        right: 12px;
        background: #ffc107;
        color: #333;
    }

    .pet-role {
        left: 12px;
        background: #333;
        color: white;
    }

    .pet-card h2 {
        font-size: 2.2rem;
        font-weight: 900;
        margin: 0 0 10px 0;
        color: #333;
    }

    .pet-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }

    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 20px;
        transition: all 0.3s;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        margin: 0 0 15px 0;
    }

    .progress-bar {
        height: 26px;
        background: #f0f0f0;
        border-radius: 13px;
        overflow: hidden;
        margin-bottom: 10px;
        border: 2px solid #e0e0e0;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #ffc107 0%, #ffb300 100%);
        transition: width 0.4s ease;
    }

    .progress-text {
        text-align: center;
        font-size: 0.85rem;
        color: #666;
        margin: 0;
    }

    .stat-item {
        margin-bottom: 12px;
    }

    .stat-item span {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
        display: block;
        margin-bottom: 6px;
    }

    .stat-bar {
        height: 16px;
        background: #f0f0f0;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e0e0e0;
    }

    .stat-bar.red .stat-fill {
        background: linear-gradient(90deg, #ff6b6b 0%, #ee5a6f 100%);
    }

    .stat-bar.pink .stat-fill {
        background: linear-gradient(90deg, #ff6b9d 0%, #fa80bb 100%);
    }

    .stat-bar.yellow .stat-fill {
        background: linear-gradient(90deg, #ffc107 0%, #ffb300 100%);
    }

    .stat-fill {
        height: 100%;
        transition: width 0.3s ease;
    }

    .attributes {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .attr {
        background: #f5f5f5;
        padding: 12px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .attr-name {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
    }

    .attr-value {
        background: #ffc107;
        color: #333;
        padding: 2px 8px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.8rem;
    }

    .actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .btn {
        padding: 12px 16px;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: #333;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 193, 7, 0.4);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #333 0%, #222 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
    }

    .info-card {
        background: linear-gradient(135deg, #e8f4f8 0%, #d4e8f0 100%);
        border-left: 4px solid #00a8cc;
    }

    .info-card strong {
        color: #333;
        display: block;
        margin-bottom: 8px;
    }

    .info-card p {
        color: #666;
        font-size: 0.85rem;
        margin: 0;
    }

    .abilities {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .ability {
        background: #333;
        color: #ffc107;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .ability:hover {
        background: #ffc107;
        color: #333;
        transform: translateY(-2px);
    }

    .chat-box {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 25px;
        display: flex;
        flex-direction: column;
        max-height: calc(100vh - 180px);
        width: 100%;
        transition: all 0.3s;
    }

    .chat-box:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .chat-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
    }

    .chat-header h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin: 0 0 6px 0;
    }

    .chat-header p {
        font-size: 0.85rem;
        color: #666;
        margin: 0;
    }

    .quick-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-bottom: 18px;
    }

    .quick-buttons button {
        background: #f5f5f5;
        border: 2px solid #e0e0e0;
        color: #333;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s;
    }

    .quick-buttons button:hover {
        background: #ffc107;
        border-color: #ffc107;
        transform: translateY(-2px);
    }

    .messages {
        flex: 1;
        overflow-y: auto;
        margin-bottom: 18px;
        padding: 12px 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .messages::-webkit-scrollbar {
        width: 6px;
    }

    .messages::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }

    .message {
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 0.9rem;
        line-height: 1.5;
        max-width: 80%;
        word-wrap: break-word;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message.bot {
        background: #f5f5f5;
        color: #333;
        margin-right: auto;
    }

    .message.user {
        background: #ffc107;
        color: #333;
        margin-left: auto;
    }

    .message p {
        margin: 0;
    }

    .chat-input {
        border-top: 2px solid #e0e0e0;
        padding-top: 15px;
        display: flex;
        gap: 10px;
    }

    .chat-input input {
        flex: 1;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: inherit;
        transition: all 0.3s;
    }

    .chat-input input:focus {
        outline: none;
        border-color: #ffc107;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.1);
    }

    .chat-input button {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: #333;
        border: none;
        padding: 12px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        transition: all 0.3s;
    }

    .chat-input button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    @media (max-width: 768px) {
        .header-wrapper {
            flex-direction: column;
            text-align: center;
            gap: 12px;
            padding: 0 15px;
        }

        .header-info h1 {
            font-size: 1.5rem;
        }

        .page-content {
            padding: 0 15px 15px;
        }

        .pet-card h2 {
            font-size: 1.8rem;
        }

        .attributes {
            grid-template-columns: 1fr;
        }
    }
</style>

<script src="{{ asset('js/pet.js') }}"></script>
@endsection