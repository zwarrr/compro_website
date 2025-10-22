<script>
// Modal Management
function openCreateModal() {
    $('#createModal').modal('show');
    $('#createGaleriForm')[0].reset();
    clearErrors('create');
}
function closeCreateModal() {
    $('#createModal').modal('hide');
}
async function showDetail(galeriId) {
    $('#detailModal').modal('show');
    $('#detailData').addClass('hidden');
    try {
        const response = await fetch(`{{ url('admin/galeri') }}/${galeriId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        if (!response.ok) throw new Error('Gagal mengambil data');
        const result = await response.json();
        const galeri = result.galeri;
        document.getElementById('detail_id').value = galeri.id_galeri || '';
        document.getElementById('detail_kode').value = galeri.kode_galeri || '';
        document.getElementById('detail_judul').value = galeri.judul || '';
        document.getElementById('detail_kategori').value = galeri.kategori_nama || '';
        document.getElementById('detail_status').value = galeri.status || '';
        document.getElementById('detail_deskripsi').value = galeri.deskripsi || '';
        document.getElementById('detail_created_at').value = galeri.created_at_formatted || '';
        document.getElementById('detail_gambar').innerHTML = galeri.gambar_url ? `<img src='${galeri.gambar_url}' class='img-fluid rounded shadow-sm' style='max-height:150px;max-width:100%;object-fit:contain;'>` : '-';
        $('#detailData').removeClass('hidden');
    } catch (error) {
        showNotification('Gagal mengambil data galeri', 'error');
        closeDetailModal();
    }
}
function closeDetailModal() {
    $('#detailModal').modal('hide');
}
async function openEditModal(galeriId) {
    $('#editModal').modal('show');
    clearErrors('edit');
    try {
        const response = await fetch(`{{ url('admin/galeri') }}/${galeriId}/edit`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        if (!response.ok) throw new Error('Gagal mengambil data');
        const result = await response.json();
        const galeri = result.galeri;
        $('#edit_id').val(galeri.id_galeri);
        $('#edit_kategori_id').val(galeri.kategori_id);
        $('#edit_judul').val(galeri.judul);
        $('#edit_deskripsi').val(galeri.deskripsi);
        $('#edit_status').val(galeri.status);
        // Optionally set preview image if available
        if (galeri.gambar) {
            $('#preview-edit-img').attr('src', galeri.gambar_url).removeClass('d-none');
        } else {
            $('#preview-edit-img').attr('src', '#').addClass('d-none');
        }
    } catch (error) {
        showNotification('Gagal mengambil data galeri', 'error');
        closeEditModal();
    }
}
function closeEditModal() {
    $('#editModal').modal('hide');
}
function confirmDelete(galeriId, galeriName) {
    $('#deleteModal').modal('show');
    $('#delete_galeri_id').val(galeriId);
    $('#delete_galeri_name').text(galeriName);
}
function closeDeleteModal() {
    $('#deleteModal').modal('hide');
}
// Form Submission (AJAX)
async function submitCreate(event) {
    event.preventDefault();
    const form = document.getElementById('createGaleriForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const formData = new FormData(form);
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    clearErrors('create');
    try {
        const response = await fetch('{{ route('admin.galeri.store') }}', {
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
            showNotification(result.message || 'Galeri berhasil ditambahkan', 'success');
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('create', result.errors);
            }
            showNotification(result.message || 'Gagal menambahkan galeri', 'error');
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
    const form = document.getElementById('editGaleriForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const galeriId = document.getElementById('edit_id').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    clearErrors('edit');
    try {
        const response = await fetch(`{{ url('admin/galeri') }}/${galeriId}`, {
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
            showNotification(result.message || 'Galeri berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors('edit', result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate galeri', 'error');
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
    const galeriId = document.getElementById('delete_galeri_id').value;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
        const response = await fetch(`{{ url('admin/galeri') }}/${galeriId}`, {
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
            showNotification(result.message || 'Galeri berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus galeri', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
    }
}
// Helpers
function clearErrors(prefix) {
    $(`[id^="error_${prefix}_"]`).addClass('hidden').text('');
    $(`#${prefix}GaleriForm .form-control`).removeClass('is-invalid');
}
function displayErrors(prefix, errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_${prefix}_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
            $(`#${prefix}GaleriForm [name="${field}"]`).addClass('is-invalid');
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
// Sort Direction Toggle
$(document).on('click', '#sortDirectionBtn', function () {
    var dir = $('#sortDirection').val() === 'asc' ? 'desc' : 'asc';
    $('#sortDirection').val(dir);
    $('#sortDirectionIcon').toggleClass('fa-arrow-up fa-arrow-down');
    $('#filterForm').submit();
});
// Initialize tooltips
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
