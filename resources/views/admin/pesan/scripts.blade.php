<script>
// =====================================================
// GLOBAL VARIABLES
// =====================================================
let currentPesanId = null;

// =====================================================
// AUTO-SUBMIT FILTERS
// =====================================================
document.getElementById('searchInput')?.addEventListener('input', debounce(function() {
    document.getElementById('filterForm').submit();
}, 500));

document.getElementById('statusBacaSelect')?.addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});

// Debounce function
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
    const modal = document.getElementById('createModal');
    const modalContent = document.getElementById('createModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('createPesanForm').reset();
    clearErrors();
}

function closeCreateModal() {
    const modal = document.getElementById('createModal');
    const modalContent = document.getElementById('createModalContent');
    
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// =====================================================
// MODAL MANAGEMENT - DETAIL
// =====================================================
async function showDetail(pesanId) {
    currentPesanId = pesanId;
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('detailModalContent');
    const loadingEl = document.getElementById('detailLoading');
    const dataEl = document.getElementById('detailData');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    loadingEl.classList.remove('hidden');
    dataEl.classList.add('hidden');
    
    try {
        const response = await fetch(`{{ url('admin/pesan') }}/${pesanId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const pesan = result.data;
        
        document.getElementById('detail_nama').textContent = pesan.nama;
        document.getElementById('detail_email').textContent = pesan.email;
        document.getElementById('detail_kode_kontak').textContent = pesan.kode_kontak;
        document.getElementById('detail_subjek').textContent = pesan.subjek;
        document.getElementById('detail_pesan').textContent = pesan.pesan;
        document.getElementById('detail_created_at').textContent = pesan.created_at;
        document.getElementById('detail_updated_at').textContent = pesan.updated_at;
        
        // Status badge
        const statusBadge = document.getElementById('detail_status_badge');
        if (pesan.status_baca === 'belum') {
            statusBadge.innerHTML = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Belum Dibaca</span>';
        } else {
            statusBadge.innerHTML = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Sudah Dibaca</span>';
        }
        
        loadingEl.classList.add('hidden');
        dataEl.classList.remove('hidden');
        
        // Update UI di list tanpa refresh (karena controller sudah auto mark as read)
        updateMessageUIAsRead(pesanId);
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data pesan', 'error');
        closeDetailModal();
    }
}

// Update UI pesan menjadi "sudah dibaca" tanpa refresh
function updateMessageUIAsRead(pesanId) {
    // Cari element pesan berdasarkan onclick attribute
    const messageElement = document.querySelector(`[onclick*="showDetail(${pesanId})"]`);
    
    if (!messageElement) return;
    
    // Hapus background biru dan border
    messageElement.classList.remove('bg-blue-50/40', 'border-blue-500');
    messageElement.classList.add('border-transparent');
    
    // Update avatar - hapus gradient biru, ganti dengan gray
    const avatar = messageElement.querySelector('.w-14.h-14');
    if (avatar) {
        avatar.classList.remove('bg-gradient-to-br', 'from-blue-500', 'to-blue-600', 'shadow-lg', 'shadow-blue-500/30');
        avatar.classList.add('bg-gradient-to-br', 'from-gray-400', 'to-gray-500', 'shadow-md');
    }
    
    // Hapus red dot indicator
    const redDot = messageElement.querySelector('.absolute.-top-1.-right-1');
    if (redDot) {
        redDot.remove();
    }
    
    // Update nama - hapus bold blue
    const nameElement = messageElement.querySelector('h4');
    if (nameElement) {
        nameElement.classList.remove('text-blue-900');
    }
    
    // Ganti badge BARU dengan badge Terbaca
    const badgeContainer = messageElement.querySelector('.inline-flex.items-center.px-2\\.5.py-1');
    if (badgeContainer && badgeContainer.textContent.includes('BARU')) {
        badgeContainer.outerHTML = `
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Terbaca
            </span>
        `;
    }
    
    // Update unread counter di header
    updateUnreadCounter();
}

// Update unread counter badge
function updateUnreadCounter() {
    const unreadBadge = document.querySelector('.bg-blue-50.rounded-lg .text-blue-700');
    if (unreadBadge) {
        const currentCount = parseInt(unreadBadge.textContent.match(/\d+/)[0]);
        if (currentCount > 0) {
            const newCount = currentCount - 1;
            unreadBadge.textContent = `${newCount} Belum Dibaca`;
        }
    }
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('detailModalContent');
    
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
async function openEditModal(pesanId) {
    const modal = document.getElementById('editModal');
    const modalContent = document.getElementById('editModalContent');
    const loadingEl = document.getElementById('editLoading');
    const formEl = document.getElementById('editPesanForm');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    loadingEl.classList.remove('hidden');
    formEl.classList.add('hidden');
    clearErrors();
    
    try {
        const response = await fetch(`{{ url('admin/pesan') }}/${pesanId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data');
        
        const result = await response.json();
        const pesan = result.data;
        
        document.getElementById('edit_id_kontak').value = pesan.id_kontak;
        document.getElementById('edit_kode_kontak_display').textContent = pesan.kode_kontak;
        document.getElementById('edit_nama').value = pesan.nama;
        document.getElementById('edit_email').value = pesan.email;
        document.getElementById('edit_subjek').value = pesan.subjek || '';
        document.getElementById('edit_pesan').value = pesan.pesan;
        
        // Set radio button status
        if (pesan.status_baca === 'belum') {
            document.getElementById('edit_status_belum').checked = true;
        } else {
            document.getElementById('edit_status_sudah').checked = true;
        }
        
        loadingEl.classList.add('hidden');
        formEl.classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        showNotification('Gagal mengambil data pesan', 'error');
        closeEditModal();
    }
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    const modalContent = document.getElementById('editModalContent');
    
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
function confirmDelete(pesanId, nama, email = '') {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    document.getElementById('delete_id_kontak').value = pesanId;
    document.getElementById('delete_nama').textContent = nama;
    document.getElementById('delete_email').textContent = email;
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
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

// Create Pesan
document.getElementById('createPesanForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors();
    
    const formData = new FormData(this);
    const submitBtn = document.getElementById('createPesanSubmitBtn');
    const submitBtnText = document.getElementById('createPesanSubmitBtnText');
    const loadingSpinner = document.getElementById('createPesanLoadingSpinner');
    
    submitBtn.disabled = true;
    loadingSpinner.classList.remove('hidden');
    submitBtnText.textContent = 'Menyimpan...';
    
    try {
        const response = await fetch('{{ route("admin.pesan.store") }}', {
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
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors(result.errors);
            }
            showNotification(result.message || 'Gagal menyimpan data', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        loadingSpinner.classList.add('hidden');
        submitBtnText.textContent = 'Simpan Pesan';
    }
});

// Update Pesan
document.getElementById('editPesanForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors();
    
    const pesanId = document.getElementById('edit_id_kontak').value;
    const formData = new FormData(this);
    const submitBtn = document.getElementById('editPesanSubmitBtn');
    const submitBtnText = document.getElementById('editPesanSubmitBtnText');
    const loadingSpinner = document.getElementById('editPesanLoadingSpinner');
    
    submitBtn.disabled = true;
    loadingSpinner.classList.remove('hidden');
    submitBtnText.textContent = 'Menyimpan...';
    
    try {
        const response = await fetch(`{{ url('admin/pesan') }}/${pesanId}`, {
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
                displayErrors(result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate data', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        loadingSpinner.classList.add('hidden');
        submitBtnText.textContent = 'Simpan Perubahan';
    }
});

// Delete Pesan
document.getElementById('deletePesanForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const pesanId = document.getElementById('delete_id_kontak').value;
    const submitBtn = document.getElementById('deletePesanSubmitBtn');
    const submitBtnText = document.getElementById('deletePesanSubmitBtnText');
    const loadingSpinner = document.getElementById('deletePesanLoadingSpinner');
    const deleteIcon = document.getElementById('deletePesanIcon');
    
    submitBtn.disabled = true;
    deleteIcon.classList.add('hidden');
    loadingSpinner.classList.remove('hidden');
    submitBtnText.textContent = 'Menghapus...';
    
    try {
        const response = await fetch(`{{ url('admin/pesan') }}/${pesanId}`, {
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
            showNotification(result.message || 'Gagal menghapus pesan', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        loadingSpinner.classList.add('hidden');
        deleteIcon.classList.remove('hidden');
        submitBtnText.textContent = 'Ya, Hapus';
    }
});

// =====================================================
// MARK AS READ/UNREAD
// =====================================================
async function markAsUnread(pesanId) {
    try {
        const response = await fetch(`{{ url('admin/pesan') }}/${pesanId}/mark-unread`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        });
        
        const result = await response.json();
        
        if (response.ok && result.success) {
            showNotification(result.message, 'success');
            closeDetailModal();
            
            // Update UI ke status belum dibaca tanpa refresh
            updateMessageUIAsUnread(pesanId);
        } else {
            showNotification(result.message || 'Gagal menandai pesan', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan pada server', 'error');
    }
}

// Update UI pesan menjadi "belum dibaca" tanpa refresh
function updateMessageUIAsUnread(pesanId) {
    // Cari element pesan berdasarkan onclick attribute
    const messageElement = document.querySelector(`[onclick*="showDetail(${pesanId})"]`);
    
    if (!messageElement) return;
    
    // Tambah background biru dan border
    messageElement.classList.add('bg-blue-50/40', 'border-blue-500');
    messageElement.classList.remove('border-transparent');
    
    // Update avatar - ganti gray dengan gradient biru
    const avatar = messageElement.querySelector('.w-14.h-14');
    if (avatar) {
        avatar.classList.remove('bg-gradient-to-br', 'from-gray-400', 'to-gray-500', 'shadow-md');
        avatar.classList.add('bg-gradient-to-br', 'from-blue-500', 'to-blue-600', 'shadow-lg', 'shadow-blue-500/30');
        
        // Tambah red dot indicator jika belum ada
        if (!avatar.parentElement.querySelector('.absolute.-top-1.-right-1')) {
            const redDot = document.createElement('div');
            redDot.className = 'absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse';
            avatar.parentElement.appendChild(redDot);
        }
    }
    
    // Update nama - tambah bold blue
    const nameElement = messageElement.querySelector('h4');
    if (nameElement) {
        nameElement.classList.add('text-blue-900');
    }
    
    // Ganti badge Terbaca dengan badge BARU
    const badgeContainer = messageElement.querySelector('.inline-flex.items-center.px-2\\.5.py-1');
    if (badgeContainer && badgeContainer.textContent.includes('Terbaca')) {
        badgeContainer.outerHTML = `
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-sm">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                BARU
            </span>
        `;
    }
    
    // Update unread counter di header
    const unreadBadge = document.querySelector('.bg-blue-50.rounded-lg .text-blue-700');
    if (unreadBadge) {
        const currentCount = parseInt(unreadBadge.textContent.match(/\d+/)[0]);
        const newCount = currentCount + 1;
        unreadBadge.textContent = `${newCount} Belum Dibaca`;
    }
}

// =====================================================
// REPLY MESSAGE
// =====================================================
function replyMessage() {
    const email = document.getElementById('detail_email').textContent;
    const subjek = document.getElementById('detail_subjek').textContent;
    window.location.href = `mailto:${email}?subject=Re: ${subjek}`;
}

// =====================================================
// ERROR HANDLING
// =====================================================
function displayErrors(errors) {
    Object.keys(errors).forEach(key => {
        const errorElement = document.getElementById(`error-${key}`);
        const inputElement = document.getElementById(`create_${key}`) || document.getElementById(`edit_${key}`);
        
        if (errorElement) {
            errorElement.textContent = errors[key][0];
            errorElement.classList.remove('hidden');
        }
        
        if (inputElement) {
            inputElement.classList.add('border-red-500');
        }
    });
}

function clearErrors() {
    document.querySelectorAll('[id^="error-"]').forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
    
    document.querySelectorAll('input, textarea, select').forEach(el => {
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
