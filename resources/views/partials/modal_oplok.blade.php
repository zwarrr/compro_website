<!-- Modal Lamaran Kerja -->
<div id="modalLamaran" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
    <!-- Header Modal -->
    <div class="bg-white text-gray-800 p-6 rounded-t-2xl border-b-2 border-gray-200">
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold" id="modalTitle">Formulir Lamaran</h1>
        <button onclick="closeModalLamaran()" class="text-gray-600 hover:text-gray-800 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Body Modal - 2 Columns Layout -->
    <div class="p-8">
      <form id="formLamaran">
        <div class="grid grid-cols-2 gap-6">
          
          <!-- Kolom Kiri -->
          <div class="space-y-5">
            <!-- Nama Lengkap -->
            <div>
              <label for="namaLengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                Nama Lengkap <span class="text-red-600">*</span>
              </label>
              <input 
                type="text" 
                id="namaLengkap" 
                name="namaLengkap" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 outline-none"
                placeholder="Masukkan nama lengkap Anda"
              >
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                Email <span class="text-red-600">*</span>
              </label>
              <input 
                type="email" 
                id="email" 
                name="email" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 outline-none"
                placeholder="contoh@email.com"
              >
            </div>

            <!-- Resume/CV -->
            <div>
              <label for="resume" class="block text-sm font-semibold text-gray-700 mb-2">
                Resume/CV <span class="text-red-600">*</span>
              </label>
              <div class="relative">
                <input 
                  type="file" 
                  id="resume" 
                  name="resume" 
                  required
                  accept=".pdf,.doc,.docx"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 file:cursor-pointer"
                >
              </div>
              <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX (Max. 5MB)</p>
            </div>
          </div>

          <!-- Kolom Kanan -->
          <div class="space-y-5">
            <!-- Deskripsi -->
            <div class="h-full flex flex-col">
              <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                Deskripsi Diri <span class="text-red-600">*</span>
              </label>
              <textarea 
                id="deskripsi" 
                name="deskripsi" 
                required
                rows="9"
                class="w-full flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 outline-none resize-none"
                placeholder="Ceritakan tentang diri Anda, pengalaman, dan mengapa Anda tertarik dengan posisi ini..."
              ></textarea>
              <p class="text-xs text-gray-500 mt-1">Minimal 100 karakter</p>
            </div>
          </div>

        </div>

        <!-- Button Actions -->
        <div class="flex gap-3 pt-6 mt-6 border-t border-gray-200">
          <button
            type="button"
            onclick="closeModalLamaran()"
            class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200"
          >
            Batal
          </button>
          <button
            type="submit"
            class="relative flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg shadow-md
                   hover:shadow-2xl hover:from-red-700 hover:to-red-800 transition duration-300 ease-in-out
                   overflow-hidden hover:-translate-y-1 active:translate-y-0 before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white/20 before:transition-all before:duration-500 hover:before:left-full"
          >
            Kirim Lamaran
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Sukses -->
<div id="modalSukses" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center transform transition-all duration-300 scale-95 opacity-0" id="modalSuksesContent">
    <div class="mb-4">
      <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
      </div>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-2">Lamaran Terkirim!</h3>
    <p class="text-gray-600 mb-6">Terima kasih telah melamar. Tim HRD kami akan meninjau lamaran Anda dan menghubungi Anda segera.</p>
    <button
      onclick="closeModalSukses()"
      class="relative w-full px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg shadow-md
             hover:shadow-2xl hover:from-red-700 hover:to-red-800 transition duration-300 ease-in-out
             overflow-hidden hover:-translate-y-1 active:translate-y-0 before:content-[''] before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-white/20 before:transition-all before:duration-500 hover:before:left-full"
    >
      Tutup
    </button>
  </div>
</div>

<script>
  let currentJobTitle = '';

  // Fungsi untuk membuka modal lamaran
  function openModalLamaran(jobTitle) {
    currentJobTitle = jobTitle;
    const modal = document.getElementById('modalLamaran');
    const modalContent = document.getElementById('modalContent');
    const modalTitle = document.getElementById('modalTitle');
    
    // Set judul sesuai posisi
    modalTitle.textContent = `Formulir Lamaran ${jobTitle}`;
    
    // Tampilkan modal dengan animasi
    modal.classList.remove('hidden');
    setTimeout(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
  }

  // Fungsi untuk menutup modal lamaran
  function closeModalLamaran() {
    const modal = document.getElementById('modalLamaran');
    const modalContent = document.getElementById('modalContent');
    
    // Animasi keluar
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
      modal.classList.add('hidden');
      document.getElementById('formLamaran').reset();
    }, 300);
    
    // Enable body scroll
    document.body.style.overflow = 'auto';
  }

  // Fungsi untuk membuka modal sukses
  function openModalSukses() {
    const modal = document.getElementById('modalSukses');
    const modalContent = document.getElementById('modalSuksesContent');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
  }

  // Fungsi untuk menutup modal sukses
  function closeModalSukses() {
    const modal = document.getElementById('modalSukses');
    const modalContent = document.getElementById('modalSuksesContent');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
      modal.classList.add('hidden');
    }, 300);
    
    document.body.style.overflow = 'auto';
  }

  // Handle form submit
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formLamaran');
    
    if (form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi file size
        const fileInput = document.getElementById('resume');
        const file = fileInput.files[0];
        
        if (file && file.size > 5 * 1024 * 1024) { // 5MB
          alert('Ukuran file terlalu besar! Maksimal 5MB.');
          return;
        }
        
        // Validasi deskripsi minimal 100 karakter
        const deskripsi = document.getElementById('deskripsi').value;
        if (deskripsi.length < 100) {
          alert('Deskripsi minimal 100 karakter!');
          return;
        }
        
        // Simulasi pengiriman (bisa diganti dengan AJAX request ke server)
        console.log('Form submitted:', {
          namaLengkap: document.getElementById('namaLengkap').value,
          email: document.getElementById('email').value,
          resume: file ? file.name : '',
          deskripsi: deskripsi,
          posisi: currentJobTitle
        });
        
        // Tutup modal form
        closeModalLamaran();
        
        // Tampilkan modal sukses
        setTimeout(() => {
          openModalSukses();
        }, 400);
      });
    }
  });

  // Close modal saat klik di luar modal
  document.addEventListener('click', function(event) {
    const modalLamaran = document.getElementById('modalLamaran');
    const modalSukses = document.getElementById('modalSukses');
    
    if (event.target === modalLamaran) {
      closeModalLamaran();
    }
    
    if (event.target === modalSukses) {
      closeModalSukses();
    }
  });

  // Close modal dengan tombol ESC
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      closeModalLamaran();
      closeModalSukses();
    }
  });
</script>
