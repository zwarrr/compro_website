
<script>
// ==================== JAVASCRIPT ====================

// MODAL MANAGEMENT FUNCTIONS
function openCreateModal() {
    $('#modalCreateFeatures').modal('show');
    $('#form-create-features')[0].reset();
    clearErrors('create');
}
function closeCreateModal() {
    $('#modalCreateFeatures').modal('hide');
}

async function showDetail(featuresId) {
    $('#modalDetailFeatures').modal('show');
    try {
        const response = await fetch(`/admin/features/${featuresId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        if (!response.ok) throw new Error('Gagal mengambil data');
        const result = await response.json();
    const features = result.features;
    $('#detail_kode_features').text(features.kode_features || '');
    $('#detail_judul').text(features.judul || '');
    $('#detail_sub_judul').text(features.sub_judul || '-');
    
    // Format replace_position
    const positionLabels = {
        1: 'Posisi 1: Aksesnya mudah',
        2: 'Posisi 2: Fitur Lengkap',
        3: 'Posisi 3: Komunitas Besar',
        4: 'Posisi 4: Aman & Terpercaya',
        5: 'Posisi 5: Cocok untuk semua kalangan',
        6: 'Posisi 6: Terjangkau'
    };
    $('#detail_replace_position').text(positionLabels[features.replace_position] || '-');
    
    $('#detail_status').text(features.status || '-');
    $('#detail_created_at').text(features.created_at_formatted || '-');
    $('#detail_updated_at').text(features.updated_at_formatted || '-');
    } catch (error) {
        showNotification('Gagal mengambil data features', 'error');
        closeDetailModal();
    }
}
function closeDetailModal() {
    $('#modalDetailFeatures').modal('hide');
}

async function openEditModal(featuresId) {
    $('#modalEditFeatures').modal('show');
    clearErrors('edit');
    try {
        const response = await fetch(`/admin/features/${featuresId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        if (!response.ok) throw new Error('Gagal mengambil data');
        const result = await response.json();
        const features = result.features;
    $('#edit_id_features').val(features.id_features);
    $('#edit_judul').val(features.judul);
    $('#edit_sub_judul').val(features.sub_judul);
    $('#edit_status').val(features.status);
    $('#edit_replace_position').val(features.replace_position);
    } catch (error) {
        showNotification('Gagal mengambil data features', 'error');
        closeEditModal();
    }
}
function closeEditModal() {
    $('#modalEditFeatures').modal('hide');
}

function confirmDelete(featuresId, featuresName) {
    $('#modalDeleteFeatures').modal('show');
    $('#delete_id_features').val(featuresId);
    // Optionally show name in modal
}
function closeDeleteModal() {
    $('#modalDeleteFeatures').modal('hide');
}

// FORM SUBMISSION FUNCTIONS
async function submitCreate(event) {
    event.preventDefault();
    const form = document.getElementById('form-create-features');
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    clearErrors('create');
    try {
        const response = await fetch('/admin/features', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'Features berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('create', result.errors);
            }
            showNotification(result.message || 'Gagal menambahkan features', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Simpan';
    }
}

async function submitEdit(event) {
    event.preventDefault();
    const form = document.getElementById('form-edit-features');
    const submitBtn = form.querySelector('button[type="submit"]');
    const featuresId = document.getElementById('edit_id_features').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    clearErrors('edit');
    try {
        const response = await fetch(`/admin/features/${featuresId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'Features berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate features', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Update';
    }
}


async function submitDelete(event) {
    event.preventDefault();
    const form = document.getElementById('form-delete-features');
    const submitBtn = document.getElementById('btn-confirm-delete-features');
    const featuresId = document.getElementById('delete_id_features').value;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
        const response = await fetch(`/admin/features/${featuresId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'Features berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus features', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Hapus';
    }
}

// HELPER FUNCTIONS
function clearErrors(prefix) {
    $(`[id^="error_${prefix}_"]`).addClass('hidden').text('');
    $(`#form-${prefix}-features .form-control`).removeClass('is-invalid');
}
function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_${prefix}_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
            $(`#form-${prefix}-features [name="${field}"]`).addClass('is-invalid');
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

// Auto submit on search input (with debounce)
let searchTimeout;
$('#searchInputFeatures').on('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        $('#filterFormFeatures').submit();
    }, 500);
});

// Sort Direction Toggle
$(document).on('click', '#sortDirectionBtnFeatures', function() {
    var dir = $('#directionInputFeatures').val() === 'asc' ? 'desc' : 'asc';
    $('#directionInputFeatures').val(dir);
    $('#sortArrowFeatures').html(dir === 'desc' ? '&#8595;' : '&#8593;');
    $('#filterFormFeatures').submit();
});

// Initialize tooltips
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

// Bind form submit
$('#form-create-features').on('submit', submitCreate);
$('#form-edit-features').on('submit', submitEdit);
$('#form-delete-features').on('submit', submitDelete);
</script>
