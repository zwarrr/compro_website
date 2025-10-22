    <!-- ==================== JAVASCRIPT ==================== -->
    <script>
        // =====================================================
        // MODAL MANAGEMENT FUNCTIONS
        // =====================================================

        function openCreateModal() {
            $('#createModal').modal('show');
            $('#createKategoriForm')[0].reset();
            clearErrors('create');
        }

        function closeCreateModal() {
            $('#createModal').modal('hide');
        }

        async function showDetail(kategoriId) {
            $('#detailModal').modal('show');

            $('#detailLoading').removeClass('hidden');
            $('#detailData').addClass('hidden');

            try {
                const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) throw new Error('Gagal mengambil data');

                const result = await response.json();
                const kategori = result.kategori;

                $('#detail_id').text(kategori.id_kategori);
                $('#detail_kode').text(kategori.kode_kategori);
                $('#detail_nama_kategori').text(kategori.nama_kategori);
                $('#detail_tipe').text(kategori.tipe);
                $('#detail_created_at').text(kategori.created_at_formatted);
                $('#detail_updated_at').text(kategori.updated_at_formatted);

                $('#detailLoading').addClass('hidden');
                $('#detailData').removeClass('hidden');

            } catch (error) {
                console.error('Error:', error);
                showNotification('Gagal mengambil data kategori', 'error');
                closeDetailModal();
            }
        }

        function closeDetailModal() {
            $('#detailModal').modal('hide');
        }

        async function openEditModal(kategoriId) {
            $('#editModal').modal('show');

            $('#editLoading').removeClass('hidden');
            $('#editFormContent').addClass('hidden');
            clearErrors('edit');

            try {
                const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}/edit`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) throw new Error('Gagal mengambil data');

                const result = await response.json();
                const kategori = result.kategori;

                $('#edit_id').val(kategori.id_kategori);
                $('#edit_nama_kategori').val(kategori.nama_kategori);
                $('#edit_tipe').val(kategori.tipe);

                $('#editLoading').addClass('hidden');
                $('#editFormContent').removeClass('hidden');

            } catch (error) {
                console.error('Error:', error);
                showNotification('Gagal mengambil data kategori', 'error');
                closeEditModal();
            }
        }

        function closeEditModal() {
            $('#editModal').modal('hide');
        }

        function confirmDelete(kategoriId, kategoriName) {
            $('#deleteModal').modal('show');

            $('#delete_kategori_id').val(kategoriId);
            $('#delete_kategori_name').text(kategoriName);
        }

        function closeDeleteModal() {
            $('#deleteModal').modal('hide');
        }

        // =====================================================
        // FORM SUBMISSION FUNCTIONS
        // =====================================================

        async function submitCreate(event) {
            event.preventDefault();

            const form = document.getElementById('createKategoriForm');
            const submitBtn = document.getElementById('createSubmitBtn');
            const formData = new FormData(form);

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            clearErrors('create');

            try {
                const response = await fetch('{{ route('admin.kategori.store') }}', {
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
                    showNotification(result.message || 'Kategori berhasil ditambahkan', 'success');
                    closeCreateModal();
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    if (result.errors) {
                        displayErrors('create', result.errors);
                    }
                    showNotification(result.message || 'Gagal menambahkan kategori', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan pada server', 'error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
            }
        }

        async function submitEdit(event) {
            event.preventDefault();

            const form = document.getElementById('editKategoriForm');
            const submitBtn = document.getElementById('editSubmitBtn');
            const kategoriId = document.getElementById('edit_id').value;
            const formData = new FormData(form);
            formData.append('_method', 'PUT');

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';

            clearErrors('edit');

            try {
                const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}`, {
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
                    showNotification(result.message || 'Kategori berhasil diupdate', 'success');
                    closeEditModal();
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    if (result.errors) {
                        displayErrors('edit', result.errors);
                    }
                    showNotification(result.message || 'Gagal mengupdate kategori', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan pada server', 'error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save"></i> Update';
            }
        }

        async function submitDelete(event) {
            event.preventDefault();

            const submitBtn = document.getElementById('deleteSubmitBtn');
            const kategoriId = document.getElementById('delete_kategori_id').value;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';

            try {
                const response = await fetch(`{{ url('admin/kategori') }}/${kategoriId}`, {
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
                    showNotification(result.message || 'Kategori berhasil dihapus', 'success');
                    closeDeleteModal();
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showNotification(result.message || 'Gagal menghapus kategori', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
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
            $(`#${prefix}KategoriForm .form-control`).removeClass('is-invalid');
        }

        function displayErrors(prefix, errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const errorEl = document.getElementById(`error_${prefix}_${field}`);
                if (errorEl) {
                    errorEl.textContent = messages[0];
                    errorEl.classList.remove('hidden');
                    $(`#${prefix}KategoriForm [name="${field}"]`).addClass('is-invalid');
                }
            }
        }

        function showNotification(message, type = 'success') {
            // Remove existing notification
            $('#notification').remove();

            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
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

            // Auto remove after 5 seconds
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

        // Initialize tooltips
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
