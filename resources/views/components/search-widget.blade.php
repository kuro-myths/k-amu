@props([
'placeholder' => 'Cari data Anda...',
'filterType' => false,
'compact' => false,
])

<div class="search-widget {{ $compact ? 'compact' : '' }}">
    <div class="relative mb-4">
        <input
            type="text"
            class="search-input w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="{{ $placeholder }}"
            id="globalSearchInput">
        <button
            type="button"
            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-2xl hover:scale-110 transition search-icon-btn"
            id="globalSearchBtn"
            title="Cari atau tambah pencarian">
            ➕
        </button>
    </div>

    @if($filterType)
    <div class="mb-4">
        <label class="block text-sm font-semibold mb-2">Filter Tipe</label>
        <select id="globalFilterType" class="w-full p-2 border border-gray-300 rounded-lg text-sm">
            <option value="all">Semua Tipe</option>
            <option value="notes">📝 Catatan</option>
            <option value="projects">📊 Proyek</option>
            <option value="messages">💬 Pesan</option>
        </select>
    </div>
    @endif

    <div class="space-y-2 border-t pt-4">
        <a href="{{ route('search') }}" class="block w-full text-left px-3 py-2 hover:bg-gray-100 rounded-lg transition text-sm font-medium">
            🔍 Buka Pencarian Lengkap
        </a>
    </div>
</div>

<script>
    document.getElementById('globalSearchBtn').addEventListener('click', async () => {
        const query = document.getElementById('globalSearchInput').value.trim();
        const type = document.getElementById('globalFilterType')?.value || 'all';

        if (!query) {
            alert('Masukkan kata kunci pencarian');
            return;
        }

        // Redirect ke halaman pencarian dengan query
        window.location.href = `/search?q=${encodeURIComponent(query)}&type=${type}`;
    });

    document.getElementById('globalSearchInput').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            document.getElementById('globalSearchBtn').click();
        }
    });
</script>