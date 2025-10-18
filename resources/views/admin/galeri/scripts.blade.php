<script>
// ===============================
// Galeri - Modal Management
// ===============================

function openCreateGaleriModal() {
    const modal = document.getElementById('createGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);
    document.getElementById('createGaleriForm').reset();
    clearGaleriErrors('create');
    const preview = document.getElementById('create_gambar_preview');
    if (preview) preview.src = '';
}

function closeCreateGaleriModal() {
    const modal = document.getElementById('createGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

async function showGaleriDetail(id) {
    const modal = document.getElementById('detailGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    const loadingEl = document.getElementById('galeriDetailLoading');
    const dataEl = document.getElementById('galeriDetailData');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);

    loadingEl.classList.remove('hidden');
    dataEl.classList.add('hidden');

    try {
        const res = await fetch(`{{ url('admin/galeri') }}/${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
        if (!res.ok) throw new Error('Gagal mengambil data');
        const result = await res.json();
        const g = result.galeri;
        document.getElementById('detail_kode_galeri').textContent = g.kode_galeri;
        document.getElementById('detail_judul').textContent = g.judul;
        document.getElementById('detail_kategori').textContent = g.kategori_nama || '-';
        document.getElementById('detail_status').textContent = g.status;
        document.getElementById('detail_deskripsi').textContent = g.deskripsi || '-';
        const img = document.getElementById('detail_gambar');
        if (g.gambar_url) { img.src = g.gambar_url; img.classList.remove('hidden'); }
        else { img.src = ''; img.classList.add('hidden'); }
        document.getElementById('detail_created_at').textContent = g.created_at_formatted;
        document.getElementById('detail_updated_at').textContent = g.updated_at_formatted;
        loadingEl.classList.add('hidden');
        dataEl.classList.remove('hidden');
    } catch(err) {
        console.error(err);
        showNotification('Gagal mengambil data galeri', 'error');
        closeDetailGaleriModal();
    }
}

function closeDetailGaleriModal() {
    const modal = document.getElementById('detailGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

async function openEditGaleriModal(id) {
    const modal = document.getElementById('editGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    const loadingEl = document.getElementById('galeriEditLoading');
    const formEl = document.getElementById('editGaleriFormContent');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);

    loadingEl.classList.remove('hidden');
    formEl.classList.add('hidden');
    clearGaleriErrors('edit');

    try {
        const res = await fetch(`{{ url('admin/galeri') }}/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
        if (!res.ok) throw new Error('Gagal mengambil data');
        const result = await res.json();
        const g = result.galeri;
        document.getElementById('edit_galeri_id').value = g.id_galeri;
        document.getElementById('edit_kategori_id').value = g.kategori_id;
        document.getElementById('edit_judul').value = g.judul;
        document.getElementById('edit_deskripsi').value = g.deskripsi || '';
        document.getElementById('edit_status').value = g.status;
        const preview = document.getElementById('edit_gambar_preview');
        if (g.gambar) { preview.src = `{{ asset('storage/galeri') }}/${g.gambar}`; preview.classList.remove('hidden'); } else { preview.src = ''; preview.classList.add('hidden'); }
        loadingEl.classList.add('hidden');
        formEl.classList.remove('hidden');
    } catch(err) {
        console.error(err);
        showNotification('Gagal mengambil data galeri', 'error');
        closeEditGaleriModal();
    }
}

function closeEditGaleriModal() {
    const modal = document.getElementById('editGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

function confirmDeleteGaleri(id, title) {
    const modal = document.getElementById('deleteGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-95','opacity-0'); modalContent.classList.add('scale-100','opacity-100'); }, 10);
    document.getElementById('delete_galeri_id').value = id;
    document.getElementById('delete_galeri_title').textContent = title;
}

function closeDeleteGaleriModal() {
    const modal = document.getElementById('deleteGaleriModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100','opacity-100');
    modalContent.classList.add('scale-95','opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

// ===============================
// Galeri - Form Submissions
// ===============================

async function submitCreateGaleri(event) {
    event.preventDefault();
    const form = document.getElementById('createGaleriForm');
    const submitBtn = document.getElementById('createGaleriSubmitBtn');
    const formData = new FormData(form);

    submitBtn.disabled = true; submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...';
    clearGaleriErrors('create');

    try {
        const res = await fetch(`{{ route('admin.galeri.store') }}` , {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: formData
        });
        const result = await res.json();
        if (res.ok) {
            showNotification(result.message || 'Galeri berhasil ditambahkan', 'success');
            closeCreateGaleriModal();
            setTimeout(() => window.location.reload(), 800);
        } else {
            if (result.errors) displayGaleriErrors('create', result.errors);
            showNotification(result.message || 'Gagal menambahkan galeri', 'error');
        }
    } catch(err) {
        console.error(err); showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false; submitBtn.innerHTML = 'Simpan Galeri';
    }
}

async function submitEditGaleri(event) {
    event.preventDefault();
    const form = document.getElementById('editGaleriForm');
    const submitBtn = document.getElementById('editGaleriSubmitBtn');
    const id = document.getElementById('edit_galeri_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');

    submitBtn.disabled = true; submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengupdate...';
    clearGaleriErrors('edit');

    try {
        const res = await fetch(`{{ url('admin/galeri') }}/${id}`, {
            method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, body: formData
        });
        const result = await res.json();
        if (res.ok) {
            showNotification(result.message || 'Galeri berhasil diupdate', 'success');
            closeEditGaleriModal();
            setTimeout(() => window.location.reload(), 800);
        } else {
            if (result.errors) displayGaleriErrors('edit', result.errors);
            showNotification(result.message || 'Gagal mengupdate galeri', 'error');
        }
    } catch(err) {
        console.error(err); showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false; submitBtn.innerHTML = 'Update Galeri';
    }
}

async function submitDeleteGaleri(event) {
    event.preventDefault();
    const submitBtn = document.getElementById('deleteGaleriSubmitBtn');
    const id = document.getElementById('delete_galeri_id').value;
    submitBtn.disabled = true; submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';

    try {
        const res = await fetch(`{{ url('admin/galeri') }}/${id}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        const result = await res.json();
        if (res.ok) {
            showNotification(result.message || 'Galeri berhasil dihapus', 'success');
            closeDeleteGaleriModal();
            setTimeout(() => window.location.reload(), 800);
        } else {
            showNotification(result.message || 'Gagal menghapus galeri', 'error');
        }
    } catch(err) {
        console.error(err); showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false; submitBtn.innerHTML = 'Ya, Hapus';
    }
}

// ===============================
// Galeri - Helpers
// ===============================

function clearGaleriErrors(prefix) {
    document.querySelectorAll(`[id^="error_${prefix}_galeri_"]`).forEach(el => { el.classList.add('hidden'); el.textContent = ''; });
}
function displayGaleriErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const el = document.getElementById(`error_${prefix}_galeri_${field}`);
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
    const ids = ['createGaleriModal','detailGaleriModal','editGaleriModal','deleteGaleriModal'];
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
        ['closeCreateGaleriModal','closeDetailGaleriModal','closeEditGaleriModal','closeDeleteGaleriModal']
            .forEach(fn => { if (typeof window[fn] === 'function') window[fn](); });
    }
});
</script>
