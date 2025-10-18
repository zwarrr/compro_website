<style>
  @keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
  }

  @keyframes slideUp {
    0% { opacity: 0; transform: translateY(30px); }
    100% { opacity: 1; transform: translateY(0); }
  }

  @keyframes pulse-icon {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }

  .modal-backdrop-fade {
    animation: fadeIn 0.4s ease-out;
  }

  .modal-slideup {
    animation: slideUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  .pulse-icon {
    animation: pulse-icon 2s ease-in-out infinite;
  }
</style>

<!-- Info Modal -->
<div id="infoModal" class="hidden fixed inset-0 bg-gradient-to-br from-black/40 to-black/60 flex items-center justify-center z-[99999] modal-backdrop-fade backdrop-blur-sm" style="display: none;" onclick="if(event.target === this) { closeInfoModal(); }">
  <div class="bg-white rounded-2xl shadow-2xl max-w-sm mx-4 modal-slideup overflow-hidden" onclick="event.stopPropagation();">
    
    <!-- Header dengan icon -->
    <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-center">
      <div class="bg-red-100 p-3 rounded-full pulse-icon">
        <svg class="w-6 h-6 text-[#FD0103]" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
      </div>
      <div class="ml-3">
        <h3 class="text-base font-bold text-gray-900">Pesan Kosong</h3>
      </div>
    </div>

    <!-- Body -->
    <div class="px-8 py-6">
      <p class="text-sm text-gray-600 leading-relaxed mb-4">
        Silakan ketik pesan Anda terlebih dahulu sebelum mengirim.
      </p>
      
      <!-- Tips box -->
      <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
        <p class="text-xs text-gray-700 font-medium">Tip: Tanyakan tentang layanan, kontak, atau informasi TMS lainnya.</p>
      </div>
    </div>

    <!-- Footer dengan button -->
    <div class="px-8 py-4 bg-white border-t border-gray-100 flex gap-3">
      <button 
        type="button" 
        class="flex-1 bg-[#FD0103] text-white px-6 py-2.5 rounded-lg text-sm font-semibold cursor-pointer transition-all duration-300 hover:bg-red-600 hover:shadow-lg hover:shadow-red-200 active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2" 
        onclick="closeInfoModal();">
        OK
      </button>
    </div>
  </div>
</div>

<script>
  // Open Info Modal
  function openInfoModal() {
    const infoModal = document.getElementById('infoModal');
    if (infoModal) {
      infoModal.style.display = 'flex';
    }
  }

  // Close Info Modal
  function closeInfoModal() {
    const infoModal = document.getElementById('infoModal');
    if (infoModal) {
      infoModal.style.display = 'none';
    }
  }
</script>
