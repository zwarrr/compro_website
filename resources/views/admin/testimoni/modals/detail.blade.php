<!-- Modal Detail Testimoni -->
<div id="detailTestimoniModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div id="detailTestimoniModalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        
        <!-- Modal Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Detail Testimoni</h3>
            </div>
            <button onclick="closeDetailTestimoniModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <!-- Testimoni Card Style -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border-2 border-gray-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary to-red-700 h-24 relative">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="absolute top-4 left-6">
                        <svg class="w-10 h-10 text-white/40" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                        </svg>
                    </div>
                </div>

                <!-- Photo Section -->
                <div class="relative -mt-16 flex justify-center px-6">
                    <div class="relative">
                        <img id="detail_foto" src="" alt="Foto Testimoni" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl ring-4 ring-gray-200">
                    </div>
                </div>

                <!-- Content -->
                <div class="px-6 pb-6 text-center">
                    <!-- Kode Testimoni Badge -->
                    <div class="mb-4 mt-4">
                        <span id="detail_kode_testimoni" class="inline-block px-4 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm font-mono font-semibold"></span>
                    </div>

                    <!-- Name -->
                    <h3 id="detail_nama_testimoni" class="text-2xl font-bold text-gray-900 mb-2"></h3>
                    
                    <!-- Jabatan -->
                    <p id="detail_jabatan" class="text-base text-gray-600 mb-4"></p>

                    <!-- Rating -->
                    <div class="flex justify-center items-center gap-1 mb-6">
                        <div id="detail_rating" class="flex gap-1"></div>
                    </div>

                    <!-- Pesan Testimoni -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200 mb-6 shadow-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                            </svg>
                            <p id="detail_pesan" class="text-left text-gray-700 leading-relaxed italic"></p>
                        </div>
                    </div>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 gap-4 text-left">
                        <!-- Status -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase">Status</span>
                            </div>
                            <span id="detail_status" class="text-sm font-bold"></span>
                        </div>

                        <!-- Tanggal Dibuat -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-semibold text-gray-500 uppercase">Tanggal</span>
                            </div>
                            <span id="detail_created_at" class="text-sm font-medium text-gray-700"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex flex-col sm:flex-row justify-end gap-3 px-6 pb-6 border-t border-gray-200 pt-6">
            <button type="button" onclick="closeDetailTestimoniModal()" 
                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function closeDetailTestimoniModal() {
    const modal = document.getElementById('detailTestimoniModal');
    const modalContent = document.getElementById('detailTestimoniModalContent');

    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}
</script>
