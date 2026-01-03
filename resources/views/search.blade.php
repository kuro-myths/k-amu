@extends('layouts.app')

@section('title', 'Pencarian Data')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Pencarian Data</h1>
            <p class="text-gray-600">Cari data pribadi Anda dengan mudah - Catatan, Proyek, Pesan, dan lainnya</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Search Widget Sidebar -->
            <div class="lg:col-span-1">
                <!-- Main Search Widget -->
                <div class="bg-white rounded-lg shadow-lg p-4 sticky top-4">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-3">🔍 Pencarian Cepat</h3>
                        <div class="relative">
                            <input
                                type="text"
                                id="searchInput"
                                placeholder="Cari data Anda..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button
                                type="button"
                                id="addSearchBtn"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-2xl hover:scale-110 transition"
                                title="Tambah pencarian baru">
                                ➕
                            </button>
                        </div>
                    </div>

                    <!-- Filter Type -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-2">Filter Tipe</label>
                        <select id="filterType" class="w-full p-2 border border-gray-300 rounded-lg text-sm">
                            <option value="all">Semua Tipe</option>
                            <option value="notes">📝 Catatan</option>
                            <option value="projects">📊 Proyek</option>
                            <option value="messages">💬 Pesan</option>
                        </select>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-2 mb-4 border-t pt-4">
                        <button
                            type="button"
                            id="historyToggleBtn"
                            class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded-lg transition text-sm font-medium">
                            📋 Riwayat Pencarian
                        </button>
                        <button
                            type="button"
                            id="bookmarksToggleBtn"
                            class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded-lg transition text-sm font-medium">
                            🔖 Penanda
                        </button>
                        <button
                            type="button"
                            id="tagsToggleBtn"
                            class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded-lg transition text-sm font-medium">
                            🏷️ Tag Saya
                        </button>
                    </div>

                    <!-- Clear History -->
                    <button
                        type="button"
                        id="clearHistoryBtn"
                        class="w-full px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition text-sm font-medium border border-red-300">
                        🗑️ Hapus Riwayat
                    </button>
                </div>

                <!-- Tags Widget -->
                <div id="tagsWidget" class="bg-white rounded-lg shadow-lg p-4 mt-4 hidden">
                    <h4 class="font-semibold mb-3">Tag Anda</h4>
                    <div id="tagsList" class="flex flex-wrap gap-2">
                        <!-- Tags akan dimuat dinamis -->
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Search Results -->
                <div id="searchResults" class="hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold">Hasil Pencarian</h2>
                            <span id="resultCount" class="text-gray-600 text-lg"></span>
                        </div>

                        <!-- Results by Type -->
                        <div id="resultsContainer" class="space-y-6">
                            <!-- Results akan ditampilkan di sini -->
                        </div>
                    </div>
                </div>

                <!-- History View -->
                <div id="historyView" class="hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-4">📋 Riwayat Pencarian Terbaru</h2>
                        <div id="historyList" class="space-y-2">
                            <!-- History akan ditampilkan di sini -->
                        </div>
                    </div>
                </div>

                <!-- Bookmarks View -->
                <div id="bookmarksView" class="hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-4">🔖 Pencarian Bertanda</h2>
                        <div id="bookmarksList" class="space-y-2">
                            <!-- Bookmarks akan ditampilkan di sini -->
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="bg-white rounded-lg shadow-lg p-12 text-center">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-2xl font-semibold mb-2">Mulai Pencarian</h3>
                    <p class="text-gray-600 mb-4">Gunakan kotak pencarian di atas untuk mencari catatan, proyek, atau pesan Anda</p>
                    <p class="text-sm text-gray-500">💡 Tip: Pencarian ini hanya mencari data pribadi Anda, bukan internet</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Add Tag -->
<div id="tagModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-semibold mb-4">Tambah Tag</h3>
        <input
            type="text"
            id="tagInput"
            placeholder="Masukkan nama tag..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4">
        <div class="flex gap-2">
            <button
                type="button"
                id="addTagBtn"
                class="flex-1 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                Tambah
            </button>
            <button
                type="button"
                id="closeTagModalBtn"
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                Batal
            </button>
        </div>
    </div>
</div>

