<script>
// ===============================
// Sosmed - Modal Management
// ===============================

function openCreateSosmedModal() {
    const modal = document.getElementById('createSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);
    document.getElementById('createSosmedForm').reset();
    clearSosmedErrors('create');
}

function closeCreateSosmedModal() {
    const modal = document.getElementById('createSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

async function showSosmedDetail(id) {
    const modal = document.getElementById('detailSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    const loadingEl = document.getElementById('sosmedDetailLoading');
    const dataEl = document.getElementById('sosmedDetailData');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);

    loadingEl.classList.remove('hidden');
    dataEl.classList.add('hidden');

    try {
        const res = await fetch(`{{ url('admin/sosial') }}/${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
        if (!res.ok) throw new Error('Gagal mengambil data');
        const result = await res.json();
        const s = result.sosmed;
        document.getElementById('detail_kode_sosial').textContent = s.kode_sosial;
        document.getElementById('detail_nama_sosmed').textContent = s.nama_sosmed;
        document.getElementById('detail_username').textContent = s.username || '-';
        document.getElementById('detail_status').textContent = s.status;
        const urlEl = document.getElementById('detail_url');
        urlEl.textContent = s.url;
        urlEl.href = s.url;
        document.getElementById('detail_icon').textContent = s.icon || '-';
        document.getElementById('detail_warna').textContent = s.warna || '-';
        const warnaBox = document.getElementById('detail_warna_box');
        if (s.warna) { warnaBox.style.backgroundColor = s.warna; } else { warnaBox.style.backgroundColor = '#e5e7eb'; }
        document.getElementById('detail_created_at').textContent = s.created_at_formatted;
        document.getElementById('detail_updated_at').textContent = s.updated_at_formatted;
        loadingEl.classList.add('hidden');
        dataEl.classList.remove('hidden');
    } catch(err) {
        console.error(err);
        showNotification('Gagal mengambil data sosial media', 'error');
        closeDetailSosmedModal();
    }
}

function closeDetailSosmedModal() {
    const modal = document.getElementById('detailSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

async function openEditSosmedModal(id) {
    const modal = document.getElementById('editSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    const loadingEl = document.getElementById('sosmedEditLoading');
    const formEl = document.getElementById('editSosmedFormContent');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);

    loadingEl.classList.remove('hidden');
    formEl.classList.add('hidden');
    clearSosmedErrors('edit');

    try {
        const res = await fetch(`{{ url('admin/sosial') }}/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
        if (!res.ok) throw new Error('Gagal mengambil data');
        const result = await res.json();
        const s = result.sosmed;
        document.getElementById('edit_sosmed_id').value = s.id_sosial;
        document.getElementById('edit_nama_sosmed').value = s.nama_sosmed;
        document.getElementById('edit_username').value = s.username || '';
        document.getElementById('edit_url').value = s.url;
        document.getElementById('edit_icon').value = s.icon || '';
        document.getElementById('edit_warna').value = s.warna || '';
        document.getElementById('edit_status').value = s.status;
        loadingEl.classList.add('hidden');
        formEl.classList.remove('hidden');
    } catch(err) {
        console.error(err);
        showNotification('Gagal mengambil data sosial media', 'error');
        closeEditSosmedModal();
    }
}

function closeEditSosmedModal() {
    const modal = document.getElementById('editSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

function confirmDeleteSosmed(id, title) {
    const modal = document.getElementById('deleteSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);
    document.getElementById('delete_sosmed_id').value = id;
    document.getElementById('delete_sosmed_title').textContent = title;
}

function closeDeleteSosmedModal() {
    const modal = document.getElementById('deleteSosmedModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

// ===============================
// Sosmed - Form Submissions
// ===============================

async function submitCreateSosmed(event) {
    event.preventDefault();
    const form = document.getElementById('createSosmedForm');
    const submitBtn = document.getElementById('createSosmedSubmitBtn');
    const formData = new FormData(form);

    submitBtn.disabled = true; submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...';
    clearSosmedErrors('create');

    try {
        const res = await fetch(`{{ route('admin.sosial.store') }}` , {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: formData
        });
        const result = await res.json();
        if (res.ok) {
            showNotification(result.message || 'Sosial media berhasil ditambahkan', 'success');
            closeCreateSosmedModal();
            setTimeout(() => window.location.reload(), 800);
        } else {
            if (result.errors) displaySosmedErrors('create', result.errors);
            showNotification(result.message || 'Gagal menambahkan sosial media', 'error');
        }
    } catch(err) {
        console.error(err); showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false; submitBtn.innerHTML = 'Simpan Sosial Media';
    }
}

async function submitEditSosmed(event) {
    event.preventDefault();
    const form = document.getElementById('editSosmedForm');
    const submitBtn = document.getElementById('editSosmedSubmitBtn');
    const id = document.getElementById('edit_sosmed_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');

    submitBtn.disabled = true; submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengupdate...';
    clearSosmedErrors('edit');

    try {
        const res = await fetch(`{{ url('admin/sosial') }}/${id}`, {
            method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, body: formData
        });
        const result = await res.json();
        if (res.ok) {
            showNotification(result.message || 'Sosial media berhasil diupdate', 'success');
            closeEditSosmedModal();
            setTimeout(() => window.location.reload(), 800);
        } else {
            if (result.errors) displaySosmedErrors('edit', result.errors);
            showNotification(result.message || 'Gagal mengupdate sosial media', 'error');
        }
    } catch(err) {
        console.error(err); showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false; submitBtn.innerHTML = 'Update Sosial Media';
    }
}

async function submitDeleteSosmed(event) {
    event.preventDefault();
    const submitBtn = document.getElementById('deleteSosmedSubmitBtn');
    const id = document.getElementById('delete_sosmed_id').value;
    submitBtn.disabled = true; submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';

    try {
        const res = await fetch(`{{ url('admin/sosial') }}/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        const result = await res.json();
        if (res.ok) {
            showNotification(result.message || 'Sosial media berhasil dihapus', 'success');
            closeDeleteSosmedModal();
            setTimeout(() => window.location.reload(), 800);
        } else {
            showNotification(result.message || 'Gagal menghapus sosial media', 'error');
        }
    } catch(err) {
        console.error(err); showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false; submitBtn.innerHTML = 'Ya, Hapus';
    }
}

// ===============================
// Sosmed - Helpers
// ===============================

function clearSosmedErrors(prefix) {
    document.querySelectorAll(`[id^="error_${prefix}_sosmed_"]`).forEach(el => { el.classList.add('hidden'); el.textContent = ''; });
}
function displaySosmedErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const el = document.getElementById(`error_${prefix}_sosmed_${field}`);
        if (el) { el.textContent = messages[0]; el.classList.remove('hidden'); }
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

// Close on outside click / Escape
document.addEventListener('click', function(event) {
    const ids = ['createSosmedModal','detailSosmedModal','editSosmedModal','deleteSosmedModal'];
    ids.forEach(id => {
        const modal = document.getElementById(id);
        if (event.target === modal) {
            const fn = window[`close${id.charAt(0).toUpperCase()+id.slice(1)}`];
            if (fn) fn();
        }
    });
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        ['closeCreateSosmedModal','closeDetailSosmedModal','closeEditSosmedModal','closeDeleteSosmedModal']
            .forEach(fn => { if (typeof window[fn] === 'function') window[fn](); });
    }
});
</script>
