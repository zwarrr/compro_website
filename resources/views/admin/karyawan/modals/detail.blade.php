<div id="detailKaryawanModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
  <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
      <div class="flex items-center gap-3">
        <div class="bg-blue-500/10 p-2 rounded-lg">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Detail Karyawan</h3>
      </div>
      <button onclick="closeDetailKaryawanModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Content -->
    <div class="p-6">
      <div id="karyawanDetailLoading" class="flex items-center justify-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
      </div>

      <div id="karyawanDetailData" class="hidden">
        <!-- Foto (dipindahkan ke atas) -->
        <div class="space-y-2 mb-6">
          <label class="block text-sm font-semibold text-gray-700">Foto</label>
          <div class="flex justify-center">
            <img id="detail_foto" class="max-h-[300px] rounded-lg border border-gray-200 shadow-sm object-contain" />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <!-- Kategori -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Kategori</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_kategori"></p>
              </div>
            </div>
          </div>

          <!-- Kode Karyawan -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Kode</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_kode_karyawan"></p>
              </div>
            </div>
          </div>

          <!-- Nama -->
          <div class="space-y-2 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700">Nama</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_nama"></p>
              </div>
            </div>
          </div>

          <!-- NIK -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">NIK</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_nik"></p>
              </div>
            </div>
          </div>

          <!-- Status -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Status</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_status"></p>
              </div>
            </div>
          </div>

          <!-- Deskripsi -->
          <div class="space-y-2 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
            <div class="relative">
              <div class="absolute top-3 left-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg min-h-[80px]">
                <p class="text-gray-800" id="detail_deskripsi"></p>
              </div>
            </div>
          </div>

          <!-- Timestamps -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Dibuat Pada</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_created_at"></p>
              </div>
            </div>
          </div>

          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Terakhir Diubah</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_updated_at"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="sticky bottom-0 z-10 flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-white rounded-b-2xl">
      <button onclick="closeDetailKaryawanModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">Tutup</button>
    </div>
  </div>
</div>
