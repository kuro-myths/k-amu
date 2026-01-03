<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border: none; border-radius: 15px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
            <!-- Header -->
            <div class="modal-header border-0 pb-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 15px 15px 0 0;">
                <h5 class="modal-title text-white fw-bold d-flex align-items-center">
                    <i class="bi bi-search me-2" style="font-size: 1.5rem;"></i>
                    Pencarian Data
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4" style="max-height: 70vh;">
                <!-- Search Input -->
                <div class="mb-4">
                    <div class="input-group input-group-lg" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                        <span class="input-group-text border-0" style="background: white; padding: 0.75rem 1rem;">
                            <i class="bi bi-search" style="color: #f093fb; font-size: 1.2rem;"></i>
                        </span>
                        <input
                            type="text"
                            id="searchInputModal"
                            class="form-control border-0"
                            placeholder="Cari catatan, proyek, pesan..."
                            autocomplete="off"
                            style="font-size: 1rem; padding: 0.75rem;">
                        <button class="btn btn-light border-0" type="button" id="searchBtnModal" style="color: #f093fb; padding: 0.75rem 1rem;">
                            <i class="bi bi-arrow-return-left"></i>
                        </button>
                    </div>
                </div>

                <!-- Filter -->
                <div class="row g-2 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold mb-2">Filter Tipe</label>
                        <select id="filterTypeModal" class="form-select form-select-sm" style="border-radius: 8px;">
                            <option value="">Semua Tipe</option>
                            <option value="notes">Catatan</option>
                            <option value="projects">Proyek</option>
                            <option value="messages">Pesan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold mb-2">Urutkan</label>
                        <select id="sortByModal" class="form-select form-select-sm" style="border-radius: 8px;">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="popular">Paling Populer</option>
                        </select>
                    </div>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4" role="tablist" style="border-bottom: 2px solid #e5e7eb;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="resultsTabModal" data-bs-toggle="tab" data-bs-target="#resultsContentModal" type="button" role="tab" aria-selected="true">
                            <i class="bi bi-search me-2"></i>Hasil Pencarian
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="historyTabModal" data-bs-toggle="tab" data-bs-target="#historyContentModal" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-clock-history me-2"></i>Riwayat
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bookmarksTabModal" data-bs-toggle="tab" data-bs-target="#bookmarksContentModal" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-bookmark me-2"></i>Bookmark
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tagsTabModal" data-bs-toggle="tab" data-bs-target="#tagsContentModal" type="button" role="tab" aria-selected="false">
                            <i class="bi bi-tags me-2"></i>Tag
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Results Tab -->
                    <div class="tab-pane fade show active" id="resultsContentModal" role="tabpanel">
                        <div id="searchResultsModal" class="results-container">
                            <div class="text-center py-5">
                                <i class="bi bi-search" style="font-size: 3rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">Cari untuk melihat hasil</p>
                            </div>
                        </div>
                    </div>

                    <!-- History Tab -->
                    <div class="tab-pane fade" id="historyContentModal" role="tabpanel">
                        <div id="historyListModal" class="history-container">
                            <div class="text-center py-5">
                                <i class="bi bi-clock-history" style="font-size: 3rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">Riwayat pencarian Anda akan muncul di sini</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bookmarks Tab -->
                    <div class="tab-pane fade" id="bookmarksContentModal" role="tabpanel">
                        <div id="bookmarksListModal" class="bookmarks-container">
                            <div class="text-center py-5">
                                <i class="bi bi-bookmark" style="font-size: 3rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">Belum ada bookmark</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tags Tab -->
                    <div class="tab-pane fade" id="tagsContentModal" role="tabpanel">
                        <div id="tagsListModal" class="tags-container">
                            <div class="text-center py-5">
                                <i class="bi bi-tags" style="font-size: 3rem; color: #d1d5db;"></i>
                                <p class="text-muted mt-3">Belum ada tag</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 pt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 0.5rem 1.5rem;">
                    <i class="bi bi-x-lg me-2"></i>Tutup
                </button>
                <button type="button" class="btn btn-outline-danger" id="clearHistoryModalBtn" style="border-radius: 8px; padding: 0.5rem 1.5rem;">
                    <i class="bi bi-trash me-2"></i>Hapus Riwayat
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Show Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchModal = new bootstrap.Modal(document.getElementById('searchModal'), {
            keyboard: true,
            backdrop: true
        });

        // Expose to window for navbar links
        window.showSearchModal = function() {
            searchModal.show();
            document.getElementById('searchInputModal').focus();
        };

        // Search functionality
        let searchTimeout;
        document.getElementById('searchInputModal').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value;

            if (query.length < 2) {
                document.getElementById('searchResultsModal').innerHTML = `
                <div class="text-center py-5">
                    <i class="bi bi-search" style="font-size: 3rem; color: #d1d5db;"></i>
                    <p class="text-muted mt-3">Ketik minimal 2 karakter untuk mencari</p>
                </div>
            `;
                return;
            }

            searchTimeout = setTimeout(async function() {
                try {
                    const filterType = document.getElementById('filterTypeModal').value;
                    const url = `/api/search?query=${encodeURIComponent(query)}${filterType ? '&type=' + filterType : ''}`;

                    const response = await fetch(url, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        displaySearchResults(data);
                    } else {
                        document.getElementById('searchResultsModal').innerHTML = `
                        <div class="alert alert-danger">Gagal melakukan pencarian</div>
                    `;
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }, 300);
        });

        function displaySearchResults(data) {
            const container = document.getElementById('searchResultsModal');

            if (!data.results || data.results.length === 0) {
                container.innerHTML = `
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #d1d5db;"></i>
                    <p class="text-muted mt-3">Tidak ada hasil yang ditemukan</p>
                </div>
            `;
                return;
            }

            let html = '';
            data.results.forEach(result => {
                const icon = result.type === 'note' ? 'bi-sticky' : result.type === 'project' ? 'bi-folder' : 'bi-chat-left';
                html += `
                <div class="search-result-item p-3 mb-2" style="background: white; border-radius: 10px; border-left: 4px solid #f093fb; cursor: pointer; transition: all 0.3s;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                <i class="bi ${icon} me-2" style="color: #f093fb;"></i>
                                ${result.title || result.name}
                            </h6>
                            <p class="small text-muted mb-0">${result.excerpt || result.description || result.content}</p>
                            <div class="mt-2">
                                <span class="badge bg-light text-dark me-2">${result.type}</span>
                                <small class="text-muted">${new Date(result.created_at).toLocaleDateString('id-ID')}</small>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-light bookmark-btn" data-id="${result.id}">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                </div>
            `;
            });

            container.innerHTML = html;

            // Bookmark buttons
            container.querySelectorAll('.bookmark-btn').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.stopPropagation();
                    // Implement bookmark functionality
                });
            });
        }

        // Load history
        async function loadHistory() {
            try {
                const response = await fetch('/api/search/history', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    const container = document.getElementById('historyListModal');

                    if (!data.data || data.data.length === 0) {
                        container.innerHTML = `
                        <div class="text-center py-5">
                            <i class="bi bi-clock-history" style="font-size: 3rem; color: #d1d5db;"></i>
                            <p class="text-muted mt-3">Riwayat pencarian Anda akan muncul di sini</p>
                        </div>
                    `;
                        return;
                    }

                    let html = '';
                    data.data.forEach(item => {
                        html += `
                        <div class="history-item p-3 mb-2" style="background: white; border-radius: 10px; cursor: pointer; transition: all 0.3s;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <i class="bi bi-clock me-2" style="color: #f093fb;"></i>
                                        ${item.query}
                                    </h6>
                                    <small class="text-muted">${item.result_count} hasil • ${new Date(item.last_searched_at).toLocaleDateString('id-ID')}</small>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">Ulangi</button>
                            </div>
                        </div>
                    `;
                    });

                    container.innerHTML = html;
                }
            } catch (error) {
                console.error('Error loading history:', error);
            }
        }

        // Load bookmarks
        async function loadBookmarks() {
            try {
                const response = await fetch('/api/search/bookmarks', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    const container = document.getElementById('bookmarksListModal');

                    if (!data.data || data.data.length === 0) {
                        container.innerHTML = `
                        <div class="text-center py-5">
                            <i class="bi bi-bookmark" style="font-size: 3rem; color: #d1d5db;"></i>
                            <p class="text-muted mt-3">Belum ada bookmark</p>
                        </div>
                    `;
                        return;
                    }

                    let html = '';
                    data.data.forEach(item => {
                        html += `
                        <div class="bookmark-item p-3 mb-2" style="background: white; border-radius: 10px;">
                            <h6 class="mb-1">
                                <i class="bi bi-bookmark-fill me-2" style="color: #f093fb;"></i>
                                ${item.query}
                            </h6>
                            <small class="text-muted">Disimpan pada ${new Date(item.created_at).toLocaleDateString('id-ID')}</small>
                        </div>
                    `;
                    });

                    container.innerHTML = html;
                }
            } catch (error) {
                console.error('Error loading bookmarks:', error);
            }
        }

        // Clear history
        document.getElementById('clearHistoryModalBtn').addEventListener('click', async function() {
            if (!confirm('Apakah Anda yakin ingin menghapus semua riwayat pencarian?')) return;

            try {
                const response = await fetch('/api/search/history', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    alert('Riwayat berhasil dihapus');
                    loadHistory();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });

        // Tab switching
        document.getElementById('historyTabModal').addEventListener('click', loadHistory);
        document.getElementById('bookmarksTabModal').addEventListener('click', loadBookmarks);
    });
</script>

<style>
    .search-result-item:hover,
    .history-item:hover,
    .bookmark-item:hover {
        background: #f9fafb !important;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(240, 147, 251, 0.15);
    }

    .modal-body {
        scrollbar-width: thin;
        scrollbar-color: #d1d5db #f9fafb;
    }

    .modal-body::-webkit-scrollbar {
        width: 6px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f9fafb;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>