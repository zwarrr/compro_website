<script>
// =====================================================
// AUTO-SUBMIT FILTERS
// =====================================================
document.getElementById('searchInput')?.addEventListener('input', debounce(function() {
    document.getElementById('filterForm').submit();
}, 500));

document.getElementById('statusSelect')?.addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// =====================================================
// MODAL MANAGEMENT - CREATE
// =====================================================
function openCreateModal() {
    console.log('openCreateModal called');
    const modal = document.getElementById('createModal');
    const modalContent = modal.querySelector('.modal-content');
    
    console.log('Modal element:', modal);
    console.log('Modal content:', modalContent);
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    const form = document.getElementById('createFaqForm');
    if (form) {
        form.reset();
    }
    clearErrors('create');
    console.log('Modal opened successfully');
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

// =====================================================
// MODAL MANAGEMENT - DETAIL
// =====================================================
async function showDetail(faqId) {
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
        const response = await fetch(`{{ url('admin/faq') }}/${faqId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const faq = result.data;
        
        document.getElementById('detail_id').textContent = faq.id_faq;
        document.getElementById('detail_kode').textContent = faq.kode_faq;
        document.getElementById('detail_pertanyaan').textContent = faq.pertanyaan;
        document.getElementById('detail_jawaban').textContent = faq.jawaban;
        document.getElementById('detail_created_at').textContent = faq.created_at;
        document.getElementById('detail_updated_at').textContent = faq.updated_at;
        
        // Status badge
        const statusBadge = document.getElementById('detail_status_badge');
        if (faq.status === 'publik') {
            statusBadge.innerHTML = '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-500 to-green-600 text-white shadow-sm"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>Publik</span>';
        } else {
            statusBadge.innerHTML = '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-500 text-white shadow-sm"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" /></svg>Draft</span>';
        }
        
        loadingEl.classList.add('hidden');
        dataEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data FAQ', 'error');
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

// =====================================================
// MODAL MANAGEMENT - EDIT
// =====================================================
async function openEditModal(faqId) {
    const modal = document.getElementById('editModal');
    const modalContent = modal.querySelector('.modal-content');
    const loadingEl = document.getElementById('editLoading');
    const formEl = document.getElementById('editFaqForm');
    
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
        const response = await fetch(`{{ url('admin/faq') }}/${faqId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const faq = result.data;
        
        document.getElementById('edit_id_faq').value = faq.id_faq;
        document.getElementById('edit_kode_faq_display').textContent = faq.kode_faq;
        document.getElementById('edit_pertanyaan').value = faq.pertanyaan;
        document.getElementById('edit_jawaban').value = faq.jawaban;
        
        // Set radio button status
        if (faq.status === 'publik') {
            document.getElementById('edit_status_publik').checked = true;
        } else {
            document.getElementById('edit_status_draft').checked = true;
        }
        
        loadingEl.classList.add('hidden');
        formEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data FAQ', 'error');
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

// =====================================================
// MODAL MANAGEMENT - DELETE
// =====================================================
function confirmDelete(faqId, pertanyaan) {
    const modal = document.getElementById('deleteModal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('delete_id_faq').value = faqId;
    document.getElementById('delete_pertanyaan').textContent = pertanyaan;
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
// FORM SUBMISSIONS
// =====================================================

// Create FAQ
const createForm = document.getElementById('createFaqForm');
console.log('Create form element:', createForm);

if (createForm) {
    createForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        console.log('Form submitted!');
        clearErrors('create');
        
        const formData = new FormData(this);
        console.log('Form data:', Object.fromEntries(formData));
        
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        
        try {
            const response = await fetch('{{ route("admin.faq.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            });
            
            const result = await response.json();
            console.log('Server response:', result);
            
            if (response.ok && result.success) {
                showNotification(result.message, 'success');
                closeCreateModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors(result.errors, 'create');
                }
                showNotification(result.message || 'Gagal menambahkan FAQ', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>Tambah FAQ';
        }
    });
} else {
    console.error('Create form not found!');
}

// Update FAQ
document.getElementById('editFaqForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors('edit');
    
    const faqId = document.getElementById('edit_id_faq').value;
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    
    try {
        const response = await fetch(`{{ url('admin/faq') }}/${faqId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const result = await response.json();
        
        if (response.ok && result.success) {
            showNotification(result.message, 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors(result.errors, 'edit');
            }
            showNotification(result.message || 'Gagal memperbarui FAQ', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Simpan Perubahan';
    }
});

// Delete FAQ
document.getElementById('deleteFaqForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const faqId = document.getElementById('delete_id_faq').value;
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    
    try {
        const response = await fetch(`{{ url('admin/faq') }}/${faqId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        });
        
        const result = await response.json();
        
        if (response.ok && result.success) {
            showNotification(result.message, 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus FAQ', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>Ya, Hapus';
    }
});

// =====================================================
// ERROR HANDLING
// =====================================================
function displayErrors(errors, prefix) {
    Object.keys(errors).forEach(key => {
        const errorElement = document.getElementById(`error_${prefix}_${key}`);
        const inputElement = document.getElementById(`${prefix}_${key}`);
        
        if (errorElement) {
            errorElement.textContent = errors[key][0];
            errorElement.classList.remove('hidden');
        }
        if (inputElement) {
            inputElement.classList.add('border-red-500');
        }
    });
}

function clearErrors(prefix) {
    document.querySelectorAll(`[id^="error_${prefix}_"]`).forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
    
    document.querySelectorAll(`[id^="${prefix}_"]`).forEach(el => {
        el.classList.remove('border-red-500');
    });
}

// =====================================================
// NOTIFICATION
// =====================================================
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-2xl transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white flex items-center gap-3`;
    
    notification.innerHTML = `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            ${type === 'success' 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
            }
        </svg>
        <span class="font-medium">${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}
</script>
