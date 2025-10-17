<script>
// =====================================================
// MODAL MANAGEMENT FUNCTIONS
// =====================================================

// Open Create Modal
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
    
    // Reset form
    document.getElementById('createUserForm').reset();
    clearErrors('create');
}

// Close Create Modal
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

// Open Detail Modal
async function showDetail(userId) {
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
    
    // Show loading
    loadingEl.classList.remove('hidden');
    dataEl.classList.add('hidden');
    
    try {
        const response = await fetch(`{{ url('admin/user') }}/${userId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const user = result.user;
        
        // Populate data
        document.getElementById('detail_avatar').textContent = user.nama.charAt(0).toUpperCase();
        document.getElementById('detail_id').textContent = user.id_user;
        document.getElementById('detail_nama').textContent = user.nama;
        document.getElementById('detail_email').textContent = user.email;
        
        const statusBadge = user.status === 'aktif' 
            ? '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>'
            : '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>';
        document.getElementById('detail_status').innerHTML = statusBadge;
        
        document.getElementById('detail_terakhir_aktif').textContent = user.terakhir_aktif_formatted || '-';
        document.getElementById('detail_created_at').textContent = user.created_at_formatted;
        document.getElementById('detail_updated_at').textContent = user.updated_at_formatted;
        
        // Hide loading, show data
        loadingEl.classList.add('hidden');
        dataEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data user', 'error');
        closeDetailModal();
    }
}

// Close Detail Modal
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

// Open Edit Modal
async function openEditModal(userId) {
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
    
    // Show loading
    loadingEl.classList.remove('hidden');
    formEl.classList.add('hidden');
    clearErrors('edit');
    
    try {
        const response = await fetch(`{{ url('admin/user') }}/${userId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const user = result.user;
        
        // Populate form
        document.getElementById('edit_id').value = user.id_user;
        document.getElementById('edit_nama').value = user.nama;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_status').value = user.status;
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_password_confirmation').value = '';
        
        // Hide loading, show form
        loadingEl.classList.add('hidden');
        formEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data user', 'error');
        closeEditModal();
    }
}

// Close Edit Modal
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

// Confirm Delete
function confirmDelete(userId, userName) {
    const modal = document.getElementById('deleteModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('delete_user_id').value = userId;
    document.getElementById('delete_user_name').textContent = userName;
}

// Close Delete Modal
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

// Submit Create Form
async function submitCreate(event) {
    event.preventDefault();
    
    const form = document.getElementById('createUserForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const formData = new FormData(form);
    
    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...';
    
    clearErrors('create');
    
    try {
        const response = await fetch('{{ route('admin.user.store') }}', {
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
            showNotification(result.message || 'User berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            if (result.errors) {
                displayErrors('create', result.errors);
            }
            showNotification(result.message || 'Gagal menambahkan user', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Simpan';
    }
}

// Submit Edit Form
async function submitEdit(event) {
    event.preventDefault();
    
    const form = document.getElementById('editUserForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const userId = document.getElementById('edit_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    
    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengupdate...';
    
    clearErrors('edit');
    
    try {
        const response = await fetch(`{{ url('admin/user') }}/${userId}`, {
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
            showNotification(result.message || 'User berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            if (result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate user', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Update';
    }
}

// Submit Delete
async function submitDelete(event) {
    event.preventDefault();
    
    const submitBtn = document.getElementById('deleteSubmitBtn');
    const userId = document.getElementById('delete_user_id').value;
    
    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';
    
    try {
        const response = await fetch(`{{ url('admin/user') }}/${userId}`, {
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
            showNotification(result.message || 'User berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus user', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Hapus';
    }
}

// =====================================================
// HELPER FUNCTIONS
// =====================================================

// Clear Error Messages
function clearErrors(prefix) {
    const errorElements = document.querySelectorAll(`[id^="error_${prefix}_"]`);
    errorElements.forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
}

// Display Error Messages
function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_${prefix}_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
        }
    }
}

// Toggle Password Visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    input.type = input.type === 'password' ? 'text' : 'password';
}

// Show password confirmation field when password is filled
document.addEventListener('DOMContentLoaded', function() {
    const editPasswordInput = document.getElementById('edit_password');
    const confirmWrapper = document.getElementById('edit_password_confirmation_wrapper');
    
    if (editPasswordInput && confirmWrapper) {
        editPasswordInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                confirmWrapper.style.display = 'block';
            } else {
                confirmWrapper.style.display = 'none';
                document.getElementById('edit_password_confirmation').value = '';
            }
        });
    }
});

// Show Notification
function showNotification(message, type = 'success') {
    // Remove existing notification if any
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
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 10);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Close modals when clicking outside
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

// Close modals with Escape key
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
