<script>
// ==================== MODAL MANAGEMENT ====================
function openCreateModal() {
    $('#createModal').modal('show');
    document.getElementById('createClientForm').reset();
    clearErrors('create');
    $('#preview-create-img').attr('src', '#').addClass('d-none');
}
function closeCreateModal() {
    $('#createModal').modal('hide');
}

function openEditModal(id) {
    $('#editModal').modal('show');
    $('#editFormContent').addClass('hidden');
    clearErrors('edit');
    fetch(`/admin/client/${id}/edit`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(res => res.json())
    .then(res => {
        if (res.success && res.data) {
            const data = res.data;
            $('#edit_id').val(data.id_client);
            $('#edit_kategori_id').val(data.kategori_id);
            $('#edit_nama').val(data.nama_client);
            $('#edit_website').val(data.website);
            $('#edit_deskripsi').val(data.deskripsi);
            $('#edit_status').val(data.status);
            if(data.logo) {
                $('#preview-edit-img').attr('src', data.logo).removeClass('d-none');
            } else {
                $('#preview-edit-img').attr('src', '#').addClass('d-none');
            }
            $('#editFormContent').removeClass('hidden');
        } else {
            showNotification('Gagal mengambil data client', 'error');
            closeEditModal();
        }
    })
    .catch(() => {
        showNotification('Gagal mengambil data client', 'error');
        closeEditModal();
    });
}
function closeEditModal() {
    $('#editModal').modal('hide');
}

function openDetailModal(id) {
    $('#detailModal').modal('show');
    $('#detailData').addClass('hidden');
    fetch(`/admin/client/${id}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(res => res.json())
    .then(res => {
        if (res.success && res.data) {
            const data = res.data;
            $('#detail_nama').text(data.nama_client);
            $('#detail_kategori').text(data.kategori_nama || '-');
            $('#detail_website').text(data.website || '-');
            $('#detail_deskripsi').text(data.deskripsi || '-');
            $('#detail_status').text(data.status === 'publik' ? 'Aktif' : 'Nonaktif');
            $('#detail_created_at').text(data.created_at_formatted || '-');
            $('#detail_updated_at').text(data.updated_at_formatted || '-');
            if(data.logo) {
                $('#detail_logo').attr('src', data.logo).removeClass('d-none');
            } else {
                $('#detail_logo').attr('src', '#').addClass('d-none');
            }
            $('#detailData').removeClass('hidden');
        } else {
            showNotification('Gagal mengambil data client', 'error');
            closeDetailModal();
        }
    })
    .catch(() => {
        showNotification('Gagal mengambil data client', 'error');
        closeDetailModal();
    });
}
function closeDetailModal() {
    $('#detailModal').modal('hide');
}

function openDeleteModal(id, nama) {
    $('#deleteModal').modal('show');
    $('#delete_client_id').val(id);
    $('#delete_client_name').text(nama);
}
function closeDeleteModal() {
    $('#deleteModal').modal('hide');
}

// ==================== FORM SUBMISSION ====================
async function submitCreate(e) {
    e.preventDefault();
    const form = document.getElementById('createClientForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const formData = new FormData(form);
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    clearErrors('create');
    try {
        const response = await fetch('/admin/client', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'Client berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('create', result.errors);
            }
            showNotification(result.message || 'Gagal menambah client', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
    }
}

async function submitEdit(e) {
    e.preventDefault();
    const form = document.getElementById('editClientForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const id = document.getElementById('edit_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    clearErrors('edit');
    try {
        const response = await fetch(`/admin/client/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'Client berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate client', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Update';
    }
}

async function submitDelete(e) {
    e.preventDefault();
    const submitBtn = document.getElementById('deleteSubmitBtn');
    const id = document.getElementById('delete_client_id').value;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
        const response = await fetch(`/admin/client/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'Client berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus client', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
    }
}

// ==================== HELPER FUNCTIONS ====================
function clearErrors(prefix) {
    $(`[id^="error_${prefix}_"]`).addClass('hidden').text('');
    $(`#${prefix}ClientForm .form-control`).removeClass('is-invalid');
}
function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_${prefix}_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
            $(`#${prefix}ClientForm [name="${field}"]`).addClass('is-invalid');
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

// ==================== TABLE & FILTER ====================
async function loadClientTable(page = 1) {
    const form = document.getElementById('filterForm');
    const params = new URLSearchParams(new FormData(form));
    params.append('page', page);
    $('#clientTableBody').html('<tr><td colspan="8" class="text-center"><div class="spinner-border"></div></td></tr>');
    try {
        const response = await fetch(`/admin/client?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        });
        const res = await response.json();
        $('#clientTableBody').html($(res.tableHtml).find('tbody').html());
        $('#pagination').html(res.paginationHtml);
    } catch (error) {
        $('#clientTableBody').html('<tr><td colspan="8" class="text-center text-danger">Gagal memuat data</td></tr>');
    }
}

function goToPage(page) {
    loadClientTable(page);
}

// ==================== FILTER EVENTS ====================
$(document).ready(function() {
    loadClientTable();
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        loadClientTable();
    });
    $('#resetFilterBtn').on('click', function() {
        $('#filterForm')[0].reset();
        loadClientTable();
    });
    // Auto submit on search input (with debounce)
    let searchTimeout;
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            $('#filterForm').submit();
        }, 500);
    });
    // Sort Direction Toggle
    $(document).on('click', '#sortDirectionBtn', function () {
        var dir = $('#sortDirection').val() === 'asc' ? 'desc' : 'asc';
        $('#sortDirection').val(dir);
        $('#sortDirectionIcon').toggleClass('fa-arrow-up fa-arrow-down');
        $('#filterForm').submit();
    });
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
