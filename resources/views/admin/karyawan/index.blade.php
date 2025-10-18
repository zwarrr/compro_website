<x-layouts.app>
    <x-slot name="title">Manajemen Karyawan</x-slot>

    @php
        // Ambil mode tampilan dari request (default: table)
        $viewMode = request('view', 'table');
        $isCardView = $viewMode === 'card';
        $nextViewMode = $isCardView ? 'table' : 'card';
        $currentQuery = request()->except(['view', 'page']);
        $toggleUrl = route('admin.karyawan.index', array_merge($currentQuery, ['view' => $nextViewMode]));
    @endphp

    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Karyawan</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola data karyawan perusahaan</p>
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
                <button onclick="openCreateKaryawanModal()"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Karyawan
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.karyawan.index') }}" id="filterKaryawanForm"
            class="flex flex-col md:flex-row gap-4">

            {{-- Hidden input untuk mempertahankan view mode saat submit filter --}}
            <input type="hidden" name="view" value="{{ $viewMode }}">

            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, kode, atau NIK..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        id="karyawanSearchInput">
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
                    <select name="status" id="karyawanStatusSelect"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white appearance-none transition">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
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
                    <select name="kategori_id" id="karyawanKategoriSelect"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white appearance-none transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ request('kategori_id') == $kategori->id_kategori ? 'selected' : '' }}>
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
        <!-- Card View - ID Card Style -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Karyawan (Tampilan Kartu)</h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($karyawans as $karyawan)
                        <div class="group relative bg-gradient-to-br from-white to-gray-50 border-2 border-gray-200 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-primary/50">
                            <!-- Header Card with Company Brand -->
                            <div class="bg-gradient-to-r from-primary to-red-700 h-24 relative">
                                <div class="absolute inset-0 bg-black/10"></div>
                                <div class="absolute top-3 left-4 text-white">
                                    <p class="text-xs font-semibold opacity-90">EMPLOYEE ID CARD</p>
                                    <p class="text-[10px] opacity-75">Company Name</p>
                                </div>
                                
                                <!-- Status Badge on Header -->
                                @php
                                    $statusBadgeClass = $karyawan->status === 'aktif' 
                                        ? 'bg-green-500 text-white' 
                                        : 'bg-gray-500 text-white';
                                @endphp
                                <span class="absolute top-3 right-4 px-2.5 py-1 text-xs font-bold rounded-full {{ $statusBadgeClass }} shadow-lg">
                                    {{ strtoupper($karyawan->status) }}
                                </span>
                            </div>

                            <!-- Photo Section -->
                            <div class="relative -mt-12 flex justify-center px-4">
                                <div class="relative">
                                    @if($karyawan->foto)
                                        <img src="{{ asset('storage/karyawan/' . $karyawan->foto) }}" 
                                             alt="{{ $karyawan->nama }}"
                                             class="w-24 h-24 rounded-xl object-cover border-4 border-white shadow-xl ring-2 ring-gray-200">
                                    @else
                                        <div class="w-24 h-24 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 border-4 border-white shadow-xl ring-2 ring-gray-200 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Verification Badge -->
                                    <div class="absolute -bottom-1 -right-1 bg-blue-500 rounded-full p-1 border-2 border-white shadow-md">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Employee Information -->
                            <div class="px-5 pt-4 pb-5 text-center">
                                <!-- Name -->
                                <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1" title="{{ $karyawan->nama }}">
                                    {{ $karyawan->nama }}
                                </h3>
                                
                                <!-- Category Badge -->
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold mb-3">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $karyawan->kategori->nama_kategori ?? 'Uncategorized' }}
                                </div>

                                <!-- Employee Details -->
                                <div class="space-y-2 bg-gray-50 rounded-xl p-3 border border-gray-100">
                                    <!-- Employee Code -->
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500 font-medium">Employee ID:</span>
                                        <span class="text-gray-900 font-bold">{{ $karyawan->kode_karyawan }}</span>
                                    </div>
                                    
                                    <!-- NIK -->
                                    <div class="flex items-center justify-between text-xs border-t border-gray-200 pt-2">
                                        <span class="text-gray-500 font-medium">NIK:</span>
                                        <span class="text-gray-900 font-mono font-semibold">{{ $karyawan->nik }}</span>
                                    </div>
                                    
                                    @if($karyawan->deskripsi)
                                        <div class="border-t border-gray-200 pt-2">
                                            <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed">
                                                {{ Str::limit(strip_tags($karyawan->deskripsi), 60) }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Join Date -->
                                <div class="mt-3 flex items-center justify-center text-xs text-gray-400">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Joined {{ $karyawan->created_at->format('M Y') }}
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="border-t border-gray-200 bg-gray-50/50 px-4 py-3 flex gap-2">
                                <button onclick="showKaryawanDetail({{ $karyawan->id_karyawan }})"
                                    class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors text-xs font-semibold flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </button>
                                <button onclick="openEditKaryawanModal({{ $karyawan->id_karyawan }})"
                                    class="flex-1 px-3 py-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition-colors text-xs font-semibold flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                                <button onclick="confirmDeleteKaryawan({{ $karyawan->id_karyawan }}, '{{ $karyawan->nama }}')"
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
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Tidak ada data karyawan</h3>
                            <p class="text-gray-500">Belum ada karyawan yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination for Card View -->
                @if ($karyawans->hasPages())
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        {{ $karyawans->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    @else
    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Karyawan</h3>
        </div>

        <div class="overflow-x-auto overflow-y-visible min-h-[500px]">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($karyawans as $index => $karyawan)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $karyawans->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $karyawan->kode_karyawan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">{{ $karyawan->nama }}</div></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $karyawan->nik }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><span class="text-sm text-gray-700">{{ $karyawan->kategori->nama_kategori ?? '-' }}</span></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php $badgeClass = $karyawan->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">{{ ucfirst($karyawan->status) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($karyawan->foto)
                                    <img src="{{ asset('storage/karyawan/'.$karyawan->foto) }}" alt="{{ $karyawan->nama }}" class="w-12 h-12 object-cover rounded-lg border">
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">N/A</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" :class="{ 'bg-gray-100 text-gray-600': open }">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none border border-gray-200" style="display:none; z-index:1;">
                                        <div class="py-1">
                                            <button onclick="showKaryawanDetail({{ $karyawan->id_karyawan }})" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors first:rounded-t-xl">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                <span>Detail</span>
                                            </button>
                                            <button onclick="openEditKaryawanModal({{ $karyawan->id_karyawan }})" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                <span>Edit</span>
                                            </button>
                                            <button onclick="confirmDeleteKaryawan({{ $karyawan->id_karyawan }}, '{{ $karyawan->nama }}')" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors last:rounded-b-xl">
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
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                                <p class="mt-2">Tidak ada data karyawan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($karyawans->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $karyawans->withQueryString()->links() }}
            </div>
        @endif
    </div>
    @endif

    @include('admin.karyawan.modals.create')
    @include('admin.karyawan.modals.detail')
    @include('admin.karyawan.modals.edit')
    @include('admin.karyawan.modals.delete')

    @include('admin.karyawan.scripts')

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterKaryawanForm');
    const searchInput = document.getElementById('karyawanSearchInput');
    const statusSelect = document.getElementById('karyawanStatusSelect');
    const kategoriSelect = document.getElementById('karyawanKategoriSelect');
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
            // Mode Card View
            const gridContainer = document.querySelector('.grid.grid-cols-1');
            if (gridContainer) {
                gridContainer.innerHTML = `<div class="col-span-full">${loadingHtml}</div>`;
            }
        @else
            // Mode Table View
            const tableBody = document.querySelector('tbody');
            if (tableBody) {
                tableBody.innerHTML = `<tr><td colspan="8" class="px-6 py-12 text-center">${loadingHtml}</td></tr>`;
            }
        @endif
    }

    function fetchData(url = `{{ route('admin.karyawan.index') }}`) {
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
                        const cardContainer = document.querySelector('.p-6');
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
                        tableBody.innerHTML = `<tr><td colspan="8" class="px-6 py-12 text-center text-red-500">Gagal memuat data.</td></tr>`;
                    }
                @endif
            });
    }

    // Event Listener untuk Search (dengan debounce)
    searchInput.addEventListener('input', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => fetchData(`{{ route('admin.karyawan.index') }}`), 400);
    });

    // Event Listener untuk Filter Status dan Kategori
    statusSelect.addEventListener('change', () => fetchData(`{{ route('admin.karyawan.index') }}`));
    kategoriSelect.addEventListener('change', () => fetchData(`{{ route('admin.karyawan.index') }}`));

    // Event Listener untuk Pagination AJAX
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
