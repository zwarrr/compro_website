<script>
// ===========================
// MODAL MANAGEMENT FUNCTIONS
// ===========================

// Create Modal
function openCreateTestimoniModal() {
    const modal = document.getElementById('createTestimoniModal');
    const modalContent = document.getElementById('createTestimoniModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Trigger animation
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('createTestimoniForm').reset();
    clearErrors();
    
    // Hide image preview areas
    const uploadArea = document.getElementById('createTestimoniUploadArea');
    const previewArea = document.getElementById('createTestimoniPreviewArea');
    if (uploadArea) uploadArea.classList.remove('hidden');
    if (previewArea) previewArea.classList.add('hidden');
}

function closeCreateTestimoniModal() {
    const modal = document.getElementById('createTestimoniModal');
    const modalContent = document.getElementById('createTestimoniModalContent');

    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('createTestimoniForm').reset();
        clearErrors();
    }, 300);
}

// Detail Modal
function closeDetailTestimoniModal() {
    const modal = document.getElementById('detailTestimoniModal');
    const modalContent = document.getElementById('detailTestimoniModalContent');

    if (modalContent) {
        modalContent.classList.add('scale-95', 'opacity-0');
        modalContent.classList.remove('scale-100', 'opacity-100');
    }

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// Edit Modal
function closeEditTestimoniModal() {
    const modal = document.getElementById('editTestimoniModal');
    const modalContent = document.getElementById('editTestimoniModalContent');

    if (modalContent) {
        modalContent.classList.add('scale-95', 'opacity-0');
        modalContent.classList.remove('scale-100', 'opacity-100');
    }

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('editTestimoniForm').reset();
        clearErrors();
    }, 300);
}

// Delete Modal
function closeDeleteTestimoniModal() {
    document.getElementById('deleteTestimoniModal').classList.add('hidden');
}

// ===========================
// ERROR HANDLING FUNCTIONS
// ===========================

function clearErrors() {
    // Clear create form errors
    const createErrors = document.querySelectorAll('[id^="error-"]');
    createErrors.forEach(error => {
        error.classList.add('hidden');
        error.textContent = '';
    });

    // Remove error borders from inputs
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.classList.remove('border-red-500');
    });
}

function displayErrors(errors, prefix = '') {
    clearErrors();
    
    for (const [field, messages] of Object.entries(errors)) {
        const errorElement = document.getElementById(`error-${prefix}${field}`);
        const inputElement = document.getElementById(`${prefix}${field}`) || 
                            document.querySelector(`[name="${field}"]`);
        
        if (errorElement) {
            errorElement.textContent = messages[0];
            errorElement.classList.remove('hidden');
        }
        
        if (inputElement) {
            inputElement.classList.add('border-red-500');
        }
    }
}

// ===========================
// TOAST NOTIFICATION
// ===========================

function showNotification(message, type = 'success') {
    // Remove existing notification if any
    const existingNotification = document.getElementById('notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    // Create notification element
    const notification = document.createElement('div');
    notification.id = 'notification';
    notification.className = `fixed top-4 right-4 z-[9999] px-6 py-4 rounded-lg shadow-2xl transform transition-all duration-500 ease-out translate-x-0 ${
        type === 'success' 
            ? 'bg-green-500 text-white' 
            : 'bg-red-500 text-white'
    }`;
    
    notification.innerHTML = `
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' 
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />' 
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />'
                }
            </svg>
            <span class="font-medium">${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => {
            notification.remove();
        }, 500);
    }, 3000);
}

// ===========================
// CREATE TESTIMONI
// ===========================

document.getElementById('createTestimoniForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    
    // Disable button and show loading
    submitButton.disabled = true;
    submitButton.innerHTML = `
        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Menyimpan...
    `;
    
    try {
        const response = await fetch('{{ route("admin.testimoni.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (response.ok) {
            closeCreateTestimoniModal();
            showNotification(data.message || 'Testimoni berhasil ditambahkan!', 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            if (data.errors) {
                displayErrors(data.errors);
            }
            showNotification(data.message || 'Gagal menambahkan testimoni', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menambahkan testimoni', 'error');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    }
});

// ===========================
// SHOW DETAIL TESTIMONI
// ===========================

async function showTestimoniDetail(id) {
    try {
        const response = await fetch(`/admin/testimoni/${id}`);
        const data = await response.json();
        
        if (response.ok && data.success) {
            const testimoni = data.data;
            
            // Populate modal with data
            document.getElementById('detail_kode_testimoni').textContent = testimoni.kode_testimoni;
            document.getElementById('detail_nama_testimoni').textContent = testimoni.nama_testimoni;
            document.getElementById('detail_jabatan').textContent = testimoni.jabatan;
            document.getElementById('detail_pesan').textContent = testimoni.pesan;
            
            // Rating stars
            const ratingContainer = document.getElementById('detail_rating');
            ratingContainer.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const starClass = i <= testimoni.rating ? 'text-yellow-400' : 'text-gray-300';
                ratingContainer.innerHTML += `
                    <svg class="w-5 h-5 ${starClass}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                `;
            }
            
            // Status badge
            const statusBadge = testimoni.status === 'aktif' 
                ? '<span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-bold">AKTIF</span>'
                : '<span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-bold">NONAKTIF</span>';
            document.getElementById('detail_status').innerHTML = statusBadge;
            
            // Created at
            document.getElementById('detail_created_at').textContent = new Date(testimoni.created_at).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            
            // Photo
            const fotoElement = document.getElementById('detail_foto');
            if (testimoni.foto_url) {
                fotoElement.src = testimoni.foto_url;
            } else {
                fotoElement.src = 'https://via.placeholder.com/150?text=No+Image';
            }
            
            // Show modal with animation
            const modal = document.getElementById('detailTestimoniModal');
            const modalContent = document.getElementById('detailTestimoniModalContent');
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            showNotification('Gagal memuat detail testimoni', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat memuat detail', 'error');
    }
}

