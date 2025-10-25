<script>
// ==================== JAVASCRIPT ====================
function showNotification(message, type = 'success') {
    $('#notification').remove();
    const icon = type === 'success' ? '<i class="fas fa-check-circle mr-2"></i>' : '<i class="fas fa-exclamation-circle mr-2"></i>';
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

function openCreateModal() {
    $('#modal-create').modal('show');
    $('#form-create-pengetahuan')[0].reset();
    clearErrors('create');
    // Fetch next kode_pengetahuan from backend and autofill
    fetch('/admin/pengetahuan/next-kode')
        .then(res => res.json())
        .then(data => {
            $('#create-kode-pengetahuan').val(data.kode_pengetahuan || '(otomatis)');
        });
}
function closeCreateModal() {
    $('#modal-create').modal('hide');
}
async function showDetail(id) {
    $('#modal-detail').modal('show');
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
        $('#detail-kode_pengetahuan').text(res.pengetahuan.kode_pengetahuan);
        $('#detail-kategori_pertanyaan').text(res.pengetahuan.kategori_pertanyaan);
        $('#detail-sub_kategori').text(res.pengetahuan.sub_kategori);
        $('#detail-jawaban').text(res.pengetahuan.jawaban);
    } catch (err) {
        showNotification('Gagal mengambil detail', 'danger');
        console.error('Detail error:', err);
        closeDetailModal();
    }
}
function closeDetailModal() {
    $('#modal-detail').modal('hide');
}
async function openEditModal(id) {
    $('#modal-edit').modal('show');
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
        $('#edit-id-pengetahuan').val(res.pengetahuan.id_pengetahuan);
        $('#edit-kode_pengetahuan').val(res.pengetahuan.kode_pengetahuan);
        $('#edit-kategori_pertanyaan').val(res.pengetahuan.kategori_pertanyaan);
        $('#edit-sub_kategori').val(res.pengetahuan.sub_kategori);
        $('#edit-jawaban').val(res.pengetahuan.jawaban);
    } catch (err) {
        showNotification('Gagal mengambil data edit', 'danger');
        console.error('Edit error:', err);
        closeEditModal();
    }
}
function closeEditModal() {
    $('#modal-edit').modal('hide');
}
function confirmDelete(id) {
    $('#modal-delete').modal('show');
    $('#delete-id-pengetahuan').val(id);
}
function closeDeleteModal() {
    $('#modal-delete').modal('hide');
}

async function submitCreate(event) {
    event.preventDefault();
    const form = document.getElementById('form-create-pengetahuan');
    const submitBtn = form.querySelector('button[type="submit"]');
    const formData = new FormData(form);
    submitBtn.disabled = true;
    submitBtn.innerHTd
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
    const id = $('#edit-id-pengetahuan').val();
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
    const id = $('#delete-id-pengetahuan').val();
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
    $(`[id^="error_${prefix}_"]`).addClass('d-none').text('');
    $(`#form-${prefix}-pengetahuan .form-control`).removeClass('is-invalid');
}
function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        $(`#error_${prefix}_${field}`).removeClass('d-none').text(messages[0]);
        $(`#form-${prefix}-pengetahuan [name='${field}']`).addClass('is-invalid');
    }
}

$(function() {
    // Modal triggers
    $(document).on('click', '[data-toggle="modal-create"]', openCreateModal);
    $(document).on('click', '[data-toggle="modal-detail"]', function() {
        showDetail($(this).data('id'));
    });
    $(document).on('click', '[data-toggle="modal-edit"]', function() {
        openEditModal($(this).data('id'));
    });
    $(document).on('click', '[data-toggle="modal-delete"]', function() {
        confirmDelete($(this).data('id'));
    });

    // Form submits
    $('#form-create-pengetahuan').off('submit').on('submit', submitCreate);
    $('#form-edit-pengetahuan').off('submit').on('submit', submitEdit);
    $('#form-delete-pengetahuan').off('submit').on('submit', submitDelete);

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
