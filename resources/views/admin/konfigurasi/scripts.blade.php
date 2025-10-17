<script>
function openCreateProfileModal() {
    const modal = document.getElementById('createProfileModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    document.getElementById('createProfileForm').reset();
    clearProfileErrors();
}
function closeCreateProfileModal() {
    const modal = document.getElementById('createProfileModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

function openDetailProfileModal() {
    const modal = document.getElementById('detailProfileModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    // Data sudah ada di halaman; kita bisa langsung mengisi menggunakan dataset jika dibutuhkan.
    // Jika perlu fetch terbaru, aktifkan fungsi fetchProfileDetail() di sini.
}
function closeDetailProfileModal() {
    const modal = document.getElementById('detailProfileModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

async function openEditProfileModal() {
    const modal = document.getElementById('editProfileModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    clearProfileErrors();

    try {
        const response = await fetch(`{{ url('admin/konfigurasi') }}`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }});
        if (!response.ok) throw new Error('Gagal mengambil data');
        const result = await response.json();
        const p = result.profile;
        document.getElementById('edit_id_perusahaan').value = p.id_perusahaan;
        document.getElementById('edit_kode_profile').value = p.kode_profile || '';
        document.getElementById('edit_nama_perusahaan').value = p.nama_perusahaan || '';
        document.getElementById('edit_slogan').value = p.slogan || '';
        document.getElementById('edit_deskripsi').value = p.deskripsi || '';
        document.getElementById('edit_visi').value = p.visi || '';
        document.getElementById('edit_misi').value = p.misi || '';
        document.getElementById('edit_alamat').value = p.alamat || '';
        document.getElementById('edit_telepon').value = p.telepon || '';
        document.getElementById('edit_email').value = p.email || '';
    } catch (e) {
        console.error(e);
        showNotification('Gagal memuat profil', 'error');
        closeEditProfileModal();
    }
}
function closeEditProfileModal() {
    const modal = document.getElementById('editProfileModal');
    const modalContent = modal.querySelector('.modal-content');
    modal.classList.remove('opacity-100');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
}

function clearProfileErrors() {
    const ids = ['kode_profile','nama_perusahaan','slogan','deskripsi','visi','misi','alamat','telepon','email'];
    ids.forEach(id => {
        const el = document.getElementById('error_' + id);
        if (el) { el.textContent = ''; el.classList.add('hidden'); }
    });
}

async function submitCreateProfile(event) {
    event.preventDefault();
    clearProfileErrors();
    const btn = document.getElementById('createSubmitBtn');
    const text = document.getElementById('createSubmitBtnText');
    const spinner = document.getElementById('createLoadingSpinner');
    btn.disabled = true; spinner.classList.remove('hidden'); text.textContent = 'Menyimpan...';

    try {
        const form = document.getElementById('createProfileForm');
        const formData = new FormData(form);
        const response = await fetch(`{{ url('admin/konfigurasi') }}`, {
            method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: formData
        });
        if (response.status === 422) {
            const { errors } = await response.json();
            Object.keys(errors).forEach(k => {
                const el = document.getElementById('error_' + k);
                if (el) { el.textContent = errors[k][0]; el.classList.remove('hidden'); }
            });
            showNotification('Validasi gagal. Periksa form Anda.', 'error');
            return;
        }
        if (!response.ok) throw new Error('Gagal menyimpan');
        const data = await response.json();
        await refreshProfileUI(data.profile);
        showNotification('Profil berhasil dibuat', 'success');
        closeCreateProfileModal();
    } catch(e) {
        console.error(e);
        showNotification('Gagal menyimpan profil', 'error');
    } finally {
        btn.disabled = false; spinner.classList.add('hidden'); text.textContent = 'Buat Profile';
    }
}

async function submitEditProfile(event) {
    event.preventDefault();
    clearProfileErrors();
    const btn = document.getElementById('editSubmitBtn');
    const text = document.getElementById('editSubmitBtnText');
    const spinner = document.getElementById('editLoadingSpinner');
    btn.disabled = true; spinner.classList.remove('hidden'); text.textContent = 'Menyimpan...';

    try {
        const id = document.getElementById('edit_id_perusahaan').value;
        const form = document.getElementById('editProfileForm');
        const formData = new FormData(form);
        formData.append('_method', 'PUT');
        const response = await fetch(`{{ url('admin/konfigurasi') }}/${id}`, {
            method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: formData
        });
        if (response.status === 422) {
            const { errors } = await response.json();
            Object.keys(errors).forEach(k => {
                const el = document.getElementById('error_' + k);
                if (el) { el.textContent = errors[k][0]; el.classList.remove('hidden'); }
            });
            showNotification('Validasi gagal. Periksa form Anda.', 'error');
            return;
        }
        if (!response.ok) throw new Error('Gagal menyimpan');
        const data = await response.json();
        await refreshProfileUI(data.profile);
        showNotification('Profil berhasil diperbarui', 'success');
        closeEditProfileModal();
    } catch(e) {
        console.error(e);
        showNotification('Gagal menyimpan profil', 'error');
    } finally {
        btn.disabled = false; spinner.classList.add('hidden'); text.textContent = 'Simpan Perubahan';
    }
}

// Close on backdrop click or ESC
document.addEventListener('click', (e) => {
    const ids = ['createProfileModal','detailProfileModal','editProfileModal'];
    ids.forEach(id => {
        const modal = document.getElementById(id);
        if (modal && e.target === modal) {
            if (id === 'createProfileModal') closeCreateProfileModal();
            if (id === 'detailProfileModal') closeDetailProfileModal();
            if (id === 'editProfileModal') closeEditProfileModal();
        }
    });
});
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') { closeCreateProfileModal(); closeDetailProfileModal(); closeEditProfileModal(); }
});

// Optional: fill detail modal from existing DOM when opening
window.addEventListener('load', () => {
    const p = @json(isset($profile) ? $profile : null);
    if (p) {
        fillDetailModal(p);
    }
});
async function refreshProfileUI(profile) {
    // Update header actions
    const headerActions = document.getElementById('headerActions');
    if (headerActions) {
        headerActions.innerHTML = `
            <span id="lastUpdated" class="hidden md:block text-xs text-gray-500">Terakhir diperbarui: ${formatDate(profile.updated_at)}</span>
            <button onclick="openEditProfileModal()"
                class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors flex items-center gap-2 text-sm shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Profile
            </button>
        `;
    }

    // Update content area
    const container = document.getElementById('profileContent');
    if (container) {
        container.innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex items-center gap-2">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 1.657-1.567 3-3.5 3S5 12.657 5 11s1.567-3 3.5-3 3.5 1.343 3.5 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">Informasi Umum</h3>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    ${infoRow('Kode Profile', profile.kode_profile, 'M9 12h6m-6 4h6M9 8h6')}
                    ${infoRow('Nama Perusahaan', profile.nama_perusahaan, 'M3 7h18M3 12h18M3 17h18')}
                    ${infoRow('Slogan', profile.slogan || '-', 'M9 5l7 7-7 7')}
                </div>
                <div class="px-6 py-4 border-t bg-gray-50 flex items-center justify-end gap-3">
                    <button onclick="openDetailProfileModal()" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">Detail</button>
                    <button onclick="openEditProfileModal()" class="px-4 py-2 text-sm bg-amber-500 text-white rounded-lg hover:bg-amber-600">Edit</button>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex items-center gap-2">
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5z" /></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">Konten Perusahaan</h3>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    <div><p class="text-gray-500 mb-1">Deskripsi</p><p class="text-gray-800 whitespace-pre-line">${profile.deskripsi || '-'}</p></div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><p class="text-gray-500 mb-1">Visi</p><p class="text-gray-800 whitespace-pre-line">${profile.visi || '-'}</p></div>
                        <div><p class="text-gray-500 mb-1">Misi</p><p class="text-gray-800 whitespace-pre-line">${profile.misi || '-'}</p></div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex items-center gap-2">
                    <div class="bg-green-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12m0 0L9.172 7.757m4.242 4.243L7.757 17.657M7.05 7.05a7 7 0 119.9 9.9 7 7 0 01-9.9-9.9z" /></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-800">Kontak & Alamat</h3>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    ${infoRow('Alamat', profile.alamat || '-', 'M17.657 16.657L13.414 12 9.172 7.757')}
                    ${infoRow('Telepon', profile.telepon || '-', 'M3 5h2l3 7-1.5 1.5a11 11 0 005 5L15 19l7 3-3-7-2-2')}
                    ${infoRow('Email', profile.email || '-', 'M16 12A4 4 0 118 12a4 4 0 018 0z')}
                </div>
            </div>
        </div>`;
    }

    // Update detail modal contents
    fillDetailModal(profile);
}

function infoRow(label, value, iconPath) {
    return `
    <div class="flex items-start gap-3">
        <span class="w-6 h-6 flex items-center justify-center rounded bg-gray-100">
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${iconPath}"/></svg>
        </span>
        <div>
            <p class="text-gray-500">${label}</p>
            <p class="font-medium text-gray-800 whitespace-pre-line">${value}</p>
        </div>
    </div>`;
}

function fillDetailModal(p) {
    const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val || '-'; };
    set('detail_kode_profile', p.kode_profile);
    set('detail_nama_perusahaan', p.nama_perusahaan);
    set('detail_slogan', p.slogan);
    set('detail_deskripsi', p.deskripsi);
    set('detail_visi', p.visi);
    set('detail_misi', p.misi);
    set('detail_alamat', p.alamat);
    set('detail_telepon', p.telepon);
    set('detail_email', p.email);
}

function formatDate(iso) {
    if (!iso) return '-';
    try { const d = new Date(iso); return d.toLocaleString('id-ID', { day:'2-digit', month:'short', year:'numeric', hour:'2-digit', minute:'2-digit' }); } catch { return '-'; }
}

// Toast notification (reused like kategori)
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
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">${icon}</svg>
        <span>${message}</span>
    `;
    document.body.appendChild(notification);
    setTimeout(() => { notification.classList.remove('translate-x-full'); }, 10);
    setTimeout(() => { notification.classList.add('translate-x-full'); setTimeout(() => notification.remove(), 300); }, 2500);
}
</script>