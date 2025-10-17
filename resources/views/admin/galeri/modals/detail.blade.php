<div id="detailGaleriModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
  <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
      <div class="flex items-center gap-3">
        <div class="bg-blue-500/10 p-2 rounded-lg">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Detail Galeri</h3>
      </div>
      <button onclick="closeDetailGaleriModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Content -->
    <div class="p-6">
      <div id="galeriDetailLoading" class="flex items-center justify-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
      </div>

      <div id="galeriDetailData" class="hidden">
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

          <!-- Judul -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Judul</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_judul"></p>
              </div>
            </div>
          </div>

          <!-- Kode Galeri -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Kode</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_kode_galeri"></p>
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

          <!-- Gambar -->
          <div class="space-y-2 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700">Gambar</label>
            <div class="flex items-center justify-center w-full bg-gray-50 border-2 border-gray-200 border-dashed rounded-lg p-4">
              <img id="detail_gambar" class="max-w-full h-auto max-h-64 object-contain rounded-lg" />
            </div>
          </div>

          <!-- Dibuat Pada -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Dibuat Pada</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-sm text-gray-900" id="detail_created_at"></p>
              </div>
            </div>
          </div>

          <!-- Terakhir Diubah -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Terakhir Diubah</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-sm text-gray-900" id="detail_updated_at"></p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="flex justify-end gap-3 px-6 pb-6 pt-4 border-t border-gray-200">
      <button onclick="closeDetailGaleriModal()" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">
        Tutup
      </button>
    </div>
  </div>
</div>
