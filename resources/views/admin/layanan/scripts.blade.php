<script>
    // =====================================================
    // MODAL MANAGEMENT FUNCTIONS
    // =====================================================

    function openCreateModal() {
        const modal = document.getElementById('createLayananModal');
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        document.getElementById('createLayananForm').reset();
        clearErrors('create');
    }

    function closeCreateLayananModal() {
        const modal = document.getElementById('createLayananModal');
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    async function showDetail(layananId) {
        const modal = document.getElementById('detailLayananModal');
        const modalContent = modal.querySelector('.modal-content');
        const loadingEl = document.getElementById('detailLoading');
        const dataEl = document.getElementById('detailData');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        loadingEl.classList.remove('hidden');
        dataEl.classList.add('hidden');

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

            document.getElementById('detail_kode').textContent = layanan.kode_layanan;
            document.getElementById('detail_judul').textContent = layanan.judul;
            document.getElementById('detail_kategori').textContent = layanan.kategori_nama || '-';
            document.getElementById('detail_slog').textContent = layanan.slog || '-';
            document.getElementById('detail_deskripsi').textContent = layanan.deskripsi || '-';
            document.getElementById('detail_status').textContent = layanan.status;

            const gambarEl = document.getElementById('detail_gambar');
            if (layanan.gambar_url) {
                gambarEl.src = layanan.gambar_url;
                gambarEl.classList.remove('hidden');
            } else {
                gambarEl.classList.add('hidden');
            }

            document.getElementById('detail_created_at').textContent = layanan.created_at_formatted;
            document.getElementById('detail_updated_at').textContent = layanan.updated_at_formatted;

            loadingEl.classList.add('hidden');
            dataEl.classList.remove('hidden');

        } catch (error) {
            console.error('Error:', error);
            showNotification('Gagal mengambil data layanan', 'error');
            closeDetailLayananModal();
        }
    }

    function closeDetailLayananModal() {
        const modal = document.getElementById('detailLayananModal');
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    async function openEditModal(layananId) {
        const modal = document.getElementById('editLayananModal');
        const modalContent = modal.querySelector('.modal-content');
        const loadingEl = document.getElementById('editLoading');

        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        clearErrors();
        
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
            loadingEl.classList.add('hidden');
            
            // Populate form fields
            document.getElementById('edit_id_layanan').value = layanan.id_layanan;
            document.getElementById('edit_kode_layanan').value = layanan.kode_layanan;
            document.getElementById('edit_kategori_id').value = layanan.kategori_id;
            document.getElementById('edit_judul').value = layanan.judul;
            document.getElementById('edit_slog').value = layanan.slog || '';
            document.getElementById('edit_deskripsi').value = layanan.deskripsi || '';
            document.getElementById('edit_status').value = layanan.status;

            // Preview gambar existing
            const existingImageDiv = document.getElementById('edit_existing_image');
            const previewEl = document.getElementById('edit_gambar_preview');
            if (layanan.gambar) {
                previewEl.src = `/storage/${layanan.gambar}`;
                existingImageDiv.classList.remove('hidden');
            } else {
                existingImageDiv.classList.add('hidden');
            }

        } catch (error) {
            console.error('Error:', error);
            showNotification('Gagal mengambil data layanan', 'error');
            closeEditLayananModal();
        }
    }

    function closeEditLayananModal() {
        const modal = document.getElementById('editLayananModal');
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    function confirmDelete(layananId, layananName) {
        const modal = document.getElementById('deleteLayananModal');
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        document.getElementById('delete_layanan_id').value = layananId;
        document.getElementById('delete_layanan_name').textContent = layananName;
    }

    function closeDeleteLayananModal() {
        const modal = document.getElementById('deleteLayananModal');
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // =====================================================
    // FORM SUBMISSION FUNCTIONS
    // =====================================================

    async function submitCreateLayanan(event) {
        event.preventDefault();

        const form = document.getElementById('createLayananForm');
        const submitBtn = document.getElementById('createSubmitBtn');
        const formData = new FormData(form);

        submitBtn.disabled = true;
        document.getElementById('createSubmitBtnText').textContent = 'Menyimpan...';
        document.getElementById('loadingSpinner').classList.remove('hidden');

        clearErrors();

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
                closeCreateLayananModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors(result.errors);
                }
                showNotification(result.message || 'Gagal menambahkan layanan', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            document.getElementById('createSubmitBtnText').textContent = 'Simpan Layanan';
            document.getElementById('loadingSpinner').classList.add('hidden');
        }
    }

    async function submitEditLayanan(event) {
        event.preventDefault();

        const form = document.getElementById('editLayananForm');
        const submitBtn = document.getElementById('editSubmitBtn');
        const layananId = document.getElementById('edit_id_layanan').value;
        const formData = new FormData(form);
        formData.append('_method', 'PUT');

        submitBtn.disabled = true;
        document.getElementById('editSubmitBtnText').textContent = 'Mengupdate...';
        document.getElementById('editLoadingSpinner').classList.remove('hidden');

        clearErrors();

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
                closeEditLayananModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                if (result.errors) {
                    displayErrors(result.errors);
                }
                showNotification(result.message || 'Gagal mengupdate layanan', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            document.getElementById('editSubmitBtnText').textContent = 'Update Layanan';
            document.getElementById('editLoadingSpinner').classList.add('hidden');
        }
    }

    async function submitDeleteLayanan(event) {
        event.preventDefault();

        const submitBtn = document.getElementById('deleteSubmitBtn');
        const layananId = document.getElementById('delete_layanan_id').value;

        submitBtn.disabled = true;
        document.getElementById('deleteSubmitBtnText').textContent = 'Menghapus...';
        document.getElementById('deleteLoadingSpinner').classList.remove('hidden');

        try {
            const response = await fetch(`{{ url('admin/layanan') }}/${layananId}`, {
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
                showNotification(result.message || 'Layanan berhasil dihapus', 'success');
                closeDeleteLayananModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotification(result.message || 'Gagal menghapus layanan', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            document.getElementById('deleteSubmitBtnText').textContent = 'Ya, Hapus';
            document.getElementById('deleteLoadingSpinner').classList.add('hidden');
        }
    }

    // =====================================================
    // HELPER FUNCTIONS
    // =====================================================

    function clearErrors() {
        const errorElements = document.querySelectorAll('[id^="error_"]');
        errorElements.forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
    }

    function displayErrors(errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const errorEl = document.getElementById(`error_${field}`);
            if (errorEl) {
                errorEl.textContent = messages[0];
                errorEl.classList.remove('hidden');
            }
        }
    }

    function showNotification(message, type = 'success') {
        const existing = document.getElementById('notification');
        if (existing) existing.remove();

        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' ?
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>' :
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';

        const notification = document.createElement('div');
        notification.id = 'notification';
        notification.className =
            `fixed top-4 right-4 ${bgColor} text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 z-[9999] transform transition-all duration-300 translate-x-full`;
        notification.innerHTML = `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            ${icon}
        </svg>
        <span>${message}</span>
    `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 10);

        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Close modals when clicking outside or pressing Escape
    document.addEventListener('click', function(event) {
        const modals = ['createLayananModal', 'detailLayananModal', 'editLayananModal', 'deleteLayananModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && event.target === modal) {
                const functionName = 'close' + modalId.charAt(0).toUpperCase() + modalId.slice(1);
                const closeFunction = window[functionName];
                if (closeFunction) closeFunction();
            }
        });
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const createModal = document.getElementById('createLayananModal');
            const detailModal = document.getElementById('detailLayananModal');
            const editModal = document.getElementById('editLayananModal');
            const deleteModal = document.getElementById('deleteLayananModal');

            if (createModal && !createModal.classList.contains('hidden')) {
                closeCreateLayananModal();
            } else if (detailModal && !detailModal.classList.contains('hidden')) {
                closeDetailLayananModal();
            } else if (editModal && !editModal.classList.contains('hidden')) {
                closeEditLayananModal();
            } else if (deleteModal && !deleteModal.classList.contains('hidden')) {
                closeDeleteLayananModal();
            }
        }
    });
</script>
