<script>
// ==================== TABLE LOAD & FILTER ====================
function loadFaqTable(url = null) {
    const form = document.getElementById('filterForm');
    let fetchUrl = url || form.action;
    let params = new URLSearchParams(new FormData(form)).toString();
    if (fetchUrl.indexOf('?') === -1) {
        fetchUrl += '?' + params;
    } else {
        fetchUrl += '&' + params;
    }
    $('#faqTableBody').html('<tr><td colspan="6" class="text-center"><div class="spinner-border"></div></td></tr>');
    fetch(fetchUrl, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(res => res.json())
    .then(data => {
        $('#faqTableBody').html(data.tableHtml);
        $('#pagination').html(data.paginationHtml);
    })
    .catch(() => {
        $('#faqTableBody').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>');
    });
}

// On page load
$(document).ready(function() {
    loadFaqTable();
    // Filter submit
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        loadFaqTable();
    });
    // Pagination click
    $(document).on('click', '#pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        if (url) loadFaqTable(url);
    });
});
// ==================== MODAL MANAGEMENT ====================
function openCreateModal() {
    $('#createModal').modal('show');
    $('#createFaqForm')[0].reset();
    clearErrors('create');
}
function closeCreateModal() {
    $('#createModal').modal('hide');
}
async function showDetail(faqId) {
    $('#detailModal').modal('show');
    $('#detailData').addClass('hidden');
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
        $('#detail_id').val(faq.id_faq);
        $('#detail_kode').val(faq.kode_faq);
        $('#detail_pertanyaan').val(faq.pertanyaan);
        $('#detail_jawaban').val(faq.jawaban);
        $('#detail_status').val(faq.status);
        $('#detail_created_at').val(faq.created_at);
        $('#detail_updated_at').val(faq.updated_at);
        $('#detailData').removeClass('hidden');
    } catch (error) {
        showNotification('Gagal mengambil data FAQ', 'error');
        closeDetailModal();
    }
}
function closeDetailModal() {
    $('#detailModal').modal('hide');
}
async function openEditModal(faqId) {
    $('#editModal').modal('show');
    $('#editFormContent').addClass('hidden');
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
        $('#edit_id').val(faq.id_faq);
        $('#edit_pertanyaan').val(faq.pertanyaan);
        $('#edit_jawaban').val(faq.jawaban);
        $('#edit_status').val(faq.status);
        $('#editFormContent').removeClass('hidden');
    } catch (error) {
        showNotification('Gagal mengambil data FAQ', 'error');
        closeEditModal();
    }
}
function closeEditModal() {
    $('#editModal').modal('hide');
}
function confirmDelete(faqId, pertanyaan) {
    $('#deleteModal').modal('show');
    $('#delete_faq_id').val(faqId);
    $('#delete_faq_pertanyaan').text(pertanyaan);
}
function closeDeleteModal() {
    $('#deleteModal').modal('hide');
}
// ==================== FORM SUBMISSION ====================
async function submitCreate(event) {
    event.preventDefault();
    const form = document.getElementById('createFaqForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const formData = new FormData(form);
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    clearErrors('create');
    try {
        const response = await fetch('{{ route('admin.faq.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'FAQ berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('create', result.errors);
            }
            showNotification(result.message || 'Gagal menambah FAQ', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
    }
}
async function submitEdit(event) {
    event.preventDefault();
    const form = document.getElementById('editFaqForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const faqId = document.getElementById('edit_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    clearErrors('edit');
    try {
        const response = await fetch(`{{ url('admin/faq') }}/${faqId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'FAQ berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate FAQ', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Update';
    }
}
async function submitDelete(event) {
    event.preventDefault();
    const submitBtn = document.getElementById('deleteSubmitBtn');
    const faqId = document.getElementById('delete_faq_id').value;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
        const response = await fetch(`{{ url('admin/faq') }}/${faqId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'FAQ berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus FAQ', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
    }
}
// ==================== HELPER ====================
function clearErrors(prefix) {
    $(`[id^="error_${prefix}_"]`).addClass('hidden').text('');
    $(`#${prefix}FaqForm .form-control`).removeClass('is-invalid');
}
function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_${prefix}_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
            $(`#${prefix}FaqForm [name="${field}"]`).addClass('is-invalid');
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
$('#searchInput').on('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        $('#filterForm').submit();
    }, 500);
});
</script>