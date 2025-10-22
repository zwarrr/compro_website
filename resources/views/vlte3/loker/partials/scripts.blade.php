<script>
// ==================== MODAL MANAGEMENT ====================
function openCreateModal() {
    $('#createModal').modal('show');
    $('#createLokerForm')[0].reset();
    clearErrors('create');
}
function closeCreateModal() {
    $('#createModal').modal('hide');
}
async function submitCreate(event) {
    event.preventDefault();
    const form = document.getElementById('createLokerForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const formData = new FormData(form);
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    clearErrors('create');
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        let result = null;
        try {
            result = await response.json();
        } catch (e) {
            console.error('Non-JSON response for create', e);
        }
        if (response.ok) {
            showNotification((result && result.message) || 'Loker berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 900);
        } else {
            if (result && result.errors) {
                displayErrors('create', result.errors);
            }
            const msg = result && result.message ? result.message : 'Gagal menambah loker';
            showNotification(msg, 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
    }
}
async function showDetail(lokerId) {
    $('#detailModal').modal('show');
    $('#detailData').addClass('hidden');
    try {
        const response = await fetch(`{{ url('admin/loker') }}/${lokerId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        if (!response.ok) throw new Error('Gagal mengambil data');
        let result = null;
        try { result = await response.json(); } catch (e) { console.error('showDetail non-json', e); }
        const loker = (result && (result.loker || result.data)) || result || {};
        $('#detail_id').val(loker.id_loker || '');
        $('#detail_kode').val(loker.kode_loker || '');
        $('#detail_posisi').val(loker.posisi || '');
        $('#detail_perusahaan').val(loker.perusahaan || '');
        $('#detail_lokasi').val(loker.lokasi || '');
        $('#detail_gaji').val(loker.gaji_awal && loker.gaji_akhir ? `Rp${loker.gaji_awal} - Rp${loker.gaji_akhir}` : '-');
        $('#detail_deskripsi').val(loker.deskripsi || '');
        $('#detail_pengalaman').val(loker.pengalaman || '');
        $('#detail_pendidikan').val(loker.pendidikan || '');
        $('#detail_status').val(loker.status || '');
        $('#detail_created_at').val(loker.created_at_formatted || loker.created_at || '');
        $('#detail_updated_at').val(loker.updated_at_formatted || loker.updated_at || '');
        $('#detailData').removeClass('hidden');
    } catch (error) {
        showNotification('Gagal mengambil data loker', 'error');
        closeDetailModal();
    }
}
function closeDetailModal() {
    $('#detailModal').modal('hide');
}
async function openEditModal(lokerId) {
    $('#editModal').modal('show');
    clearErrors('edit');
    try {
        const response = await fetch(`/admin/loker/${lokerId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        if (!response.ok) throw new Error('Gagal mengambil data');
        let result = null;
        try { result = await response.json(); } catch (e) { console.error('openEditModal non-json', e); }
        const loker = (result && (result.loker || result.data)) || result || {};
        $('#edit_id').val(loker.id_loker || '');
        $('#edit_posisi').val(loker.posisi || '');
        $('#edit_perusahaan').val(loker.perusahaan || '');
        $('#edit_lokasi').val(loker.lokasi || '');
        $('#edit_deskripsi').val(loker.deskripsi || '');
        $('#edit_gaji_awal').val(loker.gaji_awal || '');
        $('#edit_gaji_akhir').val(loker.gaji_akhir || '');
        $('#edit_pengalaman').val(loker.pengalaman || '');
        $('#edit_pendidikan').val(loker.pendidikan || '');
        $('#edit_status').val(loker.status || '');
        // set form action so it's clear and for non-JS fallback (optional)
        const idForAction = loker.id_loker || loker.id || lokerId;
        $('#editLokerForm').attr('action', `/admin/loker/${idForAction}`);
    } catch (error) {
        showNotification('Gagal mengambil data loker', 'error');
        closeEditModal();
    }
}
function closeEditModal() {
    $('#editModal').modal('hide');
}
async function submitEdit(event) {
    event.preventDefault();
    const form = document.getElementById('editLokerForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const lokerId = document.getElementById('edit_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    clearErrors('edit');
    try {
        const response = await fetch(`/admin/loker/${lokerId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        let result = null;
        try { result = await response.json(); } catch (e) { console.error('submitEdit non-json', e); }
        if (response.ok) {
            showNotification((result && result.message) || 'Loker berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 900);
        } else {
            if (result && result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification((result && result.message) || 'Gagal mengupdate loker', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Update';
    }
}
// Delete via button click (not form submit)
async function submitDeleteLoker() {
    const btn = document.getElementById('deleteSubmitBtn');
    const lokerIdEl = document.getElementById('delete_loker_id');
    const lokerId = lokerIdEl ? lokerIdEl.value : null;
    if (!lokerId) { showNotification('ID loker tidak valid', 'error'); return; }
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
        const response = await fetch(`/admin/loker/${lokerId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        let result = null;
        try { result = await response.json(); } catch (e) { console.error('submitDeleteLoker non-json', e); }
        if (response.ok) {
            showNotification((result && result.message) || 'Loker berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 900);
        } else {
            showNotification((result && result.message) || 'Gagal menghapus loker', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
    }
}
function confirmDelete(lokerId, posisi) {
    $('#deleteModal').modal('show');
    $('#delete_loker_id').val(lokerId);
    $('#delete_loker_posisi').text(posisi);
}
function closeDeleteModal() {
    $('#deleteModal').modal('hide');
}
function clearErrors(prefix) {
    $(`[id^="error_${prefix}_"]`).addClass('hidden').text('');
    $(`#${prefix}LokerForm .form-control`).removeClass('is-invalid');
}
function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_${prefix}_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
            $(`#${prefix}LokerForm [name="${field}"]`).addClass('is-invalid');
        }
    }
}
function showNotification(message, type = 'success') {
    $('#notification').remove();
    const icon = type === 'success' ?
        '<i class="fas fa-check-circle mr-2"></i>' :
        '<i class="fas fa-exclamation-circle mr-2"></i>';
    const notification = $(`
        <div id="notification" class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            ${icon}${message}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
    $('body').append(notification);
    setTimeout(() => {
        notification.alert('close');
    }, 5000);
}

// attach form submit handlers and delete button click
(function attachFormHandlers() {
    try {
        const createForm = document.getElementById('createLokerForm');
        const editForm = document.getElementById('editLokerForm');
        if (createForm) createForm.addEventListener('submit', submitCreate);
        if (editForm) editForm.addEventListener('submit', submitEdit);
        // Attach click handler for delete button
        $(document).on('click', '#deleteSubmitBtn', function(e) {
            e.preventDefault();
            submitDeleteLoker();
        });
    } catch (e) {
        console.error('Gagal memasang event listener form loker', e);
    }
})();
</script>