<script>
    let currentView = 'empty'; // empty, results, history, bookmarks
    let allTags = new Set();

    document.addEventListener('DOMContentLoaded', () => {
        setupEventListeners();
        loadHistory();
    });

    function setupEventListeners() {
        // Search functionality
        document.getElementById('searchInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Add search button (+ icon)
        document.getElementById('addSearchBtn').addEventListener('click', performSearch);

        // View toggles
        document.getElementById('historyToggleBtn').addEventListener('click', showHistory);
        document.getElementById('bookmarksToggleBtn').addEventListener('click', showBookmarks);
        document.getElementById('tagsToggleBtn').addEventListener('click', toggleTagsWidget);

        // Clear history
        document.getElementById('clearHistoryBtn').addEventListener('click', clearHistory);

        // Tag modal
        document.getElementById('closeTagModalBtn').addEventListener('click', closeTagModal);
        document.getElementById('addTagBtn').addEventListener('click', addNewTag);
        document.getElementById('tagInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') addNewTag();
        });
    }

    async function performSearch() {
        const query = document.getElementById('searchInput').value.trim();
        const type = document.getElementById('filterType').value;

        if (!query) {
            alert('Masukkan kata kunci pencarian');
            return;
        }

        try {
            const response = await fetch('/api/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    query: query,
                    type: type !== 'all' ? type : undefined,
                }),
            });

            const data = await response.json();
            displayResults(data);
            currentView = 'results';
        } catch (error) {
            console.error('Error searching:', error);
            alert('Terjadi kesalahan saat mencari');
        }
    }

    function displayResults(data) {
        const resultsDiv = document.getElementById('searchResults');
        const container = document.getElementById('resultsContainer');
        const resultCount = document.getElementById('resultCount');

        resultCount.textContent = `${data.total_results} hasil ditemukan`;

        container.innerHTML = '';

        // Group results by type
        const types = [{
                key: 'notes',
                label: '📝 Catatan',
                icon: '📝'
            },
            {
                key: 'projects',
                label: '📊 Proyek',
                icon: '📊'
            },
            {
                key: 'messages',
                label: '💬 Pesan',
                icon: '💬'
            },
        ];

        types.forEach(({
            key,
            label,
            icon
        }) => {
            const results = data.results[key] || [];
            if (results.length > 0) {
                const section = document.createElement('div');
                section.className = 'border-b pb-4 last:border-b-0';
                section.innerHTML = `<h3 class="text-lg font-semibold mb-2">${label}</h3>`;

                results.forEach(result => {
                    const resultDiv = document.createElement('div');
                    resultDiv.className = 'p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition cursor-pointer mb-2';
                    resultDiv.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <a href="${result.url}" class="font-semibold hover:underline text-blue-600">${result.title}</a>
                                <p class="text-sm text-gray-600">${result.content}</p>
                                <small class="text-gray-500">${new Date(result.created_at).toLocaleDateString('id-ID')}</small>
                            </div>
                            <div class="flex gap-1 ml-2">
                                <button class="bookmark-btn text-lg hover:scale-110 transition" data-id="${result.id}" data-type="${result.type}">
                                    🔖
                                </button>
                                <button class="tag-btn text-lg hover:scale-110 transition" data-id="${result.id}" data-type="${result.type}">
                                    🏷️
                                </button>
                            </div>
                        </div>
                    `;

                    // Add event listeners
                    resultDiv.querySelector('.bookmark-btn').addEventListener('click', (e) => {
                        e.stopPropagation();
                        toggleBookmark(result.id);
                    });

                    resultDiv.querySelector('.tag-btn').addEventListener('click', (e) => {
                        e.stopPropagation();
                        openTagModal(result.id);
                    });

                    section.appendChild(resultDiv);
                });

                container.appendChild(section);
            }
        });

        // Hide other views
        document.getElementById('historyView').classList.add('hidden');
        document.getElementById('bookmarksView').classList.add('hidden');
        document.getElementById('emptyState').classList.add('hidden');
        resultsDiv.classList.remove('hidden');
    }

    async function loadHistory() {
        try {
            const response = await fetch('/api/search/history?limit=10');
            const data = await response.json();

            // Collect all tags
            data.data.forEach(item => {
                if (item.tags) {
                    item.tags.forEach(tag => allTags.add(tag));
                }
            });
        } catch (error) {
            console.error('Error loading history:', error);
        }
    }

    async function showHistory() {
        try {
            const response = await fetch('/api/search/history?limit=20');
            const data = await response.json();

            const historyDiv = document.getElementById('historyView');
            const historyList = document.getElementById('historyList');

            historyList.innerHTML = '';

            if (data.data.length === 0) {
                historyList.innerHTML = '<p class="text-gray-600 text-center py-8">Belum ada riwayat pencarian</p>';
            } else {
                data.data.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition';
                    itemDiv.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-semibold">"${item.query}"</p>
                                <p class="text-sm text-gray-600">${item.result_count} hasil • ${new Date(item.created_at).toLocaleDateString('id-ID')}</p>
                                ${item.tags.length > 0 ? `<div class="flex flex-wrap gap-1 mt-2">${item.tags.map(tag => `<span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">${tag}</span>`).join('')}</div>` : ''}
                            </div>
                            <button class="reuse-search-btn text-lg hover:scale-110 transition" data-query="${item.query}">
                                🔄
                            </button>
                        </div>
                    `;

                    itemDiv.querySelector('.reuse-search-btn').addEventListener('click', (e) => {
                        document.getElementById('searchInput').value = e.target.dataset.query;
                        performSearch();
                    });

                    historyList.appendChild(itemDiv);
                });
            }

            document.getElementById('searchResults').classList.add('hidden');
            document.getElementById('bookmarksView').classList.add('hidden');
            document.getElementById('emptyState').classList.add('hidden');
            historyDiv.classList.remove('hidden');
            currentView = 'history';
        } catch (error) {
            console.error('Error loading history:', error);
        }
    }

    async function showBookmarks() {
        try {
            const response = await fetch('/api/search/bookmarks');
            const data = await response.json();

            const bookmarksDiv = document.getElementById('bookmarksView');
            const bookmarksList = document.getElementById('bookmarksList');

            bookmarksList.innerHTML = '';

            if (data.data.length === 0) {
                bookmarksList.innerHTML = '<p class="text-gray-600 text-center py-8">Belum ada pencarian yang ditandai</p>';
            } else {
                data.data.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition';
                    itemDiv.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-semibold">"${item.query}"</p>
                                <p class="text-sm text-gray-600">${item.result_count} hasil</p>
                                ${item.tags.length > 0 ? `<div class="flex flex-wrap gap-1 mt-2">${item.tags.map(tag => `<span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">${tag}</span>`).join('')}</div>` : ''}
                            </div>
                            <button class="remove-bookmark-btn text-lg hover:scale-110 transition" data-id="${item.id}">
                                ❌
                            </button>
                        </div>
                    `;

                    itemDiv.querySelector('.remove-bookmark-btn').addEventListener('click', async (e) => {
                        await toggleBookmark(e.target.dataset.id);
                        showBookmarks(); // Reload
                    });

                    bookmarksList.appendChild(itemDiv);
                });
            }

            document.getElementById('searchResults').classList.add('hidden');
            document.getElementById('historyView').classList.add('hidden');
            document.getElementById('emptyState').classList.add('hidden');
            bookmarksDiv.classList.remove('hidden');
            currentView = 'bookmarks';
        } catch (error) {
            console.error('Error loading bookmarks:', error);
        }
    }

    function toggleTagsWidget() {
        const widget = document.getElementById('tagsWidget');
        const tagsList = document.getElementById('tagsList');

        widget.classList.toggle('hidden');

        if (!widget.classList.contains('hidden')) {
            tagsList.innerHTML = '';
            allTags.forEach(tag => {
                const tagSpan = document.createElement('span');
                tagSpan.className = 'bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm cursor-pointer hover:bg-blue-200 transition';
                tagSpan.textContent = tag;
                tagSpan.addEventListener('click', async () => {
                    try {
                        const response = await fetch(`/api/search/tag/${encodeURIComponent(tag)}`);
                        const data = await response.json();
                        // Tampilkan hasil berdasarkan tag
                        console.log('Results for tag:', data);
                    } catch (error) {
                        console.error('Error searching by tag:', error);
                    }
                });
                tagsList.appendChild(tagSpan);
            });
        }
    }

    async function toggleBookmark(searchHistoryId) {
        try {
            await fetch(`/api/search/${searchHistoryId}/bookmark`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            // Reload history untuk update status bookmark
            if (currentView === 'bookmarks') {
                showBookmarks();
            }
        } catch (error) {
            console.error('Error toggling bookmark:', error);
        }
    }

    function openTagModal(searchHistoryId) {
        const modal = document.getElementById('tagModal');
        const input = document.getElementById('tagInput');

        input.value = '';
        input.dataset.searchId = searchHistoryId;
        modal.classList.remove('hidden');
    }

    function closeTagModal() {
        document.getElementById('tagModal').classList.add('hidden');
    }

    async function addNewTag() {
        const input = document.getElementById('tagInput');
        const tag = input.value.trim();
        const searchId = input.dataset.searchId;

        if (!tag) {
            alert('Masukkan nama tag');
            return;
        }

        try {
            await fetch(`/api/search/${searchId}/tag`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    tag: tag
                }),
            });

            allTags.add(tag);
            closeTagModal();
            alert('Tag berhasil ditambahkan!');
        } catch (error) {
            console.error('Error adding tag:', error);
        }
    }

    async function clearHistory() {
        if (!confirm('Apakah Anda yakin ingin menghapus semua riwayat pencarian?')) {
            return;
        }

        try {
            await fetch('/api/search/history', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            alert('Riwayat pencarian berhasil dihapus');
            loadHistory();
            showHistory();
        } catch (error) {
            console.error('Error clearing history:', error);
        }
    }
</script>

<style>
    @media (max-width: 1024px) {
        .sticky {
            position: relative;
            top: 0 !important;
        }
    }
</style>
@endsection