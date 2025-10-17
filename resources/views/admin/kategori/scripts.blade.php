<script>
// =====================================================
// MODAL MANAGEMENT FUNCTIONS
// =====================================================

function openCreateModal() {
    const modal = document.getElementById('createModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('createKategoriForm').reset();
    clearErrors('create');
}

function closeCreateModal() {
    const modal = document.getElementById('createModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

async function showDetail(kategoriId) {
    const modal = document.getElementById('detailModal');
    const modalContent = modal.querySelector('.modal-content');
    const loadingEl = document.getElementById('detailLoading');
    const dataEl = document.getElementById('detailData');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    loadingEl.classList.remove('hidden');
    dataEl.classList.add('hidden');
    
    try {
        const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const kategori = result.kategori;
        
        document.getElementById('detail_id').textContent = kategori.id_kategori;
        document.getElementById('detail_kode').textContent = kategori.kode_kategori;
        document.getElementById('detail_nama_kategori').textContent = kategori.nama_kategori;
        document.getElementById('detail_tipe').textContent = kategori.tipe;
        document.getElementById('detail_created_at').textContent = kategori.created_at_formatted;
        document.getElementById('detail_updated_at').textContent = kategori.updated_at_formatted;
        
        loadingEl.classList.add('hidden');
        dataEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data kategori', 'error');
        closeDetailModal();
    }
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

async function openEditModal(kategoriId) {
    const modal = document.getElementById('editModal');
    const modalContent = modal.querySelector('.modal-content');
    const loadingEl = document.getElementById('editLoading');
    const formEl = document.getElementById('editFormContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    loadingEl.classList.remove('hidden');
    formEl.classList.add('hidden');
    clearErrors('edit');
    
    try {
        const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const kategori = result.kategori;
        
        document.getElementById('edit_id').value = kategori.id_kategori;
        document.getElementById('edit_nama_kategori').value = kategori.nama_kategori;
        document.getElementById('edit_tipe').value = kategori.tipe;
        
        loadingEl.classList.add('hidden');
        formEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data kategori', 'error');
        closeEditModal();
    }
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

function confirmDelete(kategoriId, kategoriName) {
    const modal = document.getElementById('deleteModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('delete_kategori_id').value = kategoriId;
    document.getElementById('delete_kategori_name').textContent = kategoriName;
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// =====================================================
// FORM SUBMISSION FUNCTIONS
// =====================================================

async function submitCreate(event) {
    event.preventDefault();
    
    const form = document.getElementById('createKategoriForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const formData = new FormData(form);
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...';
    
    clearErrors('create');
    
    try {
        const response = await fetch('{{ route('admin.kategori.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const result = await response.json();
        
        if (response.ok) {
            showNotification(result.message || 'Kategori berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('create', result.errors);
            }
            showNotification(result.message || 'Gagal menambahkan kategori', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Simpan Kategori';
    }
}

async function submitEdit(event) {
    event.preventDefault();
    
    const form = document.getElementById('editKategoriForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const kategoriId = document.getElementById('edit_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengupdate...';
    
    clearErrors('edit');
    
    try {
        const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const result = await response.json();
        
        if (response.ok) {
            showNotification(result.message || 'Kategori berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate kategori', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Update Kategori';
    }
}

async function submitDelete(event) {
    event.preventDefault();
    
    const submitBtn = document.getElementById('deleteSubmitBtn');
    const kategoriId = document.getElementById('delete_kategori_id').value;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';
    
    try {
        const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                _method: 'DELETE'
            })
        });
        
        const result = await response.json();
        
        if (response.ok) {
            showNotification(result.message || 'Kategori berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus kategori', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Ya, Hapus';
    }
}

// =====================================================
// HELPER FUNCTIONS
// =====================================================

function clearErrors(prefix) {
    const errorElements = document.querySelectorAll(`[id^="error_${prefix}_"]`);
    errorElements.forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
}

function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_${prefix}_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
        }
    }
}

function showNotification(message, type = 'success') {
    const existing = document.getElementById('notification');
    if (existing) existing.remove();
    
    const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
    const icon = type === 'success' 
        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
    
    const notification = document.createElement('div');
    notification.id = 'notification';
    notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 z-[9999] transform transition-all duration-300 translate-x-full`;
    notification.innerHTML = `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            ${icon}
        </svg>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 10);
    
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Close modals when clicking outside or pressing Escape
document.addEventListener('click', function(event) {
    const modals = ['createModal', 'detailModal', 'editModal', 'deleteModal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (event.target === modal) {
            const closeFunction = window[`close${modalId.charAt(0).toUpperCase() + modalId.slice(1, -5)}Modal`];
            if (closeFunction) closeFunction();
        }
    });
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (!document.getElementById('createModal').classList.contains('hidden')) {
            closeCreateModal();
        } else if (!document.getElementById('detailModal').classList.contains('hidden')) {
            closeDetailModal();
        } else if (!document.getElementById('editModal').classList.contains('hidden')) {
            closeEditModal();
        } else if (!document.getElementById('deleteModal').classList.contains('hidden')) {
            closeDeleteModal();
        }
    }
});
</script>
