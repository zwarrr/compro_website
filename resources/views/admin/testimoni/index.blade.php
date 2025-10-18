<x-layouts.app>
    <x-slot name="title">Manajemen Testimoni</x-slot>

    @php
        // Ambil mode tampilan dari request (default: table)
        $viewMode = request('view', 'table');
        $isCardView = $viewMode === 'card';
        $nextViewMode = $isCardView ? 'table' : 'card';
        $currentQuery = request()->except(['view', 'page']);
        $toggleUrl = route('admin.testimoni.index', array_merge($currentQuery, ['view' => $nextViewMode]));
    @endphp

    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Testimoni</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola testimoni pelanggan</p>
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
                <button onclick="openCreateTestimoniModal()"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Testimoni
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.testimoni.index') }}" id="filterTestimoniForm"
            class="flex flex-col md:flex-row gap-4">

            {{-- Hidden input untuk mempertahankan view mode saat submit filter --}}
            <input type="hidden" name="view" value="{{ $viewMode }}">

            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau kode testimoni..."
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none"
                        id="testimoniSearchInput">
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
                    <select name="status" id="testimoniStatusSelect"
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none appearance-none">
                        <option value="">Semua Status</option>
                        <option value="publik" {{ request('status') == 'publik' ? 'selected' : '' }}>Publish</option>
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

            <!-- Filter Rating -->
            <div class="w-full md:w-48">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <select name="rating" id="testimoniRatingSelect"
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none appearance-none">
                        <option value="">Semua Rating</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>⭐⭐</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>⭐</option>
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
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Testimoni (Tampilan Kartu)</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($testimonis as $testimoni)
                        <div class="group relative bg-white border-2 border-gray-200 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-primary/50">
                            <!-- Header with Quote Icon -->
                            <div class="bg-gradient-to-r from-primary to-red-700 h-20 relative">
                                <div class="absolute inset-0 bg-black/10"></div>
                                <div class="absolute top-4 left-4">
                                    <svg class="w-8 h-8 text-white/40" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                                    </svg>
                                </div>
                                
                                <!-- Status Badge -->
                                @php
                                    $statusBadgeClass = $testimoni->status === 'aktif' 
                                        ? 'bg-green-500 text-white' 
                                        : 'bg-gray-500 text-white';
                                @endphp
                                <span class="absolute top-3 right-4 px-2.5 py-1 text-xs font-bold rounded-full {{ $statusBadgeClass }} shadow-lg">
                                    {{ strtoupper($testimoni->status) }}
                                </span>
                            </div>

                            <!-- Photo Section -->
                            <div class="relative -mt-12 flex justify-center px-4">
                                <div class="relative">
                                    @if($testimoni->foto)
                                        <img src="{{ asset('storage/' . $testimoni->foto) }}" 
                                             alt="{{ $testimoni->nama_testimoni }}"
                                             class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl ring-2 ring-gray-200">
                                    @else
                                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 border-4 border-white shadow-xl ring-2 ring-gray-200 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="px-5 pt-4 pb-5 text-center">
                                <!-- Name -->
                                <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1" title="{{ $testimoni->nama_testimoni }}">
                                    {{ $testimoni->nama_testimoni }}
                                </h3>
                                
                                <!-- Jabatan -->
                                <p class="text-sm text-gray-600 mb-3">{{ $testimoni->jabatan }}</p>

                                <!-- Rating -->
                                <div class="flex justify-center items-center gap-1 mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimoni->rating)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>

                                <!-- Pesan Testimoni -->
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 mb-3">
                                    <p class="text-sm text-gray-700 line-clamp-4 leading-relaxed italic">
                                        "{{ Str::limit($testimoni->pesan, 120) }}"
                                    </p>
                                </div>

                                <!-- Kode Testimoni -->
                                <div class="text-xs text-gray-400 flex items-center justify-center gap-1">
                                    <span class="font-mono">{{ $testimoni->kode_testimoni }}</span>
                                    <span>•</span>
                                    <span>{{ $testimoni->created_at->format('M Y') }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="border-t border-gray-200 bg-gray-50/50 px-4 py-3 flex gap-2">
                                <button onclick="showTestimoniDetail({{ $testimoni->id_testimoni }})"
                                    class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors text-xs font-semibold flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </button>
                                <button onclick="openEditTestimoniModal({{ $testimoni->id_testimoni }})"
                                    class="flex-1 px-3 py-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition-colors text-xs font-semibold flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                                <button onclick="confirmDeleteTestimoni({{ $testimoni->id_testimoni }}, '{{ $testimoni->nama_testimoni }}')"
                                    class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-xs font-semibold flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full px-6 py-12 text-center text-gray-500 bg-white rounded-xl shadow-sm border border-gray-200">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada testimoni</h3>
                            <p class="text-gray-500">Belum ada testimoni yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination for Card View -->
                @if ($testimonis->hasPages())
                    <div class="mt-6 pt-6 border-t border-pink-200">
                        {{ $testimonis->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    @else
    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Testimoni</h3>
        </div>

        <div class="overflow-x-auto overflow-y-visible min-h-[500px]">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($testimonis as $index => $testimoni)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $testimonis->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $testimoni->kode_testimoni }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">{{ $testimoni->nama_testimoni }}</div></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $testimoni->jabatan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimoni->rating)
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php $badgeClass = $testimoni->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">{{ ucfirst($testimoni->status) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($testimoni->foto)
                                    <img src="{{ asset('storage/' . $testimoni->foto) }}" alt="{{ $testimoni->nama_testimoni }}" class="w-12 h-12 object-cover rounded-full border">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 text-xs">N/A</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-offset-2" :class="{ 'bg-gray-100 text-gray-600': open }">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none border border-gray-200" style="display:none; z-index:1;">
                                        <div class="py-1">
                                            <button onclick="showTestimoniDetail({{ $testimoni->id_testimoni }})" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors first:rounded-t-xl">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                <span>Detail</span>
                                            </button>
                                            <button onclick="openEditTestimoniModal({{ $testimoni->id_testimoni }})" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                <span>Edit</span>
                                            </button>
                                            <button onclick="confirmDeleteTestimoni({{ $testimoni->id_testimoni }}, '{{ $testimoni->nama_testimoni }}')" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors last:rounded-b-xl">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                                <p class="mt-2">Tidak ada testimoni</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($testimonis->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $testimonis->withQueryString()->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>>
    @endif

    @include('admin.testimoni.modals.create')
    @include('admin.testimoni.modals.detail')
    @include('admin.testimoni.modals.edit')
    @include('admin.testimoni.modals.delete')

    @include('admin.testimoni.scripts')

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterTestimoniForm');
    const searchInput = document.getElementById('testimoniSearchInput');
    const statusSelect = document.getElementById('testimoniStatusSelect');
    const ratingSelect = document.getElementById('testimoniRatingSelect');
    let typingTimer;

    function showLoading() {
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
            const gridContainer = document.querySelector('.grid.grid-cols-1');
            if (gridContainer) {
                gridContainer.innerHTML = `<div class="col-span-full">${loadingHtml}</div>`;
            }
        @else
            const tableBody = document.querySelector('tbody');
            if (tableBody) {
                tableBody.innerHTML = `<tr><td colspan="8" class="px-6 py-12 text-center">${loadingHtml}</td></tr>`;
            }
        @endif
    }

    function fetchData(url = `{{ route('admin.testimoni.index') }}`) {
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData).toString();
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
                    const newGrid = doc.querySelector('.grid.grid-cols-1');
                    const currentGrid = document.querySelector('.grid.grid-cols-1');
                    if (newGrid && currentGrid) {
                        currentGrid.innerHTML = newGrid.innerHTML;
                    }
                    
                    const newPagination = doc.querySelector('.mt-6.pt-6.border-t');
                    const currentPagination = document.querySelector('.mt-6.pt-6.border-t');
                    if (newPagination && currentPagination) {
                        currentPagination.innerHTML = newPagination.innerHTML;
                    } else if (newPagination) {
                        const cardContainer = document.querySelector('.p-6');
                        if (cardContainer && !currentPagination) {
                            cardContainer.insertAdjacentHTML('beforeend', newPagination.outerHTML);
                        }
                    } else if (currentPagination) {
                        currentPagination.remove();
                    }
                @else
                    const newTbody = doc.querySelector('tbody');
                    const currentTbody = document.querySelector('tbody');
                    if (newTbody && currentTbody) {
                        currentTbody.innerHTML = newTbody.innerHTML;
                    }
                    
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
                        tableBody.innerHTML = `<tr><td colspan="8" class="px-6 py-12 text-center text-red-500">Gagal memuat data.</td></tr>`;
                    }
                @endif
            });
    }

    searchInput.addEventListener('input', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => fetchData(`{{ route('admin.testimoni.index') }}`), 400);
    });

    statusSelect.addEventListener('change', () => fetchData(`{{ route('admin.testimoni.index') }}`));
    ratingSelect.addEventListener('change', () => fetchData(`{{ route('admin.testimoni.index') }}`));

    document.addEventListener('click', e => {
        const paginationLink = e.target.closest('.pagination a, .mt-6.pt-6.border-t a');
        if (paginationLink) {
            e.preventDefault();
            const url = paginationLink.href;
            if (url) {
                const newUrl = url.split('?')[0];
                fetchData(newUrl);
            }
        }
    });
});
</script>

</x-layouts.app>