<script>
// ==================== JAVASCRIPT ====================
function showNotification(message, type = 'success') {
    jQuery('#notification').remove();
    const icon = type === 'success' ? '<i class="fas fa-check-circle mr-2"></i>' : '<i class="fas fa-exclamation-circle mr-2"></i>';
    const notification = jQuery(`
        <div id="notification" class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            ${icon}${message}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
    jQuery('body').append(notification);
    setTimeout(() => {
        notification.alert('close');
    }, 5000);
}

function openCreateModal() {
    jQuery('#modal-create').modal('show');
    jQuery('#form-create-pengetahuan')[0].reset();
    clearErrors('create');
    // Fetch next kode_pengetahuan from backend and autofill
    fetch('/admin/pengetahuan/next-kode')
        .then(res => res.json())
        .then(data => {
            jQuery('#create-kode-pengetahuan').val(data.kode_pengetahuan || '(otomatis)');
        });
}
function closeCreateModal() {
    jQuery('#modal-create').modal('hide');
}
async function showDetail(id) {
    jQuery('#modal-detail').modal('show');
    try {
        const response = await fetch(`{{ url('admin/pengetahuan') }}/${id}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        const res = await response.json();
        if (!res.success) throw res.message;
        jQuery('#detail-kode_pengetahuan').text(res.pengetahuan.kode_pengetahuan);
        jQuery('#detail-kategori_pertanyaan').text(res.pengetahuan.kategori_pertanyaan);
        jQuery('#detail-sub_kategori').text(res.pengetahuan.sub_kategori);
        jQuery('#detail-jawaban').text(res.pengetahuan.jawaban);
    } catch (err) {
        showNotification('Gagal mengambil detail', 'danger');
        console.error('Detail error:', err);
        closeDetailModal();
    }
}
function closeDetailModal() {
    jQuery('#modal-detail').modal('hide');
}
async function openEditModal(id) {
    jQuery('#modal-edit').modal('show');
    clearErrors('edit');
    try {
        const response = await fetch(`{{ url('admin/pengetahuan') }}/${id}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        const res = await response.json();
        if (!res.success) throw res.message;
        jQuery('#edit-id-pengetahuan').val(res.pengetahuan.id_pengetahuan);
        jQuery('#edit-kode_pengetahuan').val(res.pengetahuan.kode_pengetahuan);
        jQuery('#edit-kategori_pertanyaan').val(res.pengetahuan.kategori_pertanyaan);
        jQuery('#edit-sub_kategori').val(res.pengetahuan.sub_kategori);
        jQuery('#edit-jawaban').val(res.pengetahuan.jawaban);
    } catch (err) {
        showNotification('Gagal mengambil data edit', 'danger');
        console.error('Edit error:', err);
        closeEditModal();
    }
}
function closeEditModal() {
    jQuery('#modal-edit').modal('hide');
}
function confirmDelete(id) {
    jQuery('#modal-delete').modal('show');
    jQuery('#delete-id-pengetahuan').val(id);
}
function closeDeleteModal() {
    jQuery('#modal-delete').modal('hide');
}

async function submitCreate(event) {
    event.preventDefault();
    const form = document.getElementById('form-create-pengetahuan');
    const submitBtn = form.querySelector('button[type="submit"]');
    const formData = new FormData(form);
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    clearErrors('create');
    try {
        const response = await fetch(`{{ route('admin.pengetahuan.store') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const res = await response.json();
        if (response.ok && res.success) {
            showNotification(res.message || 'Pengetahuan berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (res.errors) {
                displayErrors('create', res.errors);
            }
            showNotification(res.message || 'Gagal menambah pengetahuan', 'danger');
        }
    } catch (err) {
        showNotification('Terjadi kesalahan pada server', 'danger');
        console.error('Create error:', err);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Simpan';
    }
}

async function submitEdit(event) {
    event.preventDefault();
    const form = document.getElementById('form-edit-pengetahuan');
    const submitBtn = form.querySelector('button[type="submit"]');
    const id = jQuery('#edit-id-pengetahuan').val();
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    clearErrors('edit');
    try {
        const response = await fetch(`{{ url('admin/pengetahuan') }}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const res = await response.json();
        if (response.ok && res.success) {
            showNotification(res.message || 'Pengetahuan berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (res.errors) {
                displayErrors('edit', res.errors);
            }
            showNotification(res.message || 'Gagal mengupdate pengetahuan', 'danger');
        }
    } catch (err) {
        showNotification('Terjadi kesalahan pada server', 'danger');
        console.error('Edit error:', err);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Update';
    }
}

async function submitDelete(event) {
    event.preventDefault();
    const form = document.getElementById('form-delete-pengetahuan');
    const submitBtn = form.querySelector('button[type="submit"]');
    const id = jQuery('#delete-id-pengetahuan').val();
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
        const response = await fetch(`{{ url('admin/pengetahuan') }}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        const res = await response.json();
        if (response.ok && res.success) {
            showNotification(res.message || 'Pengetahuan berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(res.message || 'Gagal menghapus pengetahuan', 'danger');
        }
    } catch (err) {
        showNotification('Terjadi kesalahan pada server', 'danger');
        console.error('Delete error:', err);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Hapus';
    }
}

function clearErrors(prefix) {
    jQuery(`[id^="error_${prefix}_"]`).addClass('d-none').text('');
    jQuery(`#form-${prefix}-pengetahuan .form-control`).removeClass('is-invalid');
}

function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        jQuery(`#error_${prefix}_${field}`).removeClass('d-none').text(messages[0]);
        jQuery(`#form-${prefix}-pengetahuan [name='${field}']`).addClass('is-invalid');
    }
}

// Initialize when page is ready
jQuery(function() {
    // Modal triggers
    jQuery(document).on('click', '[data-toggle="modal-create"]', openCreateModal);
    jQuery(document).on('click', '[data-toggle="modal-detail"]', function() {
        showDetail(jQuery(this).data('id'));
    });
    jQuery(document).on('click', '[data-toggle="modal-edit"]', function() {
        openEditModal(jQuery(this).data('id'));
    });
    jQuery(document).on('click', '[data-toggle="modal-delete"]', function() {
        confirmDelete(jQuery(this).data('id'));
    });

    // Form submits
    jQuery('#form-create-pengetahuan').off('submit').on('submit', submitCreate);
    jQuery('#form-edit-pengetahuan').off('submit').on('submit', submitEdit);
    jQuery('#form-delete-pengetahuan').off('submit').on('submit', submitDelete);

    // Tooltip
    jQuery('[data-toggle="tooltip"]').tooltip();
});
</script>
