<script>

// ==================== JAVASCRIPT ====================
$(document).ready(function() {
    loadTestimoniTable();
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        loadTestimoniTable();
    });
    $('#resetFilterBtn').on('click', function() {
        $('#filterForm')[0].reset();
        loadTestimoniTable();
    });
    $('[data-toggle="tooltip"]').tooltip();
});

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

function loadTestimoniTable(page = 1) {
    let data = $('#filterForm').serialize() + '&page=' + page;
    $.ajax({
        url: '/admin/testimoni',
        type: 'GET',
        data: data,
        beforeSend: function() {
            $('#testimoniTableBody').html('<tr><td colspan="8" class="text-center"><div class="spinner-border"></div></td></tr>');
        },
        success: function(res) {
            $('#testimoniTableBody').html(res.tableHtml);
            $('#pagination').html(res.paginationHtml);
        },
        error: function() {
            $('#testimoniTableBody').html('<tr><td colspan="8" class="text-center text-danger">Gagal memuat data</td></tr>');
        }
    });
}

function openCreateModal() {
    $('#createModal').modal('show');
}
function closeCreateModal() {
    $('#createModal').modal('hide');
    $('#createTestimoniForm')[0].reset();
    $('#preview-create-img').attr('src', '#').addClass('d-none');
}
async function submitCreate(e) {
    e.preventDefault();
    const form = document.getElementById('createTestimoniForm');
    const submitBtn = document.getElementById('createSubmitBtn');
    const formData = new FormData(form);
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    try {
        const response = await fetch('/admin/testimoni', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok && result.success) {
            closeCreateModal();
            showNotification(result.message || 'Testimoni berhasil ditambahkan', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menambah testimoni', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
    }
}

function openEditModal(id) {
    $.get('/admin/testimoni/' + id + '/edit', function(res) {
        if(res.success && res.data) {
            const data = res.data;
            $('#edit_id').val(data.id_testimoni);
            $('#edit_nama_testimoni').val(data.nama_testimoni);
            $('#edit_jabatan').val(data.jabatan);
            $('#edit_pesan').val(data.pesan);
            $('#edit_rating').val(data.rating);
            $('#edit_status').val(data.status);
            if(data.foto_url) {
                $('#preview-edit-img').attr('src', data.foto_url).removeClass('d-none');
            } else {
                $('#preview-edit-img').attr('src', '#').addClass('d-none');
            }
            $('#editModal').modal('show');
        } else {
            toastr.error(res.message || 'Gagal mengambil data testimoni');
        }
    });
}
function closeEditModal() {
    $('#editModal').modal('hide');
    $('#editTestimoniForm')[0].reset();
    $('#preview-edit-img').attr('src', '#').addClass('d-none');
}
async function submitEdit(e) {
    e.preventDefault();
    const id = document.getElementById('edit_id').value;
    const form = document.getElementById('editTestimoniForm');
    const submitBtn = document.getElementById('editSubmitBtn');
    const formData = new FormData(form);
    formData.append('_method', 'PUT');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
    try {
        const response = await fetch('/admin/testimoni/' + id, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        const result = await response.json();
        if (response.ok && result.success) {
            closeEditModal();
            showNotification(result.message || 'Testimoni berhasil diupdate', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal mengupdate testimoni', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
    }
}

function openDetailModal(id) {
    $.get('/admin/testimoni/' + id, function(res) {
        if(res.success && res.data) {
            const data = res.data;
            $('#detail_nama_testimoni').text(data.nama_testimoni);
            $('#detail_jabatan').text(data.jabatan);
            $('#detail_status').text(data.status);
            $('#detail_rating').text(data.rating + ' Bintang');
            $('#detail_pesan').text(data.pesan);
            if(data.foto_url) {
                $('#detail_foto').attr('src', data.foto_url).removeClass('d-none');
            } else {
                $('#detail_foto').attr('src', '#').addClass('d-none');
            }
            $('#detailModal').modal('show');
        } else {
            toastr.error(res.message || 'Gagal mengambil detail testimoni');
        }
    });
}
function closeDetailModal() {
    $('#detailModal').modal('hide');
}

function openDeleteModal(id, nama) {
    $('#delete_testimoni_id').val(id);
    $('#delete_testimoni_name').text(nama);
    $('#deleteModal').modal('show');
}
function closeDeleteModal() {
    $('#deleteModal').modal('hide');
}
async function submitDelete(e) {
    e.preventDefault();
    const id = document.getElementById('delete_testimoni_id').value;
    const submitBtn = document.getElementById('deleteSubmitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
        const response = await fetch('/admin/testimoni/' + id, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ _method: 'DELETE', _token: $('input[name="_token"]').val() })
        });
        const result = await response.json();
        if (response.ok && result.success) {
            closeDeleteModal();
            showNotification(result.message || 'Testimoni berhasil dihapus', 'success');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus testimoni', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
    }
}

function goToPage(page) {
    loadTestimoniTable(page);
}
</script>
