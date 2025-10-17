<!-- Modal Hapus Testimoni -->
<div id="deleteTestimoniModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 backdrop-blur-sm">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white">
        <!-- Modal Header -->
        <div class="p-6 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Testimoni</h3>
            <p class="text-gray-600 mb-1">Apakah Anda yakin ingin menghapus testimoni:</p>
            <p id="deleteTestimoniName" class="text-lg font-bold text-gray-900 mb-4"></p>
            <p class="text-sm text-red-600 font-medium">⚠️ Tindakan ini tidak dapat dibatalkan!</p>
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-center gap-3 px-6 pb-6">
            <button type="button" onclick="closeDeleteTestimoniModal()" 
                class="flex-1 px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                Batal
            </button>
            <button type="button" onclick="submitDeleteTestimoni()" 
                class="flex-1 px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Hapus
            </button>
        </div>
    </div>
</div>
