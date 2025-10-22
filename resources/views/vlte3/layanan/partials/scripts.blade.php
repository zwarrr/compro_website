<!-- ==================== JAVASCRIPT ==================== -->
<script>
    // =====================================================
    // MODAL MANAGEMENT FUNCTIONS
    // =====================================================

    function openCreateModal() {
        $('#createModal').modal('show');
        $('#createLayananForm')[0].reset();
        clearErrors('create');
    }

    function closeCreateModal() {
        $('#createModal').modal('hide');
    }

    async function showDetail(layananId) {
        $('#detailModal').modal('show');
        $('#detailData').addClass('hidden');
        try {
            const response = await fetch(`{{ url('admin/layanan') }}/${layananId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            if (!response.ok) throw new Error('Gagal mengambil data');
            const result = await response.json();
            const layanan = result.layanan;
            document.getElementById('detail_id').value = layanan.id_layanan || '';
            document.getElementById('detail_kode').value = layanan.kode_layanan || '';
            document.getElementById('detail_judul').value = layanan.judul || '';
            document.getElementById('detail_kategori').value = layanan.kategori_nama || '';
            document.getElementById('detail_status').value = layanan.status || '';
            document.getElementById('detail_slog').value = layanan.slog || '';
            document.getElementById('detail_link').value = layanan.link || '';
            // Set clickable anchor for link
            const anchorDiv = document.getElementById('detail_link_anchor');
            if (layanan.link && layanan.link.match(/^https?:\/\//)) {
                anchorDiv.innerHTML = `<a href="${layanan.link}" target="_blank" rel="noopener" class="badge badge-primary px-3 py-2" style="font-size:1rem;"><i class='fas fa-external-link-alt mr-1'></i>Buka Link</a>`;
            } else {
                anchorDiv.innerHTML = '';
            }
            document.getElementById('detail_deskripsi').value = layanan.deskripsi || '';
            document.getElementById('detail_created_at').value = layanan.created_at_formatted || '';
            document.getElementById('detail_updated_at').value = layanan.updated_at_formatted || '';
            document.getElementById('detail_gambar').innerHTML = layanan.gambar_url ? `<img src='${layanan.gambar_url}' class='img-fluid rounded shadow-sm' style='max-height:150px;max-width:100%;object-fit:contain;'>` : '-';
            $('#detailData').removeClass('hidden');
        } catch (error) {
            showNotification('Gagal mengambil data layanan', 'error');
            closeDetailModal();
        }
    }

    function closeDetailModal() {
        $('#detailModal').modal('hide');
    }

    async function openEditModal(layananId) {
        $('#editModal').modal('show');
        $('#editFormContent').addClass('hidden');
        clearErrors('edit');
        try {
            const response = await fetch(`{{ url('admin/layanan') }}/${layananId}/edit`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            if (!response.ok) throw new Error('Gagal mengambil data');
            const result = await response.json();
            const layanan = result.layanan;
            $('#edit_id').val(layanan.id_layanan);
            $('#edit_kategori_id').val(layanan.kategori_id);
            $('#edit_judul').val(layanan.judul);
            $('#edit_slog').val(layanan.slog);
            $('#edit_link').val(layanan.link);
            $('#edit_deskripsi').val(layanan.deskripsi);
            $('#edit_status').val(layanan.status);
            $('#editFormContent').removeClass('hidden');
        } catch (error) {
            showNotification('Gagal mengambil data layanan', 'error');
            closeEditModal();
        }
    }

    function closeEditModal() {
        $('#editModal').modal('hide');
    }

    function confirmDelete(layananId, layananName) {
        $('#deleteModal').modal('show');
        $('#delete_layanan_id').val(layananId);
        $('#delete_layanan_name').text(layananName);
    }

    function closeDeleteModal() {
        $('#deleteModal').modal('hide');
    }

    // =====================================================
    // FORM SUBMISSION FUNCTIONS
    // =====================================================

    async function submitCreate(event) {
        event.preventDefault();
        const form = document.getElementById('createLayananForm');
        const submitBtn = document.getElementById('createSubmitBtn');
        const formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        clearErrors('create');
        try {
            const response = await fetch('{{ route('admin.layanan.store') }}', {
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
                showNotification(result.message || 'Layanan berhasil ditambahkan', 'success');
                closeCreateModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors('create', result.errors);
                }
                showNotification(result.message || 'Gagal menambahkan layanan', 'error');
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
        const form = document.getElementById('editLayananForm');
        const submitBtn = document.getElementById('editSubmitBtn');
        const layananId = document.getElementById('edit_id').value;
        const formData = new FormData(form);
        formData.append('_method', 'PUT');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
        clearErrors('edit');
        try {
            const response = await fetch(`{{ url('admin/layanan') }}/${layananId}`, {
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
                showNotification(result.message || 'Layanan berhasil diupdate', 'success');
                closeEditModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors('edit', result.errors);
                }
                showNotification(result.message || 'Gagal mengupdate layanan', 'error');
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
        const layananId = document.getElementById('delete_layanan_id').value;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        try {
            const response = await fetch(`{{ url('admin/layanan') }}/${layananId}`, {
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
                showNotification(result.message || 'Layanan berhasil dihapus', 'success');
                closeDeleteModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotification(result.message || 'Gagal menghapus layanan', 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
        }
    }

    // =====================================================
    // HELPER FUNCTIONS
    // =====================================================

    function clearErrors(prefix) {
        $(`[id^="error_${prefix}_"]`).addClass('hidden').text('');
        $(`#${prefix}LayananForm .form-control`).removeClass('is-invalid');
    }

    function displayErrors(prefix, errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const errorEl = document.getElementById(`error_${prefix}_${field}`);
            if (errorEl) {
                errorEl.textContent = messages[0];
                errorEl.classList.remove('hidden');
                $(`#${prefix}LayananForm [name="${field}"]`).addClass('is-invalid');
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
