<script>
    // ==================== JAVASCRIPT ====================

    // MODAL MANAGEMENT FUNCTIONS
    function openCreateModal() {
        $('#createModal').modal('show');
        $('#createIlustrasiForm')[0].reset();
        clearErrors('create');
    }

    function closeCreateModal() {
        $('#createModal').modal('hide');
    }

    async function showDetail(ilustrasiId) {
        $('#detailModal').modal('show');
        $('#detailFormContent').addClass('hidden');
        try {
            const response = await fetch(`/admin/ilustrasi/${ilustrasiId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            if (!response.ok) throw new Error('Gagal mengambil data');
            const result = await response.json();
            const ilustrasi = result.ilustrasi;
            $('#detail_kode').val(ilustrasi.kode_ilustrasi || '');
            $('#detail_judul').val(ilustrasi.judul || '');
            $('#detail_status').val(ilustrasi.status || '');
            $('#detail_deskripsi').val(ilustrasi.deskripsi || '');
            $('#detail_created_at').val(ilustrasi.created_at_formatted || '');
            $('#detail_updated_at').val(ilustrasi.updated_at_formatted || '');
            if (ilustrasi.image_url) {
                $('#detail_gambar').html(`<img src='${ilustrasi.image_url}' class='img-fluid rounded shadow-sm' style='max-height:180px;max-width:100%;' />`);
            } else {
                $('#detail_gambar').html('-');
            }
            $('#detailFormContent').removeClass('hidden');
        } catch (error) {
            showNotification('Gagal mengambil data ilustrasi', 'error');
            closeDetailModal();
        }
    }

    function closeDetailModal() {
        $('#detailModal').modal('hide');
    }

    async function openEditModal(ilustrasiId) {
        $('#editModal').modal('show');
        $('#editFormContent').addClass('hidden');
        clearErrors('edit');
        try {
            const response = await fetch(`/admin/ilustrasi/${ilustrasiId}/edit`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            if (!response.ok) throw new Error('Gagal mengambil data');
            const result = await response.json();
            const ilustrasi = result.ilustrasi;
            $('#edit_id').val(ilustrasi.id_ilustrasi);
            $('#edit_judul').val(ilustrasi.judul);
            $('#edit_deskripsi').val(ilustrasi.deskripsi);
            $('#edit_status').val(ilustrasi.status);
            // Preview gambar
            if (ilustrasi.image_url) {
                $('#preview-edit-img').attr('src', ilustrasi.image_url).removeClass('d-none');
            } else {
                $('#preview-edit-img').attr('src', '#').addClass('d-none');
            }
            $('#editFormContent').removeClass('hidden');
        } catch (error) {
            showNotification('Gagal mengambil data ilustrasi', 'error');
            closeEditModal();
        }
    }

    function closeEditModal() {
        $('#editModal').modal('hide');
    }

    function confirmDelete(ilustrasiId, ilustrasiName) {
        $('#deleteModal').modal('show');
        $('#delete_ilustrasi_id').val(ilustrasiId);
        $('#delete_ilustrasi_name').text(ilustrasiName);
        // Fetch image for delete modal
        fetch(`/admin/ilustrasi/${ilustrasiId}`)
            .then(res => res.json())
            .then(data => {
                if (data.ilustrasi && data.ilustrasi.image_url) {
                    $('#delete_gambar').html(
                        `<img src='${data.ilustrasi.image_url}' class='img-fluid rounded shadow-sm' style='max-height:100px;max-width:100%;object-fit:contain;'>`
                        );
                } else {
                    $('#delete_gambar').html('-');
                }
            });
    }

    function closeDeleteModal() {
        $('#deleteModal').modal('hide');
    }

    // FORM SUBMISSION FUNCTIONS
    async function submitCreate(event) {
        event.preventDefault();
        const form = document.getElementById('createIlustrasiForm');
        const submitBtn = document.getElementById('createSubmitBtn');
        const formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        clearErrors('create');
        try {
            const response = await fetch('/admin/ilustrasi', {
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
                let notifMsg = result.message || 'Ilustrasi berhasil ditambahkan';
                // if (result.kode_ilustrasi) {
                //     notifMsg += `<br><span class='badge badge-info'>Kode: ${result.kode_ilustrasi}</span>`;
                // }
                showNotification(notifMsg, 'success');
                closeCreateModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors('create', result.errors);
                }
                showNotification(result.message || 'Gagal menambahkan ilustrasi', 'error');
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
        const form = document.getElementById('editIlustrasiForm');
        const submitBtn = document.getElementById('editSubmitBtn');
        const ilustrasiId = document.getElementById('edit_id').value;
        const formData = new FormData(form);
        formData.append('_method', 'PUT');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
        clearErrors('edit');
        try {
            const response = await fetch(`/admin/ilustrasi/${ilustrasiId}`, {
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
                showNotification(result.message || 'Ilustrasi berhasil diupdate', 'success');
                closeEditModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors('edit', result.errors);
                }
                showNotification(result.message || 'Gagal mengupdate ilustrasi', 'error');
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
        const ilustrasiId = document.getElementById('delete_ilustrasi_id').value;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        try {
            const response = await fetch(`{{ url('admin/ilustrasi') }}/${ilustrasiId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
                showNotification(result.message || 'Ilustrasi berhasil dihapus', 'success');
                closeDeleteModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                console.log(response);
                showNotification(result.message || 'Gagal menghapus ilustrasi', 'error');
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
        $(`#${prefix}IlustrasiForm .form-control`).removeClass('is-invalid');
    }

    function displayErrors(prefix, errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const errorEl = document.getElementById(`error_${prefix}_${field}`);
            if (errorEl) {
                errorEl.textContent = messages[0];
                errorEl.classList.remove('hidden');
                $(`#${prefix}IlustrasiForm [name="${field}"]`).addClass('is-invalid');
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
