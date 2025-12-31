@extends('layouts.app')

@section('content')
<div class="navbar-custom">
    <a href="/">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
    <span style="font-weight: 700; color: var(--primary-yellow);">{{ $pet->name }} - Pet Assistant</span>
    <div style="color: var(--primary-gray); font-size: 0.9rem;">
        Level {{ $pet->level }} • EXP {{ $pet->experience }}/100
    </div>
</div>

<div class="container-main">
    <div class="card-pet">
        <!-- Header -->
        <div class="pet-header">
            <div class="pet-image-container">
                <img src="{{ asset('vtuber-mascot.png') }}" alt="{{ $pet->name }}" class="pet-image">
            </div>
            <div class="pet-name">{{ $pet->name }}</div>
            <div class="pet-level">Level {{ $pet->level }}</div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- LEFT: STATS -->
            <div class="stats-section">
                <!-- Health Bar -->
                <div class="stat-bar">
                    <div class="stat-label">
                        <span><i class="bi bi-heart-fill"></i> Kesehatan</span>
                        <span>{{ $pet->health }}/100</span>
                    </div>
                    <div class="stat-fill" @style="{'width': $pet->health + '%'}"></div>
                </div>

                <!-- Happiness Bar -->
                <div class="stat-bar">
                    <div class="stat-label">
                        <span><i class="bi bi-emoji-smile-fill"></i> Kebahagiaan</span>
                        <span>{{ $pet->happiness }}/100</span>
                    </div>
                    <div class="stat-fill" @style="{'width': $pet->happiness + '%'}"></div>
                </div>

                <!-- Energy Bar -->
                <div class="stat-bar">
                    <div class="stat-label">
                        <span><i class="bi bi-lightning-fill"></i> Energi</span>
                        <span>{{ $pet->energy }}/100</span>
                    </div>
                    <div class="stat-fill" @style="{'width': $pet->energy + '%'}"></div>
                </div>

                <!-- Bio -->
                <div class="pet-bio">
                    <h5><i class="bi bi-book"></i> Tentang {{ $pet->name }}</h5>
                    <p>{{ $pet->biography ?? 'Pet Anda yang setia. Jangan lupa untuk merawat dan bermain dengannya!' }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn-action btn-play" onclick="playWithPet()">
                        <i class="bi bi-hand-thumbs-up"></i> Ajak Bermain
                    </button>
                    <button class="btn-action btn-rest" onclick="restPet()">
                        <i class="bi bi-moon"></i> Istirahat
                    </button>
                </div>
            </div>

            <!-- RIGHT: CHAT -->
            <div class="chat-section">
                <div>
                    <div class="chat-title">
                        <i class="bi bi-chat-dots-fill"></i> Chat dengan {{ $pet->name }}
                    </div>

                    <!-- Quick Buttons -->
                    <div class="quick-buttons">
                        <button class="btn-quick" onclick="quickChat('Siapa kamu?')">Siapa kamu?</button>
                        <button class="btn-quick" onclick="quickChat('Apa keahlianmu?')">Keahlian?</button>
                        <button class="btn-quick" onclick="quickChat('Motivasi aku!')">Motivasi</button>
                        <button class="btn-quick" onclick="quickChat('Tips belajar?')">Tips Belajar</button>
                    </div>

                    <!-- Chat Input -->
                    <div class="chat-input-group" style="margin-top: 15px;">
                        <input type="text" id="chatInput" class="chat-input" placeholder="Tanya sesuatu...">
                        <button class="btn-send" onclick="sendChat()"><i class="bi bi-send-fill"></i></button>
                    </div>

                    <!-- Chat Response -->
                    <div class="chat-response empty" id="chatResponse">
                        <span>Halo! Saya siap membantu 👋</span>
                    </div>
                </div>

                <!-- Abilities -->
                <div class="abilities-section">
                    <div class="abilities-title">🎯 Kemampuan Spesial</div>
                    <div class="ability-tags">
                        @if($pet->abilities)
                        @foreach($pet->abilities as $ability)
                        <span class="ability-tag">✨ {{ $ability }}</span>
                        @endforeach
                        @else
                        <span class="ability-tag">✨ Loyal</span>
                        <span class="ability-tag">📚 Smart</span>
                        <span class="ability-tag">💜 Friendly</span>
                        <span class="ability-tag">🎌 Helpful</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/pet.css') }}">
<script src="{{ asset('js/pet.js') }}"></script>
@endsection