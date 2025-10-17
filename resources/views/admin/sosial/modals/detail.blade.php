<div id="detailSosmedModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
  <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
      <div class="flex items-center gap-3">
        <div class="bg-blue-500/10 p-2 rounded-lg">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Detail Sosial Media</h3>
      </div>
      <button onclick="closeDetailSosmedModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Content -->
    <div class="p-6">
      <div id="sosmedDetailLoading" class="flex items-center justify-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
      </div>

      <div id="sosmedDetailData" class="hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <!-- Kode Sosial -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Kode</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_kode_sosial"></p>
              </div>
            </div>
          </div>

          <!-- Nama Sosmed -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Nama Sosial Media</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_nama_sosmed"></p>
              </div>
            </div>
          </div>

          <!-- Username -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Username</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-gray-900 font-medium" id="detail_username"></p>
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

          <!-- URL -->
          <div class="space-y-2 md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700">URL</label>
            <div class="relative">
              <div class="absolute top-3 left-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <a id="detail_url" href="" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline break-all"></a>
              </div>
            </div>
          </div>

          <!-- Icon -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Icon</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-2xl" id="detail_icon"></p>
              </div>
            </div>
          </div>

          <!-- Warna -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Warna</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
              </div>
              <div class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg flex items-center gap-3">
                <div id="detail_warna_box" class="w-8 h-8 rounded-lg border-2 border-gray-300"></div>
                <p class="text-gray-900 font-medium" id="detail_warna"></p>
              </div>
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
      <button onclick="closeDetailSosmedModal()" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">
        Tutup
      </button>
    </div>
  </div>
</div>
