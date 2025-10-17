<div id="createGaleriModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
  <div id="createGaleriModalContent" class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
      <div class="flex items-center gap-3">
        <div class="bg-primary/10 p-2 rounded-lg">
          <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Tambah Galeri Baru</h3>
      </div>
      <button onclick="closeCreateGaleriModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form Content -->
    <form id="createGaleriForm" onsubmit="submitCreateGaleri(event)" class="p-6" enctype="multipart/form-data">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Kategori -->
        <div class="space-y-2">
          <label for="create_kategori_id" class="block text-sm font-semibold text-gray-700">
            Kategori <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </div>
            <select id="create_kategori_id" name="kategori_id" required
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all appearance-none bg-white">
              <option value="" disabled selected>Pilih kategori</option>
              @foreach($kategoris as $k)
                <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>
          <span class="text-red-500 text-xs mt-1 hidden" id="error_create_galeri_kategori_id"></span>
        </div>

        <!-- Judul -->
        <div class="space-y-2">
          <label for="create_judul" class="block text-sm font-semibold text-gray-700">
            Judul <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </div>
            <input type="text" id="create_judul" name="judul"
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
              placeholder="Masukkan judul galeri">
          </div>
          <span class="text-red-500 text-xs mt-1 hidden" id="error_create_galeri_judul"></span>
        </div>

        <!-- Deskripsi -->
        <div class="space-y-2 md:col-span-2">
          <label for="create_deskripsi" class="block text-sm font-semibold text-gray-700">
            Deskripsi
          </label>
          <div class="relative">
            <div class="absolute top-3 left-3">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
              </svg>
            </div>
            <textarea id="create_deskripsi" name="deskripsi" rows="3"
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all resize-none"
              placeholder="Masukkan deskripsi galeri (opsional)"></textarea>
          </div>
          <span class="text-red-500 text-xs mt-1 hidden" id="error_create_galeri_deskripsi"></span>
        </div>

        <!-- Status -->
        <div class="space-y-2 md:col-span-2">
          <label for="create_status" class="block text-sm font-semibold text-gray-700">
            Status <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <select id="create_status" name="status"
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all appearance-none bg-white">
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>
          <span class="text-red-500 text-xs mt-1 hidden" id="error_create_galeri_status"></span>
        </div>

        <!-- Gambar -->
        <div class="space-y-2 md:col-span-2">
          <label for="create_galeri_gambar" class="block text-sm font-semibold text-gray-700">
            Gambar
          </label>
          <div class="relative">
            <div id="createGaleriUploadArea" class="flex items-center justify-center w-full">
              <label for="create_galeri_gambar" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                <div class="flex flex-col items-center justify-center pt-3 pb-3">
                  <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                  </svg>
                  <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                  <p class="text-xs text-gray-500">(PNG, JPG, GIF | MAX. 5MB)</p>
                </div>
                <input id="create_galeri_gambar" name="gambar" type="file" class="hidden" accept="image/*" onchange="previewGaleriImage(this)" />
              </label>
            </div>

            <div id="createGaleriPreviewArea" class="hidden w-full">
              <div class="relative bg-gray-50 rounded-lg p-3 border border-gray-200">
                <div class="flex items-center gap-4">
                  <div class="flex-shrink-0">
                    <img id="createGaleriImagePreview" class="w-16 h-16 object-cover rounded-lg border border-gray-200" src="" alt="Preview gambar">
                  </div>
                  <div class="flex-1 min-w-0">
                    <p id="createGaleriFileName" class="text-sm font-medium text-gray-900 truncate"></p>
                    <p id="createGaleriFileSize" class="text-xs text-gray-500"></p>
                  </div>
                  <div class="flex items-center gap-2 flex-shrink-0">
                    <button type="button" onclick="changeGaleriImage()" class="px-3 py-1 text-xs font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors">
                      Ganti
                    </button>
                    <button type="button" onclick="removeGaleriImage()" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                      Hapus
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <span class="text-red-500 text-xs mt-1 hidden" id="error_create_galeri_gambar"></span>
        </div>
      </div>

      <!-- Footer Buttons -->
      <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
        <button type="button" onclick="closeCreateGaleriModal()"
          class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
          Batal
        </button>
        <button type="submit" id="createGaleriSubmitBtn"
          class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-semibold flex items-center justify-center gap-2 flex-1 sm:flex-none">
          <svg id="createGaleriLoadingSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
              stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
          </svg>
          <span id="createGaleriSubmitBtnText">Simpan Galeri</span>
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function closeCreateGaleriModal() {
  const modal = document.getElementById('createGaleriModal');
  const modalContent = document.getElementById('createGaleriModalContent');

  modalContent.classList.add('scale-95', 'opacity-0');
  modalContent.classList.remove('scale-100', 'opacity-100');

  setTimeout(() => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }, 300);
}

function submitCreateGaleri(event) {
  event.preventDefault();
  // Logic untuk submit data galeri
  console.log('Form galeri submitted');
}

function previewGaleriImage(input) {
  if (input.files && input.files[0]) {
    const file = input.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
      document.getElementById('createGaleriUploadArea').classList.add('hidden');
      document.getElementById('createGaleriPreviewArea').classList.remove('hidden');
      
      document.getElementById('createGaleriImagePreview').src = e.target.result;
      document.getElementById('createGaleriFileName').textContent = file.name;
      document.getElementById('createGaleriFileSize').textContent = formatGaleriFileSize(file.size);
    }
    
    reader.readAsDataURL(file);
  }
}

function formatGaleriFileSize(bytes) {
  if (bytes === 0) return '0 Bytes';
  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB', 'GB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function changeGaleriImage() {
  document.getElementById('create_galeri_gambar').click();
}

function removeGaleriImage() {
  document.getElementById('create_galeri_gambar').value = '';
  
  document.getElementById('createGaleriPreviewArea').classList.add('hidden');
  document.getElementById('createGaleriUploadArea').classList.remove('hidden');
  
  document.getElementById('createGaleriImagePreview').src = '';
  document.getElementById('createGaleriFileName').textContent = '';
  document.getElementById('createGaleriFileSize').textContent = '';
}

document.addEventListener('DOMContentLoaded', function() {
  // Target label for drag/drop, memastikan elemennya ada sebelum listener ditambahkan
  const uploadLabel = document.querySelector('#createGaleriUploadArea label'); 
  const fileInput = document.getElementById('create_galeri_gambar');
  
  if (uploadLabel) {
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      uploadLabel.addEventListener(eventName, preventDefaults, false);
    });
    document.body.addEventListener('dragover', preventDefaults, false);
    document.body.addEventListener('drop', preventDefaults, false);
    
    // Highlight drop area when item is dragged over it
    uploadLabel.addEventListener('dragenter', highlight, false);
    uploadLabel.addEventListener('dragover', highlight, false);
    
    uploadLabel.addEventListener('dragleave', unhighlight, false);
    uploadLabel.addEventListener('drop', unhighlight, false);
    
    // Handle dropped files
    uploadLabel.addEventListener('drop', handleDrop, false);
  }
  
  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }
  
  function highlight() {
    uploadLabel.classList.add('border-primary', 'bg-primary/5');
  }
  
  function unhighlight() {
    uploadLabel.classList.remove('border-primary', 'bg-primary/5');
  }
  
  function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;
    previewGaleriImage(fileInput);
  }
});
</script>