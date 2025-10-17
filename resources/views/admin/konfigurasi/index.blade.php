<x-layouts.app>
    <x-slot name="title">Konfigurasi Perusahaan</x-slot>

    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Konfigurasi Perusahaan</h1>
                <p class="text-base text-gray-600 mt-2">Kelola profil perusahaan Anda dengan mudah dan profesional</p>
            </div>
            <div id="headerActions" class="flex items-center gap-4">
                @if(isset($profile))
                    <span id="lastUpdated" class="hidden lg:flex items-center gap-2 text-sm text-gray-500 bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Terakhir diperbarui: {{ $profile->updated_at?->format('d M Y, H:i') }}
                    </span>
                    <button onclick="openEditProfileModal()"
                        class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 flex items-center gap-2 text-sm font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Profil
                    </button>
                @else
                    <button onclick="openCreateProfileModal()"
                        class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 flex items-center gap-2 text-sm font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Buat Profil
                    </button>
                @endif
            </div>
        </div>
    </x-slot>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="mt-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 text-sm font-medium flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Content -->
    <div id="profileContent" class="mt-6">
    @if(!isset($profile))
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl border-2 border-dashed border-gray-300 p-16 text-center">
            <div class="mx-auto w-24 h-24 rounded-2xl bg-gradient-to-br from-red-50 to-red-100 flex items-center justify-center mb-6 shadow-lg">
                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Profil Perusahaan Belum Dibuat</h3>
            <p class="text-base text-gray-600 mb-8 max-w-md mx-auto">Mulai dengan membuat profil perusahaan untuk menampilkan informasi lengkap di website Anda</p>
            <button onclick="openCreateProfileModal()"
                class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 text-base font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Buat Profil Sekarang
            </button>
        </div>
    @else
        <!-- Profile Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            
            <!-- Informasi Umum -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                <div class="px-6 py-5 bg-gradient-to-r from-red-600 to-red-700 flex items-center gap-3">
                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Informasi Umum</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-red-50 to-red-100 group-hover:from-red-100 group-hover:to-red-200 transition-all duration-300">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Kode Profil</p>
                            <p class="text-base font-bold text-gray-900">{{ $profile->kode_profile }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-red-50 to-red-100 group-hover:from-red-100 group-hover:to-red-200 transition-all duration-300">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Nama Perusahaan</p>
                            <p class="text-base font-bold text-gray-900">{{ $profile->nama_perusahaan }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-red-50 to-red-100 group-hover:from-red-100 group-hover:to-red-200 transition-all duration-300">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Slogan</p>
                            <p class="text-base font-bold text-gray-900">{{ $profile->slogan ?: '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 flex items-center justify-end gap-3">
                    <button onclick="openDetailProfileModal()" 
                        class="px-5 py-2.5 text-sm font-semibold bg-white text-red-600 border-2 border-red-600 rounded-xl hover:bg-red-50 transition-all duration-300">
                        Detail
                    </button>
                    <button onclick="openEditProfileModal()" 
                        class="px-5 py-2.5 text-sm font-semibold bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 shadow-lg shadow-red-500/30">
                        Edit
                    </button>
                </div>
            </div>

            <!-- Konten Perusahaan -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                <div class="px-6 py-5 bg-gradient-to-r from-red-600 to-red-700 flex items-center gap-3">
                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Konten Perusahaan</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-5 border border-red-200">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            <p class="text-sm font-bold text-red-900">Deskripsi Perusahaan</p>
                        </div>
                        <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $profile->deskripsi }}</p>
                    </div>
                    <div class="grid grid-cols-1 gap-5">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5 border border-gray-200">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <p class="text-sm font-bold text-gray-900">Visi</p>
                            </div>
                            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $profile->visi ?: '-' }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5 border border-gray-200">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <p class="text-sm font-bold text-gray-900">Misi</p>
                            </div>
                            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $profile->misi ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontak & Alamat -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                <div class="px-6 py-5 bg-gradient-to-r from-red-600 to-red-700 flex items-center gap-3">
                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Kontak & Alamat</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-red-50 to-red-100 group-hover:from-red-100 group-hover:to-red-200 transition-all duration-300 flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Alamat</p>
                            <p class="text-sm font-semibold text-gray-900 leading-relaxed whitespace-pre-line">{{ $profile->alamat ?: '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-red-50 to-red-100 group-hover:from-red-100 group-hover:to-red-200 transition-all duration-300 flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Telepon</p>
                            <p class="text-base font-bold text-gray-900">{{ $profile->telepon ?: '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-br from-red-50 to-red-100 group-hover:from-red-100 group-hover:to-red-200 transition-all duration-300 flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500 mb-1">Email</p>
                            <p class="text-base font-bold text-gray-900 break-all">{{ $profile->email ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>

    <!-- Include Modals -->
    @include('admin.konfigurasi.modals.create')
    @include('admin.konfigurasi.modals.detail')
    @include('admin.konfigurasi.modals.edit')

    <!-- Include Scripts -->
    @include('admin.konfigurasi.scripts')

</x-layouts.app>