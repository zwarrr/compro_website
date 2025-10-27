<script>
    // ==================== JAVASCRIPT ====================
    // MODAL MANAGEMENT FUNCTIONS

    function openCreateModal() {
        $('#modalCreate').modal('show');
        $('#createPageForm')[0].reset();
        clearErrors('create');
    }

    function closeCreateModal() {
        $('#modalCreate').modal('hide');
    }

    async function showDetail(pageId) {
        $('#modalDetail').modal('show');
        $('#detailData').addClass('hidden');
        try {
            const response = await fetch(`/admin/page/${pageId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            if (!response.ok) throw new Error('Gagal mengambil data');
            const result = await response.json();
            const page = result.page;
            $('#detail_kode').val(page.kode_page || '');
            $('#detail_digunakan_untuk').val(page.digunakan_untuk || '');
            $('#detail_judul').val(page.judul || '');
            $('#detail_ilustrasi').val(page.ilustrasi ? page.ilustrasi.judul : '-');
            $('#detail_status').val(page.status || '');
            $('#detail_sub_judul').val(page.sub_judul || '');
            $('#detail_deskripsi').val(page.deskripsi || '');
            $('#detail_button_primary_text').val(page.button_primary_text || '');
            $('#detail_button_primary_link').val(page.button_primary_link || '');
            $('#detail_button_secondary_text').val(page.button_secondary_text || '');
            $('#detail_button_secondary_link').val(page.button_secondary_link || '');
            $('#detail_created_at').val(page.created_at_formatted || '');
            $('#detail_updated_at').val(page.updated_at_formatted || '');
            $('#detail_image').html((page.ilustrasi && page.ilustrasi.image_url) ?
                `<img src='${page.ilustrasi.image_url}' class='img-fluid rounded shadow-sm' style='max-height:150px;max-width:100%;object-fit:contain;'>` :
                '-');
            $('#detailData').removeClass('hidden');
        } catch (error) {
            showNotification('Gagal mengambil data page', 'error');
            closeDetailModal();
        }
    }

    function closeDetailModal() {
        $('#modalDetail').modal('hide');
    }

    async function openEditModal(pageId) {
        $('#modalEdit').modal('show');
        $('#editFormContent').addClass('hidden');
        clearErrors('edit');
        try {
            const response = await fetch(`/admin/page/${pageId}/edit`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            if (!response.ok) throw new Error('Gagal mengambil data');
            const result = await response.json();
            const page = result.page;
            $('#edit_id').val(page.id_page);
            $('#edit_kode_page').val(page.kode_page || '');
            $('#edit_digunakan_untuk').val(page.digunakan_untuk || '');
            $('#edit_ilustrasi_id').val(page.ilustrasi_id);
            $('#edit_judul').val(page.judul);
            $('#edit_sub_judul').val(page.sub_judul);
            $('#edit_deskripsi').val(page.deskripsi);
            $('#edit_status').val(page.status);
            $('#edit_button_primary_text').val(page.button_primary_text);
            $('#edit_button_primary_link').val(page.button_primary_link);
            $('#edit_button_secondary_text').val(page.button_secondary_text);
            $('#edit_button_secondary_link').val(page.button_secondary_link);
            // Preview image dari ilustrasi
            if (page.ilustrasi && page.ilustrasi.image_url) {
                $('#preview-edit-img').attr('src', page.ilustrasi.image_url).removeClass('d-none');
            } else {
                $('#preview-edit-img').attr('src', '#').addClass('d-none');
            }
            $('#editFormContent').removeClass('hidden');
        } catch (error) {
            showNotification('Gagal mengambil data page', 'error');
            closeEditModal();
        }
    }

    function closeEditModal() {
        $('#modalEdit').modal('hide');
    }

    function confirmDelete(pageId, pageName) {
        $('#modalDelete').modal('show');
        $('#delete_page_id').val(pageId);
        $('#delete_page_name').val(pageName);
        // Ambil data image ilustrasi untuk preview
        fetch(`/admin/page/${pageId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(result => {
                const page = result.page;
                if (page.ilustrasi && page.ilustrasi.image_url) {
                    $('#delete_image').html(
                        `<img src='${page.ilustrasi.image_url}' class='img-fluid rounded shadow-sm' style='max-height:100px;max-width:100%;object-fit:contain;'>`
                        );
                } else {
                    $('#delete_image').html('-');
                }
            });
    }

    function closeDeleteModal() {
        $('#modalDelete').modal('hide');
    }

    // FORM SUBMISSION FUNCTIONS
    async function submitCreate(event) {
        event.preventDefault();
        const form = document.getElementById('createPageForm');
        const submitBtn = document.getElementById('createSubmitBtn');
        const formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        clearErrors('create');
        try {
            const response = await fetch('/admin/page', {
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
                showNotification(result.message || 'Page berhasil ditambahkan', 'success');
                closeCreateModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors('create', result.errors);
                }
                showNotification(result.message || 'Gagal menambahkan page', 'error');
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
        const form = document.getElementById('editPageForm');
        const submitBtn = document.getElementById('editSubmitBtn');
        const pageId = document.getElementById('edit_id').value;
        const formData = new FormData(form);
        formData.append('_method', 'PUT');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
        clearErrors('edit');
        try {
            const response = await fetch(`/admin/page/${pageId}`, {
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
                showNotification(result.message || 'Page berhasil diupdate', 'success');
                closeEditModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    // displayErrors('edit', result.errors);
                    displayErrors('edit', result.errors);
                }
                // showNotification(result.message || 'Gagal mengupdate page', 'error');
                showNotification('Page Sudah Ada !', 'error');
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
        const pageId = document.getElementById('delete_page_id').value;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        try {
            const response = await fetch(`/admin/page/${pageId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    _method: 'DELETE'
                })
            });
            const result = await response.json();
            if (response.ok) {
                showNotification(result.message || 'Page berhasil dihapus', 'success');
                closeDeleteModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotification(result.message || 'Gagal menghapus page', 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
        }
    }

    // HELPER FUNCTIONS
    function clearErrors(prefix) {
        $(`[id^="error_${prefix}_"]`).addClass('hidden').text('');
        $(`#${prefix}PageForm .form-control`).removeClass('is-invalid');
    }

    function displayErrors(prefix, errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const errorEl = document.getElementById(`error_${prefix}_${field}`);
            if (errorEl) {
                errorEl.textContent = messages[0];
                errorEl.classList.remove('hidden');
                $(`#${prefix}PageForm [name="${field}"]`).addClass('is-invalid');
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
    $(document).on('click', '#sortDirectionBtn', function() {
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
