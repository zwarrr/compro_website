<x-layouts.app>
    <x-slot name="title">Manajemen Kategori</x-slot>

    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola kategori layanan, galeri, dan karyawan</p>
            </div>
            <button onclick="openCreateModal()"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Kategori
            </button>
        </div>
    </x-slot>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.kategori.index') }}" id="filterForm"
            class="flex flex-col md:flex-row gap-4">

            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama kategori atau kode..."
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none"
                        id="searchInput">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Filter Tipe -->
            <div class="w-full md:w-48">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                    <select name="tipe" id="tipeSelect"
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none appearance-none">
                        <option value="">Semua Tipe</option>
                        <option value="layanan" {{ request('tipe') == 'layanan' ? 'selected' : '' }}>Layanan</option>
                        <option value="galeri" {{ request('tipe') == 'galeri' ? 'selected' : '' }}>Galeri</option>
                        <option value="karyawan" {{ request('tipe') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                        <option value="client" {{ request('tipe') == 'client' ? 'selected' : '' }}>Klien</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Kategori</h3>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto overflow-y-visible min-h-[500px]">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kategoris as $index => $kategori)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $kategoris->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $kategori->kode_kategori }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $kategori->nama_kategori }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    switch ($kategori->tipe) {
                                        case 'layanan':
                                            $badgeClass = 'bg-green-100 text-green-800';
                                            break;
                                        case 'galeri':
                                            $badgeClass = 'bg-purple-100 text-purple-800';
                                            break;
                                        case 'karyawan':
                                            $badgeClass = 'bg-yellow-100 text-yellow-800';
                                            break;
                                        default:
                                            $badgeClass = 'bg-gray-100 text-gray-800';
                                    }
                                @endphp

                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                    {{ ucfirst($kategori->tipe) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                                <!-- Dropdown Aksi -->
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" type="button"
                                            class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-offset-2"
                                            :class="{ 'bg-gray-100 text-gray-600': open }">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Dropdown menu -->
                                    <div x-show="open" @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none border border-gray-200"
                                        style="display: none; z-index: 1;">
                                        <div class="py-1">
                                            <!-- Detail Action -->
                                            <button onclick="showDetail({{ $kategori->id_kategori }})"
                                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors first:rounded-t-xl">
                                                <svg class="w-4 h-4 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span>Detail Kategori</span>
                                            </button>

                                            <!-- Edit Action -->
                                            <button onclick="openEditModal({{ $kategori->id_kategori }})"
                                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span>Edit Kategori</span>
                                            </button>

                                            <!-- Delete Action -->
                                            <button
                                                onclick="confirmDelete({{ $kategori->id_kategori }}, '{{ $kategori->nama_kategori }}')"
                                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors last:rounded-b-xl">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Hapus Kategori</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p class="mt-2">Tidak ada data kategori</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($kategoris->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $kategoris->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>

    <!-- Include Modals -->
    @include('admin.kategori.modals.create')
    @include('admin.kategori.modals.detail')
    @include('admin.kategori.modals.edit')
    @include('admin.kategori.modals.delete')

    <!-- Include Scripts -->
    @include('admin.kategori.scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const searchInput = document.getElementById('searchInput');
    const tipeSelect = document.getElementById('tipeSelect');
    const tableBody = document.querySelector('tbody');
    const paginationContainer = document.querySelector('.px-6.py-4.border-t');
    let typingTimer;

    // Fungsi untuk menampilkan animasi loading di dalam tabel
    function showLoading() {
        tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center space-y-3">
                        <svg class="animate-spin h-10 w-10 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l3 3-3 3v-4a8 8 0 01-8-8z"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Memuat data...</p>
                    </div>
                </td>
            </tr>
        `;
    }

    // Fungsi untuk load data kategori via AJAX
    function fetchData() {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData).toString();

        showLoading(); // tampilkan loading

        fetch(`{{ route('admin.kategori.index') }}?${params}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTbody = doc.querySelector('tbody');
            const newPagination = doc.querySelector('.px-6.py-4.border-t');

            // Ganti isi tabel dan pagination tanpa reload
            tableBody.innerHTML = newTbody.innerHTML;
            if (paginationContainer && newPagination) {
                paginationContainer.innerHTML = newPagination.innerHTML;
            }
        })
        .catch(err => {
            console.error(err);
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-red-500">
                        Gagal memuat data. Coba lagi nanti.
                    </td>
                </tr>
            `;
        });
    }

    // Live search (delay 400ms)
    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchData, 400);
    });

    // Live filter (langsung saat tipe diganti)
    tipeSelect.addEventListener('change', fetchData);

    // Pagination via AJAX
    document.addEventListener('click', function(e) {
        if (e.target.closest('.pagination a')) {
            e.preventDefault();
            const url = e.target.closest('a').getAttribute('href');
            if (!url) return;

            showLoading();

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTbody = doc.querySelector('tbody');
                    const newPagination = doc.querySelector('.px-6.py-4.border-t');

                    tableBody.innerHTML = newTbody.innerHTML;
                    if (paginationContainer && newPagination) {
                        paginationContainer.innerHTML = newPagination.innerHTML;
                    }
                });
        }
    });
});
</script>


</x-layouts.app>
