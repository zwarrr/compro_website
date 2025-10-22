<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl transform transition-all duration-300 scale-95 opacity-0" id="modalDetailContent" onclick="event.stopPropagation()">
        <!-- Header Modal -->
        <div class="bg-white text-gray-800 p-6 rounded-t-2xl border-b-2 border-gray-200">
            <div class="flex justify-between items-center">
                <h2 id="modalJudul" class="text-2xl font-bold">Detail Galeri</h2>
                <button onclick="closeDetailModal()" class="text-gray-600 hover:text-gray-800 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Body Modal - 2 Columns Layout -->
        <div class="p-8">
            <div class="grid grid-cols-2 gap-6">
                
                <!-- Kolom Kiri - Image -->
                <div class="space-y-5">
                    <div class="bg-gray-50 rounded-xl overflow-hidden">
                        <img id="modalImage" src="" alt="Gallery" class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>

                <!-- Kolom Kanan - Details -->
                <div class="space-y-5">
                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <p id="modalDeskripsi" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-sm text-gray-700 leading-relaxed overflow-y-auto max-h-32">-</p>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <p id="modalKategori" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-sm text-gray-900 font-semibold">-</p>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                        <p id="modalTanggal" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-sm text-gray-900 font-semibold">-</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Detail Modal functionality
    function openDetailModal(data) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalDetailContent');
        
        document.getElementById('modalImage').src = data.gambar;
        document.getElementById('modalJudul').textContent = data.judul;
        document.getElementById('modalDeskripsi').textContent = data.deskripsi;
        document.getElementById('modalKategori').textContent = data.kategori;
        document.getElementById('modalTanggal').textContent = data.tanggal;
        
        // Tampilkan modal dengan animasi
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal(event) {
        // Jika ada event, pastikan modal diklik, bukan konten
        if (event && event.target.id !== 'detailModal') {
            return;
        }
        
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalDetailContent');
        
        // Animasi keluar
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
        
        // Enable body scroll
        document.body.style.overflow = 'auto';
    }

    // Close modal saat klik di luar modal
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('detailModal');
        if (event.target === modal) {
            closeDetailModal();
        }
    });

    // Close modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDetailModal();
        }
    });
</script>
