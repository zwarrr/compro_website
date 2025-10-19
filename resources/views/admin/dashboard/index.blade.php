<x-layouts.app>
    <x-slot name="title">Dashboard Admin</x-slot>

    <!-- Page Header (Using header slot) -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
                <p class="text-sm text-gray-600 mt-1">Selamat datang kembali, <span class="font-semibold text-primary">{{ Auth::user()->nama }}</span>!</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="location.reload()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Refresh Data
                </button>
                <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export Report
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Layanan -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Layanan</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['layanan'] }}</h3>
                    <a href="{{ route('admin.layanan.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Client -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Client</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['client'] }}</h3>
                    <a href="{{ route('admin.client.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Karyawan -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Karyawan</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['karyawan'] }}</h3>
                    <a href="{{ route('admin.karyawan.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Pesan -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Pesan Masuk</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['kontak'] }}</h3>
                    <a href="{{ route('admin.pesan.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-primary to-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Kategori</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['kategori'] }}</h3>
                    <a href="{{ route('admin.kategori.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Galeri -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Galeri</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['galeri'] }}</h3>
                    <a href="{{ route('admin.galeri.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Testimoni -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Testimoni</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['testimoni'] }}</h3>
                    <a href="{{ route('admin.testimoni.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 p-6 border border-gray-100 hover:border-primary/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pengguna</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $statistics['user'] }}</h3>
                    <a href="{{ route('admin.user.index') }}" class="text-xs text-primary hover:underline mt-2 inline-block">Lihat Detail →</a>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Data per Kategori - Sidebar (1 column) -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Data per Kategori</h3>
                <div class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-medium">Statistik Relasi</div>
            </div>
            <div class="space-y-3">
                @forelse($kategoriData as $item)
                    <div class="flex items-center justify-between bg-gray-50 rounded-lg transition-all duration-300 p-4 border border-gray-100 hover:border-primary/30 hover:shadow-md group cursor-pointer">
                        <!-- Icon & Info -->
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-{{ $item['tipeColor'] }}-50 rounded-lg flex items-center justify-center group-hover:bg-{{ $item['tipeColor'] }}-100 transition-all">
                                <svg class="w-5 h-5 text-{{ $item['tipeColor'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $item['tipeIcon'] !!}
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm">{{ $item['kategori']->nama_kategori }}</h4>
                                <p class="text-xs text-gray-500">{{ ucfirst($item['kategori']->tipe) }}</p>
                            </div>
                        </div>

                        <!-- Count -->
                        <div class="text-right">
                            <p class="text-xl font-bold text-{{ $item['tipeColor'] }}-600">{{ $item['dataCount'] }}</p>
                            @if($item['routeUrl'])
                                <a href="{{ $item['routeUrl'] }}" class="text-xs text-gray-400 hover:text-primary transition-colors">Lihat →</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <p class="text-gray-500 text-sm">Belum ada data kategori</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Data Distribution - Line Chart (2 columns) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tren Data Berdasarkan Waktu</h3>
                    <p class="text-xs text-gray-500 mt-1">Visualisasi pertumbuhan data per periode</p>
                </div>
                <div class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-medium">Line Chart</div>
            </div>

            <!-- Filters -->
            <div class="mb-6 space-y-5">
                <!-- Data Type Filter -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <label class="text-xs font-bold text-gray-700 mb-3 uppercase tracking-wide flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        Pilih Jenis Data
                    </label>
                    <div class="flex flex-wrap gap-2.5">
                        <button onclick="updateChartType('all')" id="btn-all" class="filter-btn active group relative px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-primary to-red-600 text-white shadow-md hover:shadow-lg hover:scale-105 border-2 border-transparent">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <span>Semua Data</span>
                            </div>
                        </button>
                        <button onclick="updateChartType('layanan')" id="btn-layanan" class="filter-btn group relative px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-white text-gray-700 shadow-sm hover:shadow-md hover:scale-105 border-2 border-gray-200 hover:border-blue-300 hover:text-blue-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>Layanan</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/0 to-blue-500/0 group-hover:from-blue-500/5 group-hover:to-blue-500/10 transition-all duration-300"></div>
                        </button>
                        <button onclick="updateChartType('client')" id="btn-client" class="filter-btn group relative px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-white text-gray-700 shadow-sm hover:shadow-md hover:scale-105 border-2 border-gray-200 hover:border-green-300 hover:text-green-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>Client</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-green-500/0 to-green-500/0 group-hover:from-green-500/5 group-hover:to-green-500/10 transition-all duration-300"></div>
                        </button>
                        <button onclick="updateChartType('karyawan')" id="btn-karyawan" class="filter-btn group relative px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-white text-gray-700 shadow-sm hover:shadow-md hover:scale-105 border-2 border-gray-200 hover:border-purple-300 hover:text-purple-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span>Karyawan</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-purple-500/0 to-purple-500/0 group-hover:from-purple-500/5 group-hover:to-purple-500/10 transition-all duration-300"></div>
                        </button>
                        <button onclick="updateChartType('testimoni')" id="btn-testimoni" class="filter-btn group relative px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-white text-gray-700 shadow-sm hover:shadow-md hover:scale-105 border-2 border-gray-200 hover:border-orange-300 hover:text-orange-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                <span>Testimoni</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-orange-500/0 to-orange-500/0 group-hover:from-orange-500/5 group-hover:to-orange-500/10 transition-all duration-300"></div>
                        </button>
                        <button onclick="updateChartType('galeri')" id="btn-galeri" class="filter-btn group relative px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-white text-gray-700 shadow-sm hover:shadow-md hover:scale-105 border-2 border-gray-200 hover:border-pink-300 hover:text-pink-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Galeri</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-pink-500/0 to-pink-500/0 group-hover:from-pink-500/5 group-hover:to-pink-500/10 transition-all duration-300"></div>
                        </button>
                    </div>
                </div>

                <!-- Period Filter -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <label class="text-xs font-bold text-gray-700 mb-3 block uppercase tracking-wide items-center gap-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pilih Periode Waktu
                    </label>
                    <div class="flex flex-wrap gap-2.5">
                        <button onclick="updateChartPeriod('daily')" id="btn-daily" class="period-btn active group relative px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-primary to-red-600 text-white shadow-md hover:shadow-lg hover:scale-105 border-2 border-transparent">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Per Hari</span>
                                <span class="text-xs opacity-75">(7 Hari)</span>
                            </div>
                        </button>
                        <button onclick="updateChartPeriod('weekly')" id="btn-weekly" class="period-btn group relative px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-white text-gray-700 shadow-sm hover:shadow-md hover:scale-105 border-2 border-gray-200 hover:border-primary/50 hover:text-primary">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Per Minggu</span>
                                <span class="text-xs opacity-60">(8 Minggu)</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-primary/0 to-primary/0 group-hover:from-primary/5 group-hover:to-primary/10 transition-all duration-300"></div>
                        </button>
                        <button onclick="updateChartPeriod('monthly')" id="btn-monthly" class="period-btn group relative px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 bg-white text-gray-700 shadow-sm hover:shadow-md hover:scale-105 border-2 border-gray-200 hover:border-primary/50 hover:text-primary">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Per Bulan</span>
                                <span class="text-xs opacity-60">(6 Bulan)</span>
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-primary/0 to-primary/0 group-hover:from-primary/5 group-hover:to-primary/10 transition-all duration-300"></div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Chart Canvas -->
            <div class="relative" style="height: 320px;">
                <canvas id="distributionChart"></canvas>
            </div>

            <!-- Loading State -->
            <div id="chart-loading" class="absolute inset-0 bg-white bg-opacity-90 hidden items-center justify-center rounded-lg">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-3"></div>
                    <p class="text-sm text-gray-600">Memuat data...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Company Profile -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Aktivitas Terbaru (2 columns) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h3>
            </div>
            <div class="p-6">
                <!-- Latest Messages -->
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Pesan Terbaru
                    </h4>
                    <div class="space-y-3">
                        @forelse($recentMessages as $message)
                            <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-gray-100">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary to-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-semibold text-sm">{{ substr($message->nama, 0, 1) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800">{{ $message->nama }}</p>
                                    <p class="text-xs text-gray-600 truncate">{{ Str::limit($message->pesan ?? $message->subjek ?? 'No message', 60) }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-4 text-sm">Belum ada pesan</p>
                        @endforelse
                    </div>
                </div>

                <!-- Latest Testimonials -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Testimoni Terbaru
                    </h4>
                    <div class="space-y-3">
                        @forelse($recentTestimonials as $testimoni)
                            <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-gray-100">
                                @if($testimoni->foto)
                                    <img src="{{ asset('storage/' . $testimoni->foto) }}" alt="{{ $testimoni->nama_testimoni }}" class="w-10 h-10 rounded-full object-cover flex-shrink-0 border-2 border-red-200">
                                @else
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-semibold text-sm">{{ substr($testimoni->nama_testimoni, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-semibold text-gray-800">{{ $testimoni->nama_testimoni }}</p>
                                        <div class="flex items-center">
                                            @for($i = 0; $i < ($testimoni->rating ?? 5); $i++)
                                                <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-600 truncate">{{ Str::limit($testimoni->testimoni ?? $testimoni->isi ?? '', 60) }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $testimoni->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-4 text-sm">Belum ada testimoni</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Company Profile Info (1 column) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Info Perusahaan</h3>
            </div>
            <div class="p-6">
                @if($companyProfile)
                    <div class="space-y-4">
                        <div class="text-center mb-4">
                            @if($companyProfile->logo)
                                <img src="{{ asset('storage/' . $companyProfile->logo) }}" alt="Company Logo" class="w-20 h-20 mx-auto rounded-lg object-cover shadow-md">
                            @else
                                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-primary to-red-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-2xl">{{ substr($companyProfile->nama_perusahaan ?? 'C', 0, 1) }}</span>
                                </div>
                            @endif
                            <h4 class="font-bold text-gray-800 mt-3">{{ $companyProfile->nama_perusahaan ?? 'Nama Perusahaan' }}</h4>
                        </div>

                        <div class="space-y-3">
                            @if($companyProfile->email)
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500">Email</p>
                                        <p class="text-gray-800 font-medium truncate">{{ $companyProfile->email }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($companyProfile->telepon)
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500">Telepon</p>
                                        <p class="text-gray-800 font-medium">{{ $companyProfile->telepon }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($companyProfile->alamat)
                                <div class="flex items-start gap-3 text-sm">
                                    <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500">Alamat</p>
                                        <p class="text-gray-800 font-medium text-xs leading-relaxed">{{ Str::limit($companyProfile->alamat, 80) }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.konfigurasi.index') }}" class="block w-full text-center px-4 py-2.5 bg-primary hover:bg-red-700 text-white rounded-lg font-medium text-sm transition-colors">
                                Edit Profil Perusahaan
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <p class="text-gray-600 text-sm mb-4">Belum ada profil perusahaan</p>
                        <a href="{{ route('admin.konfigurasi.index') }}" class="inline-block px-6 py-2 bg-primary hover:bg-red-700 text-white rounded-lg font-medium text-sm transition-colors">
                            Tambah Profil
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-gradient-to-r from-primary to-red-600 rounded-xl shadow-lg p-6 text-white">
        <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.layanan.index') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-4 text-center transition-all hover:scale-105">
                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <p class="text-sm font-medium">Tambah Layanan</p>
            </a>
            <a href="{{ route('admin.client.index') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-4 text-center transition-all hover:scale-105">
                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <p class="text-sm font-medium">Tambah Client</p>
            </a>
            <a href="{{ route('admin.karyawan.index') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-4 text-center transition-all hover:scale-105">
                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <p class="text-sm font-medium">Tambah Karyawan</p>
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg p-4 text-center transition-all hover:scale-105">
                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <p class="text-sm font-medium">Tambah Galeri</p>
            </a>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        // Chart variables
        let chart = null;
        let currentType = 'all';
        let currentPeriod = 'daily';

        // Color schemes for each data type
        const colorSchemes = {
            layanan: { primary: '#3B82F6', gradient: 'rgba(59, 130, 246, 0.1)' },
            client: { primary: '#10B981', gradient: 'rgba(16, 185, 129, 0.1)' },
            karyawan: { primary: '#8B5CF6', gradient: 'rgba(139, 92, 246, 0.1)' },
            testimoni: { primary: '#F59E0B', gradient: 'rgba(245, 158, 11, 0.1)' },
            galeri: { primary: '#EC4899', gradient: 'rgba(236, 72, 153, 0.1)' }
        };

        // Initialize chart
        function initChart(labels, dataInput, type) {
            const ctx = document.getElementById('distributionChart');

            if (chart) {
                chart.destroy();
            }

            let datasets = [];

            // Check if dataInput is array of datasets (for 'all' type) or single data array
            if (type === 'all' && Array.isArray(dataInput) && dataInput.length > 0 && dataInput[0].label) {
                // Multiple datasets for "all" type
                datasets = dataInput.map(dataset => ({
                    label: dataset.label,
                    data: dataset.data,
                    borderColor: dataset.color,
                    backgroundColor: dataset.color + '20', // Add transparency
                    borderWidth: 3,
                    fill: false,
                    tension: 0.4,
                    pointBackgroundColor: dataset.color,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: dataset.color,
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }));
            } else {
                // Single dataset for specific type
                const colors = colorSchemes[type] || { primary: '#FD0103', gradient: 'rgba(253, 1, 3, 0.1)' };
                
                datasets = [{
                    label: 'Jumlah ' + type.charAt(0).toUpperCase() + type.slice(1),
                    data: dataInput,
                    borderColor: colors.primary,
                    backgroundColor: colors.gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: colors.primary,
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }];
            }

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    size: 12,
                                    family: "'Inter', sans-serif"
                                },
                                padding: 15,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: true,
                            boxWidth: 8,
                            boxHeight: 8,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    const label = context.dataset.label || '';
                                    const value = context.parsed.y;
                                    return label + ': ' + value + ' data';
                                },
                                title: function(tooltipItems) {
                                    // Show the date/period label
                                    return tooltipItems[0].label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Data',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            title: {
                                display: true,
                                text: 'Periode Waktu',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        // Load chart data from API
        async function loadChartData() {
            const loading = document.getElementById('chart-loading');
            loading.classList.remove('hidden');
            loading.classList.add('flex');

            try {
                const response = await fetch(`{{ route('admin.dashboard.chart-data') }}?type=${currentType}&period=${currentPeriod}`);
                const result = await response.json();
                
                // Check if result has datasets (for 'all' type) or just data
                if (result.datasets) {
                    initChart(result.labels, result.datasets, currentType);
                } else {
                    initChart(result.labels, result.data, currentType);
                }
            } catch (error) {
                console.error('Error loading chart data:', error);
                alert('Gagal memuat data chart. Silakan refresh halaman.');
            } finally {
                loading.classList.add('hidden');
                loading.classList.remove('flex');
            }
        }

        // Update chart type
        function updateChartType(type) {
            currentType = type;
            
            // Update button states
            document.querySelectorAll('.filter-btn').forEach(btn => {
                // Remove all active and color classes
                btn.classList.remove('active', 'bg-gradient-to-r', 'from-primary', 'to-red-600', 'from-blue-500', 'to-blue-600', 'from-green-500', 'to-green-600', 'from-purple-500', 'to-purple-600', 'from-orange-500', 'to-orange-600', 'from-pink-500', 'to-pink-600', 'text-white', 'shadow-lg', 'border-transparent');
                
                // Add inactive state
                btn.classList.add('bg-white', 'text-gray-700', 'shadow-sm', 'border-gray-200');
            });
            
            const activeBtn = document.getElementById(`btn-${type}`);
            
            // Remove inactive state from active button
            activeBtn.classList.remove('bg-white', 'text-gray-700', 'shadow-sm', 'border-gray-200');
            
            // Add active state based on type
            activeBtn.classList.add('active', 'text-white', 'shadow-lg', 'border-transparent');
            
            if (type === 'all') {
                activeBtn.classList.add('bg-gradient-to-r', 'from-primary', 'to-red-600');
            } else {
                const colorMap = {
                    layanan: ['from-blue-500', 'to-blue-600'],
                    client: ['from-green-500', 'to-green-600'],
                    karyawan: ['from-purple-500', 'to-purple-600'],
                    testimoni: ['from-orange-500', 'to-orange-600'],
                    galeri: ['from-pink-500', 'to-pink-600']
                };
                activeBtn.classList.add('bg-gradient-to-r', ...colorMap[type]);
            }
            
            loadChartData();
        }

        // Update chart period
        function updateChartPeriod(period) {
            currentPeriod = period;
            
            // Update button states
            document.querySelectorAll('.period-btn').forEach(btn => {
                // Remove active gradient classes
                btn.classList.remove('active', 'bg-gradient-to-r', 'from-primary', 'to-red-600', 'text-white', 'shadow-lg', 'border-transparent');
                
                // Add inactive state
                btn.classList.add('bg-white', 'text-gray-700', 'shadow-sm', 'border-gray-200');
            });
            
            const activeBtn = document.getElementById(`btn-${period}`);
            
            // Remove inactive state
            activeBtn.classList.remove('bg-white', 'text-gray-700', 'shadow-sm', 'border-gray-200');
            
            // Add active gradient state
            activeBtn.classList.add('active', 'bg-gradient-to-r', 'from-primary', 'to-red-600', 'text-white', 'shadow-lg', 'border-transparent');
            
            loadChartData();
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadChartData();
        });
    </script>

</x-layouts.app>
