<div id="editSosmedModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
  <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
      <div class="flex items-center gap-3">
        <div class="bg-amber-600/10 p-2 rounded-lg">
          <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Edit Sosial Media</h3>
      </div>
      <button onclick="closeEditSosmedModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form Content -->
    <form id="editSosmedForm" onsubmit="submitEditSosmed(event)" class="p-6">
      <input type="hidden" id="edit_sosmed_id" name="id">

      <div id="sosmedEditLoading" class="flex items-center justify-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-amber-600"></div>
      </div>

      <div id="editSosmedFormContent" class="hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

          <!-- Nama Sosmed -->
          <div class="space-y-2">
            <label for="edit_nama_sosmed" class="block text-sm font-semibold text-gray-700">
              Nama Sosial Media <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
              </div>
              <input type="text" id="edit_nama_sosmed" name="nama_sosmed"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                placeholder="Masukkan nama sosmed">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_sosmed_nama_sosmed"></span>
          </div>

          <!-- Username -->
          <div class="space-y-2">
            <label for="edit_username" class="block text-sm font-semibold text-gray-700">
              Username
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <input type="text" id="edit_username" name="username"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                placeholder="@username">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_sosmed_username"></span>
          </div>

          <!-- URL -->
          <div class="space-y-2 md:col-span-2">
            <label for="edit_url" class="block text-sm font-semibold text-gray-700">
              URL <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
              </div>
              <input type="url" id="edit_url" name="url"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                placeholder="https://instagram.com/username">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_sosmed_url"></span>
          </div>

          <!-- Icon -->
          <div class="space-y-2">
            <label for="edit_icon" class="block text-sm font-semibold text-gray-700">
              Icon (Emoji/Class)
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <input type="text" id="edit_icon" name="icon"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                placeholder="📱 atau fa-instagram">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_sosmed_icon"></span>
          </div>

          <!-- Warna -->
          <div class="space-y-2">
            <label for="edit_warna" class="block text-sm font-semibold text-gray-700">
              Warna (Hex)
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
              </div>
              <input type="text" id="edit_warna" name="warna"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                placeholder="#E1306C">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_sosmed_warna"></span>
          </div>

          <!-- Status -->
          <div class="space-y-2 md:col-span-2">
            <label for="edit_status" class="block text-sm font-semibold text-gray-700">
              Status <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <select id="edit_status" name="status"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all appearance-none bg-white">
                <option value="publik">Publik</option>
                <option value="draft">Draft</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_sosmed_status"></span>
          </div>

        </div>

        <!-- Footer Buttons -->
        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
          <button type="button" onclick="closeEditSosmedModal()"
            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
            Batal
          </button>
          <button type="submit" id="editSosmedSubmitBtn"
            class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-semibold flex items-center justify-center gap-2 flex-1 sm:flex-none">
            <svg id="editSosmedLoadingSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
            </svg>
            <span id="editSosmedSubmitBtnText">Update Sosial Media</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