// ===========================
// OPEN EDIT MODAL
// ===========================

async function openEditTestimoniModal(id) {
    clearErrors();
    
    try {
        const response = await fetch(`/admin/testimoni/${id}/edit`);
        const data = await response.json();
        
        if (response.ok && data.success) {
            const testimoni = data.data;
            
            // Populate form
            document.getElementById('edit_id_testimoni').value = testimoni.id_testimoni;
            document.getElementById('edit_nama_testimoni').value = testimoni.nama_testimoni;
            document.getElementById('edit_jabatan').value = testimoni.jabatan;
            document.getElementById('edit_pesan').value = testimoni.pesan;
            document.getElementById('edit_rating').value = testimoni.rating;
            document.getElementById('edit_status').value = testimoni.status;
            
            // Show current photo
            const previewImg = document.getElementById('editPreviewImg');
            const uploadArea = document.getElementById('editTestimoniUploadArea');
            const previewArea = document.getElementById('editTestimoniPreviewArea');
            
            if (testimoni.foto_url) {
                previewImg.src = testimoni.foto_url;
                uploadArea.classList.add('hidden');
                previewArea.classList.remove('hidden');
                
                // Set file info for existing photo
                const fileName = testimoni.foto_url.split('/').pop();
                document.getElementById('editTestimoniFileName').textContent = 'Foto saat ini: ' + fileName;
                document.getElementById('editTestimoniFileSize').textContent = 'Klik "Ganti" untuk mengganti foto';
            } else {
                previewImg.src = '';
                uploadArea.classList.remove('hidden');
                previewArea.classList.add('hidden');
            }
            
            // Show modal with animation
            const modal = document.getElementById('editTestimoniModal');
            const modalContent = document.getElementById('editTestimoniModalContent');
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            showNotification('Gagal memuat data testimoni', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat memuat data', 'error');
    }
}

// ===========================
// UPDATE TESTIMONI
// ===========================

document.getElementById('editTestimoniForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors();
    
    const formData = new FormData(this);
    const id = document.getElementById('edit_id_testimoni').value;
    const submitButton = this.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    
    // Disable button and show loading
    submitButton.disabled = true;
    submitButton.innerHTML = `
        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Menyimpan...
    `;
    
    try {
        const response = await fetch(`/admin/testimoni/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (response.ok) {
            closeEditTestimoniModal();
            showNotification(data.message || 'Testimoni berhasil diperbarui!', 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            if (data.errors) {
                displayErrors(data.errors, 'edit-');
            }
            showNotification(data.message || 'Gagal memperbarui testimoni', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat memperbarui testimoni', 'error');
    } finally {
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    }
});

// ===========================
// DELETE TESTIMONI
// ===========================

let deleteTestimoniId = null;

function confirmDeleteTestimoni(id, name) {
    deleteTestimoniId = id;
    document.getElementById('deleteTestimoniName').textContent = name;
    document.getElementById('deleteTestimoniModal').classList.remove('hidden');
}

async function submitDeleteTestimoni() {
    if (!deleteTestimoniId) return;
    
    try {
        const response = await fetch(`/admin/testimoni/${deleteTestimoniId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (response.ok) {
            closeDeleteTestimoniModal();
            showNotification(data.message || 'Testimoni berhasil dihapus!', 'success');
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showNotification(data.message || 'Gagal menghapus testimoni', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat menghapus testimoni', 'error');
    }
}

// ===========================
// CLOSE MODAL ON ESC KEY
// ===========================

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeCreateTestimoniModal();
        closeDetailTestimoniModal();
        closeEditTestimoniModal();
        closeDeleteTestimoniModal();
    }
});

// ===========================
// CLOSE MODAL ON BACKDROP CLICK
// ===========================

document.addEventListener('click', function(event) {
    if (event.target.id === 'createTestimoniModal') {
        closeCreateTestimoniModal();
    }
    if (event.target.id === 'detailTestimoniModal') {
        closeDetailTestimoniModal();
    }
    if (event.target.id === 'editTestimoniModal') {
        closeEditTestimoniModal();
    }
    if (event.target.id === 'deleteTestimoniModal') {
        closeDeleteTestimoniModal();
    }
});
</script>
