<div id="deleteModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-500 to-red-600 rounded-t-xl">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-lg backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white">Konfirmasi Hapus</h3>
            </div>
            <button onclick="closeDeleteModal()"
                class="text-white hover:bg-white/20 transition-colors rounded-full p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="p-8">
            <div class="flex flex-col items-center text-center">
                <!-- Warning Icon -->
                <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>

                <h4 class="text-xl font-bold text-gray-900 mb-2">Hapus FAQ Ini?</h4>
                <p class="text-gray-600 mb-4">Anda akan menghapus pertanyaan:</p>
                
                <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-lg p-4 w-full mb-6 border border-red-200">
                    <p class="font-semibold text-gray-900 text-base line-clamp-2" id="delete_pertanyaan"></p>
                </div>

                <div class="flex items-center gap-2 text-sm text-red-600 font-medium bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Data yang dihapus tidak dapat dikembalikan!
                </div>
            </div>

            <!-- Form -->
            <form id="deleteFaqForm" class="mt-8">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_id_faq" name="id_faq">

                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
