<script>
// =====================================================
// MODAL MANAGEMENT FUNCTIONS
// =====================================================

function openCreateModal() {
    const modal = document.getElementById('createModal');
    const modalContent = document.getElementById('createModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('createClientForm').reset();
    document.getElementById('create_logo_preview').classList.add('hidden');
    clearErrors('create');
}

function closeCreateModal() {
    const modal = document.getElementById('createModal');
    const modalContent = document.getElementById('createModalContent');
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

async function showDetail(clientId) {
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('detailModalContent');
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
        const response = await fetch(`{{ url('admin/client') }}/${clientId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const client = result.data;
        
        document.getElementById('detail_id').textContent = client.id_client;
        document.getElementById('detail_kode').textContent = client.kode_client;
        document.getElementById('detail_nama_client').textContent = client.nama_client;
        document.getElementById('detail_kategori').textContent = client.kategori_nama;
        document.getElementById('detail_website').innerHTML = client.website !== '-' 
            ? `<a href="${client.website}" target="_blank" class="text-blue-600 hover:underline">${client.website}</a>`
            : '-';
        document.getElementById('detail_deskripsi').textContent = client.deskripsi;
        document.getElementById('detail_status').textContent = client.status.charAt(0).toUpperCase() + client.status.slice(1);
        document.getElementById('detail_created_at').textContent = client.created_at_formatted;
        document.getElementById('detail_updated_at').textContent = client.updated_at_formatted;
        
        // Handle logo
        const logoContainer = document.getElementById('detail_logo_container');
        if (client.logo) {
            document.getElementById('detail_logo').src = client.logo;
            logoContainer.classList.remove('hidden');
        } else {
            logoContainer.classList.add('hidden');
        }
        
        loadingEl.classList.add('hidden');
        dataEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data client', 'error');
        closeDetailModal();
    }
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('detailModalContent');
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

async function openEditModal(clientId) {
    const modal = document.getElementById('editModal');
    const modalContent = document.getElementById('editModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    // Reset form and hide preview
    document.getElementById('editLogoPreviewArea').classList.add('hidden');
    document.getElementById('editLogoUploadArea').classList.remove('hidden');
    clearErrors('edit');
    
    try {
        const response = await fetch(`{{ url('admin/client') }}/${clientId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const client = result.data;
        
        document.getElementById('edit_id').value = client.id_client;
        document.getElementById('edit_kategori_id').value = client.kategori_id;
        document.getElementById('edit_nama_client').value = client.nama_client;
        document.getElementById('edit_website').value = client.website || '';
        document.getElementById('edit_deskripsi').value = client.deskripsi || '';
        document.getElementById('edit_status').value = client.status;
        document.getElementById('edit_logo_path').value = client.logo_path || '';
        
        // Show current logo if exists
        if (client.logo) {
            document.getElementById('editLogoUploadArea').classList.add('hidden');
            document.getElementById('editLogoPreviewArea').classList.remove('hidden');
            document.getElementById('editLogoPreviewImg').src = client.logo;
            document.getElementById('editLogoFileName').textContent = 'Logo saat ini';
            document.getElementById('editLogoFileSize').textContent = '';
        }
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data client', 'error');
        closeEditModal();
    }
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    const modalContent = document.getElementById('editModalContent');
    
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

function confirmDelete(clientId, clientName) {
    const modal = document.getElementById('deleteModal');
    const modalContent = modal.querySelector('div:first-child');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('delete_client_id').value = clientId;
    document.getElementById('delete_client_name').textContent = clientName;
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = modal.querySelector('div:first-child');
    
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
    
    const form = document.getElementById('createClientForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const submitBtnText = document.getElementById('createSubmitBtnText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const formData = new FormData(form);
    
    submitBtn.disabled = true;
    loadingSpinner.classList.remove('hidden');
    submitBtnText.textContent = 'Menyimpan...';
    
    clearErrors('create');
    
    try {
        const response = await fetch('{{ route('admin.client.store') }}', {
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
            showNotification(result.message || 'Client berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('create', result.errors);
            }
            showNotification(result.message || 'Gagal menambahkan client', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        loadingSpinner.classList.add('hidden');
        submitBtnText.textContent = 'Simpan Client';
    }
}

async function submitEdit(event) {
    event.preventDefault();
    
    const form = document.getElementById('editClientForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const submitBtnText = document.getElementById('editSubmitBtnText');
    const loadingSpinner = document.getElementById('editLoadingSpinner');
    const clientId = document.getElementById('edit_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    
    submitBtn.disabled = true;
    loadingSpinner.classList.remove('hidden');
    submitBtnText.textContent = 'Mengupdate...';
    
    clearErrors('edit');
    
    try {
        const response = await fetch(`{{ url('admin/client') }}/${clientId}`, {
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
            showNotification(result.message || 'Client berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate client', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        loadingSpinner.classList.add('hidden');
        submitBtnText.textContent = 'Update Client';
    }
}

async function submitDelete(event) {
    event.preventDefault();
    
    const submitBtn = document.getElementById('deleteSubmitBtn');
    const clientId = document.getElementById('delete_client_id').value;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';
    
    try {
        const response = await fetch(`{{ url('admin/client') }}/${clientId}`, {
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
            showNotification(result.message || 'Client berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus client', 'error');
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

function previewImage(event, prefix) {
    const file = event.target.files[0];
    const previewDiv = document.getElementById(`${prefix}_logo_preview`);
    const previewImg = previewDiv.querySelector('img');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewDiv.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        previewDiv.classList.add('hidden');
    }
}

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
