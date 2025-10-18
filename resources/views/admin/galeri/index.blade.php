<x-layouts.app>
    <x-slot name="title">Manajemen Galeri</x-slot>

    @php
        // Ambil mode tampilan dari request (default: table)
        $viewMode = request('view', 'table');
        $isCardView = $viewMode === 'card';
        $nextViewMode = $isCardView ? 'table' : 'card';
        $currentQuery = request()->except(['view', 'page']);
        $toggleUrl = route('admin.galeri.index', array_merge($currentQuery, ['view' => $nextViewMode]));
    @endphp
    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Galeri</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola item galeri perusahaan</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- View Toggle -->
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
                <button onclick="openCreateGaleriModal()"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Galeri
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.galeri.index') }}" id="filterGaleriForm"
            class="flex flex-col md:flex-row gap-4">
            <input type="hidden" name="view" value="{{ $viewMode }}">

            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul galeri atau kode..."
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none"
                        id="galeriSearchInput">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Filter Status -->
            <div class="w-full md:w-48">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                    <select name="status" id="galeriStatusSelect"
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none appearance-none">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                        </option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="w-full md:w-64">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                    <select name="kategori_id" id="galeriKategoriSelect"
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none appearance-none">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ request('kategori_id') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}</option>
                        @endforeach
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

    @if ($isCardView)
        <!-- Card View -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Galeri (Tampilan Kartu)</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($galeris as $galeri)
                        <div
                            class="group relative bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-primary/20 hover:glow-primary">
                            <!-- Image Section -->
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                @if ($galeri->gambar)
                                    <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}"
                                        alt="{{ $galeri->judul }}"
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
                                        $galeri->status === 'aktif'
                                            ? 'bg-green-500 text-white'
                                            : 'bg-gray-500 text-white';
                                    $statusText = $galeri->status === 'aktif' ? 'Aktif' : 'Nonaktif';
                                @endphp
                                <span
                                    class="absolute top-3 right-3 px-2.5 py-1 text-xs font-semibold rounded-full {{ $statusCardClass }} backdrop-blur-sm bg-opacity-90">
                                    {{ $statusText }}
                                </span>

                                <!-- Category Badge -->
                                <span
                                    class="absolute top-3 left-3 px-2.5 py-1 text-xs font-semibold rounded-full bg-primary text-white backdrop-blur-sm bg-opacity-90">
                                    {{ $galeri->kategori->nama_kategori ?? 'Uncategorized' }}
                                </span>

                                <!-- Overlay Menu -->
                                <div
                                    class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="relative">
                                        <button onclick="toggleCardMenu({{ $galeri->id_galeri }})"
                                            class="w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white transition-colors">
                                            <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 12h.01M12 12h.01M19 12h.01" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown Menu -->
                                        <div id="card-menu-{{ $galeri->id_galeri }}"
                                            class="absolute right-0 top-full mt-2 w-36 bg-white rounded-lg shadow-xl border border-gray-200 py-1 z-50 hidden">
                                            <button onclick="showGaleriDetail({{ $galeri->id_galeri }})"
                                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition-colors">
                                                <svg class="w-4 h-4 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Detail
                                            </button>
                                            <button onclick="openEditGaleriModal({{ $galeri->id_galeri }})"
                                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2 transition-colors">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            <button
                                                onclick="confirmDeleteGaleri({{ $galeri->id_galeri }}, '{{ $galeri->judul }}')"
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
                                <!-- Kode Galeri -->
                                <div class="mb-2">
                                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        {{ $galeri->kode_galeri }}
                                    </span>
                                </div>

                                <!-- Judul -->
                                <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-tight group-hover:text-primary transition-colors"
                                    title="{{ $galeri->judul }}">
                                    {{ $galeri->judul }}
                                </h4>

                                <!-- Description Preview -->
                                @if ($galeri->deskripsi)
                                    <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed mb-3">
                                        {{ Str::limit(strip_tags($galeri->deskripsi), 80) }}
                                    </p>
                                @endif

                                <!-- Created Date -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <span class="text-xs text-gray-400">
                                        {{ $galeri->created_at->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-400 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $galeri->created_at->format('H:i') }}
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
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada data galeri</h3>
                            <p class="text-gray-500">Belum ada galeri yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination for Card View -->
                @if ($galeris->hasPages())
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        {{ $galeris->links() }}
                    </div>
                @endif
            </div>
        </div>
    @else
        <!-- Table View (Existing Code) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Galeri</h3>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto overflow-y-visible min-h-[500px]">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gambar</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($galeris as $index => $galeri)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $galeris->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $galeri->kode_galeri }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $galeri->judul }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-700">{{ $galeri->kategori->nama_kategori ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $badgeClass =
                                            $galeri->status === 'aktif'
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                        {{ ucfirst($galeri->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($galeri->gambar)
                                        <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}"
                                            alt="{{ $galeri->judul }}"
                                            class="w-12 h-12 object-cover rounded-lg border">
                                    @else
                                        <div
                                            class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                            N/A</div>
                                    @endif
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
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
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
                                                <button onclick="showGaleriDetail({{ $galeri->id_galeri }})"
                                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors first:rounded-t-xl">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    <span>Detail</span>
                                                </button>

                                                <!-- Edit Action -->
                                                <button onclick="openEditGaleriModal({{ $galeri->id_galeri }})"
                                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                    <svg class="w-4 h-4 text-yellow-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </button>

                                                <!-- Delete Action -->
                                                <button
                                                    onclick="confirmDeleteGaleri({{ $galeri->id_galeri }}, '{{ $galeri->judul }}')"
                                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors last:rounded-b-xl">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="mt-2">Tidak ada data galeri</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($galeris->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $galeris->links('vendor.pagination.custom') }}
                </div>
            @endif
        </div>
    @endif

    <!-- Include Modals -->
    @include('admin.galeri.modals.create')
    @include('admin.galeri.modals.detail')
    @include('admin.galeri.modals.edit')
    @include('admin.galeri.modals.delete')

    <!-- Include Scripts -->
    @include('admin.galeri.scripts')

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
        function toggleCardMenu(galeriId) {
            const menu = document.getElementById(`card-menu-${galeriId}`);
            const allMenus = document.querySelectorAll('[id^="card-menu-"]');

            // Close all other menus
            allMenus.forEach(m => {
                if (m.id !== `card-menu-${galeriId}`) {
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

        function toggleView(viewType) {
            const url = new URL(window.location.href);
            url.searchParams.set('view', viewType);
            window.location.href = url.toString();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterGaleriForm');
            const searchInput = document.getElementById('galeriSearchInput');
            const statusSelect = document.getElementById('galeriStatusSelect');
            const kategoriSelect = document.getElementById('galeriKategoriSelect');
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

                @if ($isCardView)
                    // Mode Card View
                    const gridContainer = document.querySelector('.grid.grid-cols-1');
                    if (gridContainer) {
                        gridContainer.innerHTML = `<div class="col-span-full">${loadingHtml}</div>`;
                    }
                @else
                    // Mode Table View
                    const tableBody = document.querySelector('tbody');
                    if (tableBody) {
                        tableBody.innerHTML = `<tr><td colspan="7" class="px-6 py-12 text-center">${loadingHtml}</td></tr>`;
                    }
                @endif
            }

            function fetchData(url = `{{ route('admin.galeri.index') }}`) {
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
                        
                        @if ($isCardView)
                            // Update Card View
                            const newGrid = doc.querySelector('.grid.grid-cols-1');
                            const currentGrid = document.querySelector('.grid.grid-cols-1');
                            if (newGrid && currentGrid) {
                                currentGrid.innerHTML = newGrid.innerHTML;
                            }
                            
                            // Update pagination untuk card view
                            const newPagination = doc.querySelector('.mt-6.pt-6.border-t');
                            const currentPagination = document.querySelector('.mt-6.pt-6.border-t');
                            if (newPagination && currentPagination) {
                                currentPagination.innerHTML = newPagination.innerHTML;
                            } else if (newPagination) {
                                const cardContainer = document.querySelector('.p-6.bg-white.rounded-b-xl');
                                if (cardContainer && !currentPagination) {
                                    cardContainer.insertAdjacentHTML('beforeend', newPagination.outerHTML);
                                }
                            } else if (currentPagination) {
                                currentPagination.remove();
                            }
                        @else
                            // Update Table View
                            const newTbody = doc.querySelector('tbody');
                            const currentTbody = document.querySelector('tbody');
                            if (newTbody && currentTbody) {
                                currentTbody.innerHTML = newTbody.innerHTML;
                            }
                            
                            // Update pagination untuk table view
                            const newPagination = doc.querySelector('.px-6.py-4.border-t');
                            const currentPagination = document.querySelector('.px-6.py-4.border-t');
                            if (newPagination && currentPagination) {
                                currentPagination.innerHTML = newPagination.innerHTML;
                            } else if (newPagination) {
                                const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-sm.border');
                                if (tableContainer && !currentPagination) {
                                    tableContainer.insertAdjacentHTML('beforeend', newPagination.outerHTML);
                                }
                            } else if (currentPagination) {
                                currentPagination.remove();
                            }
                        @endif
                    })
                    .catch(() => {
                        @if ($isCardView)
                            const gridContainer = document.querySelector('.grid.grid-cols-1');
                            if (gridContainer) {
                                gridContainer.innerHTML = `<div class="col-span-full px-6 py-12 text-center text-red-500">Gagal memuat data.</div>`;
                            }
                        @else
                            const tableBody = document.querySelector('tbody');
                            if (tableBody) {
                                tableBody.innerHTML = `<tr><td colspan="7" class="px-6 py-12 text-center text-red-500">Gagal memuat data.</td></tr>`;
                            }
                        @endif
                    });
            }

            // Event Listener untuk Search (dengan debounce)
            searchInput.addEventListener('input', () => {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => fetchData(`{{ route('admin.galeri.index') }}`), 400);
            });

            // Event Listener untuk Filter Status dan Kategori
            statusSelect.addEventListener('change', () => fetchData(`{{ route('admin.galeri.index') }}`));
            kategoriSelect.addEventListener('change', () => fetchData(`{{ route('admin.galeri.index') }}`));

            // Event Listener untuk Pagination AJAX
            document.addEventListener('click', e => {
                const paginationLink = e.target.closest('.pagination a, .mt-6.pt-6.border-t a');
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
