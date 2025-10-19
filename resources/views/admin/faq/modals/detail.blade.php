<div id="detailModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div
        class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div
            class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-blue-500/10 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Detail FAQ</h3>
            </div>
            <button onclick="closeDetailModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="p-8">
            <!-- Loading -->
            <div id="detailLoading">
                <x-loading />
            </div>

            <!-- Detail Data -->
            <div id="detailData" class="hidden space-y-6">
                <!-- Header Card -->
                <div class="bg-gradient-to-r from-primary/10 to-red-700/10 rounded-xl p-6 border border-primary/20">
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-primary to-red-700 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Kode FAQ</label>
                            <p class="text-base font-mono font-bold text-gray-900" id="detail_kode"></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span id="detail_status_badge"></span>
                        <span class="text-xs text-gray-500">|</span>
                        <span class="text-xs text-gray-600">ID: <span id="detail_id"
                                class="font-semibold"></span></span>
                    </div>
                </div>

                <!-- Pertanyaan -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-500 mb-3">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pertanyaan
                    </label>
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-5 shadow-sm">
                        <p class="text-lg font-semibold text-gray-900 leading-relaxed" id="detail_pertanyaan">
                        </p>
                    </div>
                </div>

                <!-- Jawaban -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-500 mb-3">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Jawaban
                    </label>
                    <div
                        class="bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-lg p-6 shadow-sm">
                        <p class="text-base text-gray-800 leading-relaxed whitespace-pre-line" id="detail_jawaban"></p>
                    </div>
                </div>

                <!-- Meta Information -->
                <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Tanggal Dibuat</label>
                        <div class="flex items-center gap-2 text-gray-900">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-semibold" id="detail_created_at"></span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Terakhir Diperbarui</label>
                        <div class="flex items-center gap-2 text-gray-900">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-semibold" id="detail_updated_at"></span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                    <button onclick="closeDetailModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>