<x-layouts.app>
    <x-slot name="title">Manajemen Layanan</x-slot>

    @php
        // Ambil mode tampilan dari request (default: table)
        $viewMode = request('view', 'table');
        $isCardView = $viewMode === 'card';
        $nextViewMode = $isCardView ? 'table' : 'card';
        $currentQuery = request()->except(['view', 'page']);
        $toggleUrl = route('admin.layanan.index', array_merge($currentQuery, ['view' => $nextViewMode]));
    @endphp

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Layanan</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola data layanan dan kategori terkait</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ $toggleUrl }}"
                    class="p-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors flex items-center gap-2 text-sm shadow-sm"
                    title="Ubah tampilan menjadi {{ ucfirst($nextViewMode) }}">
                    @if ($isCardView)
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    @endif
                </a>

                <button onclick="openCreateModal()"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Layanan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-200">
        {{-- action di-adjust agar tetap membawa parameter view --}}
        <form method="GET" action="{{ route('admin.layanan.index') }}" id="filterForm"
            class="flex flex-col md:flex-row gap-4">

            {{-- Hidden input untuk mempertahankan view mode saat submit filter --}}
            <input type="hidden" name="view" value="{{ $viewMode }}">

            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari kode atau judul layanan..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        id="searchInput">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <div class="w-full md:w-48">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                    <select name="status" id="statusSelect"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white appearance-none transition">
                        <option value="">Semua Status</option>
                        <option value="publik" {{ request('status') == 'publik' ? 'selected' : '' }}>Publik</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
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

    <div id="content-container">
        @if ($isCardView)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 rounded-t-xl">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Layanan (Tampilan Kartu)</h3>
            </div>

            <div class="p-6 bg-white rounded-b-xl shadow-sm border border-gray-200">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($layanans as $layanan)
                        <div
                            class="group relative bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-primary/20 hover:glow-primary">
                            <!-- Image Section -->
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                @if ($layanan->gambar)
                                    <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="{{ $layanan->judul }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs font-medium">No Image</span>
                                    </div>
                                @endif

                                <!-- Status Badge -->
                                @php
                                    $statusCardClass =
                                        $layanan->status === 'publik'
                                            ? 'bg-green-500 text-white'
                                            : 'bg-gray-500 text-white';
                                    $statusText = $layanan->status === 'publik' ? 'Publik' : 'Draft';
                                @endphp
                                <span
                                    class="absolute top-3 right-3 px-2.5 py-1 text-xs font-semibold rounded-full {{ $statusCardClass }} backdrop-blur-sm bg-opacity-90">
                                    {{ $statusText }}
                                </span>

                                <!-- Category Badge -->
                                <span
                                    class="absolute top-3 left-3 px-2.5 py-1 text-xs font-semibold rounded-full bg-primary text-white backdrop-blur-sm bg-opacity-90">
                                    {{ $layanan->kategori->nama_kategori ?? 'Uncategorized' }}
                                </span>

                                <!-- Overlay Menu -->
                                <div
                                    class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="relative">
                                        <button onclick="toggleCardMenu({{ $layanan->id_layanan }})"
                                            class="w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white transition-colors">
                                            <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 12h.01M12 12h.01M19 12h.01" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown Menu -->
                                        <div id="card-menu-{{ $layanan->id_layanan }}"
                                            class="absolute right-0 top-full mt-2 w-36 bg-white rounded-lg shadow-xl border border-gray-200 py-1 z-50 hidden">
                                            <button onclick="showDetail({{ $layanan->id_layanan }})"
                                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Detail
                                            </button>
                                            <button onclick="openEditModal({{ $layanan->id_layanan }})"
                                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            <button
                                                onclick="confirmDelete({{ $layanan->id_layanan }}, '{{ $layanan->judul }}')"
                                                class="w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-4">
                                <!-- Kode Layanan -->
                                <div class="mb-2">
                                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        Kode: {{ $layanan->kode_layanan }}
                                    </span>
                                </div>

                                <!-- Judul -->
                                <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-tight group-hover:text-primary transition-colors"
                                    title="{{ $layanan->judul }}">
                                    {{ $layanan->judul }}
                                </h4>

                                <!-- Slogan -->
                                @if ($layanan->slog)
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2 leading-relaxed"
                                        title="{{ $layanan->slog }}">
                                        {{ $layanan->slog }}
                                    </p>
                                @endif

                                <!-- Description Preview -->
                                @if ($layanan->deskripsi)
                                    <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-3">
                                        {{ Str::limit(strip_tags($layanan->deskripsi), 80) }}
                                    </p>
                                @endif

                                <!-- Created Date -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <span class="text-xs text-gray-400">
                                        {{ $layanan->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-400 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $layanan->created_at->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full px-6 py-12 text-center text-gray-500 bg-white rounded-xl shadow-sm border border-gray-200">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada data layanan</h3>
                            <p class="text-gray-500">Belum ada layanan yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

            <style>
                .hover\:glow-primary:hover {
                    box-shadow: 0 10px 30px -10px rgba(239, 68, 68, 0.3);
                }

                .line-clamp-2 {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
            </style>

            <script>
                function toggleCardMenu(layananId) {
                    const menu = document.getElementById(`card-menu-${layananId}`);
                    const allMenus = document.querySelectorAll('[id^="card-menu-"]');

                    // Close all other menus
                    allMenus.forEach(m => {
                        if (m.id !== `card-menu-${layananId}`) {
                            m.classList.add('hidden');
                        }
                    });

                    // Toggle current menu
                    menu.classList.toggle('hidden');
                }

                // Close menus when clicking outside
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('[id^="card-menu-"]') && !event.target.closest(
                        '[onclick*="toggleCardMenu"]')) {
                        const allMenus = document.querySelectorAll('[id^="card-menu-"]');
                        allMenus.forEach(menu => {
                            menu.classList.add('hidden');
                        });
                    }
                });
            </script>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Layanan (Tampilan Tabel)</h3>
                </div>

                <div class="overflow-x-auto min-h-[500px]">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                            @forelse($layanans as $index => $layanan)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $layanans->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $layanan->kode_layanan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0">
                                                @if ($layanan->gambar)
                                                    <img src="{{ asset('storage/' . $layanan->gambar) }}"
                                                        alt="{{ $layanan->judul }}"
                                                        class="w-12 h-12 rounded-lg object-cover border border-gray-200 shadow-sm">
                                                @else
                                                    <div
                                                        class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                                                        <svg class="w-6 h-6 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    {{ $layanan->judul }}</p>
                                                @if ($layanan->slog)
                                                    <p class="text-xs text-gray-500 truncate">{{ $layanan->slog }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $layanan->kategori->nama_kategori ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass =
                                                $layanan->status === 'publik'
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-red-100 text-red-800';
                                        @endphp
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst($layanan->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open" type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                                :class="{ 'bg-gray-100 text-gray-600': open }">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                </svg>
                                            </button>
                                            <div x-show="open" @click.away="open = false" x-transition
                                                class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl border border-gray-200 z-10">
                                                <div class="py-1">
                                                    <button onclick="showDetail({{ $layanan->id_layanan }})"
                                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                                        <svg class="w-4 h-4 text-blue-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Detail
                                                    </button>
                                                    <button onclick="openEditModal({{ $layanan->id_layanan }})"
                                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                                        <svg class="w-4 h-4 text-yellow-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    <button
                                                        onclick="confirmDelete({{ $layanan->id_layanan }}, '{{ $layanan->judul }}')"
                                                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="mt-2">Tidak ada data layanan ditemukan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if ($layanans->hasPages())
            <div id="pagination-container" class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $layanans->withQueryString()->links() }}
            </div>
        @endif
    </div>

    @include('admin.layanan.modals.create')
    @include('admin.layanan.modals.detail')
    @include('admin.layanan.modals.edit')
    @include('admin.layanan.modals.delete')

    @include('admin.layanan.scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.getElementById('searchInput');
            const statusSelect = document.getElementById('statusSelect');
            const contentContainer = document.getElementById('content-container');
            const paginationContainer = document.getElementById('pagination-container');
            let typingTimer;

            function showLoading() {
                // Tentukan elemen mana yang akan menampilkan loading berdasarkan view mode
                const loadingHtml = `
                    <div class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-3">
                            <svg class="animate-spin h-10 w-10 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l3 3-3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Memuat data...</p>
                        </div>
                    </div>
                `;

                // Jika mode tabel, ganti tbody. Jika mode card, ganti seluruh konten utama.
                @if ($isCardView)
                    // Hapus pagination sementara
                    if (paginationContainer) {
                        paginationContainer.innerHTML = '';
                    }
                    contentContainer.innerHTML =
                        `<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-h-[500px]">${loadingHtml}</div>`;
                @else
                    const tableBody = contentContainer.querySelector('#table-body');
                    if (tableBody) {
                        tableBody.innerHTML =
                            `<tr><td colspan="6" class="px-6 py-12 text-center">${loadingHtml}</td></tr>`;
                    }
                    // Hapus pagination sementara
                    if (paginationContainer) {
                        paginationContainer.innerHTML = '';
                    }
                @endif
            }

            function fetchData(url = `{{ route('admin.layanan.index') }}`) {
                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData).toString();

                // Tambahkan parameter filter ke URL pagination
                const fullUrl = url.includes('?') ? `${url}&${params}` : `${url}?${params}`;

                showLoading();

                fetch(fullUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        const newContent = doc.querySelector('#content-container').innerHTML;

                        // Update the entire content container to handle view changes
                        contentContainer.innerHTML = newContent;

                    })
                    .catch(() => {
                        @if ($isCardView)
                            contentContainer.innerHTML =
                                `<div class="px-6 py-12 text-center text-red-500 bg-white rounded-xl shadow-sm border border-gray-200">Gagal memuat data.</div>`;
                        @else
                            const tableBody = contentContainer.querySelector('#table-body');
                            if (tableBody) {
                                tableBody.innerHTML =
                                    `<tr><td colspan="6" class="px-6 py-12 text-center text-red-500">Gagal memuat data.</td></tr>`;
                            }
                        @endif
                        if (paginationContainer) {
                            paginationContainer.innerHTML = '';
                        }
                    });
            }

            // Event Listener untuk Search (dengan debounce)
            searchInput.addEventListener('input', () => {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => fetchData(`{{ route('admin.layanan.index') }}`), 400);
            });

            // Event Listener untuk Filter Status
            statusSelect.addEventListener('change', () => fetchData(`{{ route('admin.layanan.index') }}`));

            // Event Listener untuk Pagination AJAX
            document.addEventListener('click', e => {
                const paginationLink = e.target.closest('#pagination-container a');
                if (paginationLink) {
                    e.preventDefault();
                    const url = paginationLink.href;
                    if (url) {
                        // Hilangkan semua parameter dari URL, lalu tambahkan filterForm secara manual
                        const newUrl = url.split('?')[0];
                        fetchData(newUrl);
                    }
                }
            });
        });
    </script>
</x-layouts.app>
