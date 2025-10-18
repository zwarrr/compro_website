<script>
    // ===============================
    // Karyawan - Modal Management
    // ===============================

    function openCreateKaryawanModal() {
        const modal = document.getElementById('createKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.getElementById('createKaryawanForm').reset();
        clearKaryawanErrors('create');
        const prev = document.getElementById('create_foto_preview');
        if (prev) {
            prev.src = '';
            prev.classList.add('hidden');
        }
    }

    function closeCreateKaryawanModal() {
        const modal = document.getElementById('createKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    async function showKaryawanDetail(id) {
        const modal = document.getElementById('detailKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        const loadingEl = document.getElementById('karyawanDetailLoading');
        const dataEl = document.getElementById('karyawanDetailData');

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
            const res = await fetch(`{{ url('admin/karyawan') }}/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error('Gagal mengambil data');
            const result = await res.json();
            const k = result.karyawan;
            document.getElementById('detail_kode_karyawan').textContent = k.kode_karyawan;
            document.getElementById('detail_nama').textContent = k.nama;
            document.getElementById('detail_nik').textContent = k.nik;
            document.getElementById('detail_kategori').textContent = k.kategori_nama || '-';
            document.getElementById('detail_status').textContent = k.status;
            document.getElementById('detail_deskripsi').textContent = k.deskripsi || '-';
            const img = document.getElementById('detail_foto');
            if (k.foto_url) {
                img.src = k.foto_url;
                img.classList.remove('hidden');
            } else {
                img.src = '';
                img.classList.add('hidden');
            }
            document.getElementById('detail_created_at').textContent = k.created_at_formatted;
            document.getElementById('detail_updated_at').textContent = k.updated_at_formatted;
            loadingEl.classList.add('hidden');
            dataEl.classList.remove('hidden');
        } catch (err) {
            console.error(err);
            showNotification('Gagal mengambil data karyawan', 'error');
            closeDetailKaryawanModal();
        }
    }

    function closeDetailKaryawanModal() {
        const modal = document.getElementById('detailKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    async function openEditKaryawanModal(id) {
        const modal = document.getElementById('editKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        const loadingEl = document.getElementById('karyawanEditLoading');
        const formEl = document.getElementById('editKaryawanFormContent');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        loadingEl.classList.remove('hidden');
        formEl.classList.add('hidden');
        clearKaryawanErrors('edit');

        try {
            const res = await fetch(`{{ url('admin/karyawan') }}/${id}/edit`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error('Gagal mengambil data');
            const result = await res.json();
            const k = result.karyawan;
            document.getElementById('edit_karyawan_id').value = k.id_karyawan;
            document.getElementById('edit_kategori_id').value = k.kategori_id;
            document.getElementById('edit_nama').value = k.nama;
            document.getElementById('edit_nik').value = k.nik;
            document.getElementById('edit_deskripsi').value = k.deskripsi || '';
            document.getElementById('edit_status').value = k.status;
            const prev = document.getElementById('edit_foto_preview');
            if (k.foto) {
                prev.src = `{{ asset('images/karyawan') }}/${k.foto}`;
                prev.classList.remove('hidden');
            } else {
                prev.src = '';
                prev.classList.add('hidden');
            }
            loadingEl.classList.add('hidden');
            formEl.classList.remove('hidden');
        } catch (err) {
            console.error(err);
            showNotification('Gagal mengambil data karyawan', 'error');
            closeEditKaryawanModal();
        }
    }

    function closeEditKaryawanModal() {
        const modal = document.getElementById('editKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    function confirmDeleteKaryawan(id, name) {
        const modal = document.getElementById('deleteKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.getElementById('delete_karyawan_id').value = id;
        document.getElementById('delete_karyawan_name').textContent = name;
    }

    function closeDeleteKaryawanModal() {
        const modal = document.getElementById('deleteKaryawanModal');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('opacity-100');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // ===============================
    // Karyawan - Form Submissions
    // ===============================
    async function submitCreateKaryawan(event) {
        event.preventDefault();
        const form = document.getElementById('createKaryawanForm');
        const submitBtn = document.getElementById('createKaryawanSubmitBtn');
        const formData = new FormData(form);

        // Debug form data
        console.log('FormData contents:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ': ' + (value instanceof File ? value.name + ' (' + value.size + ' bytes)' : value));
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...';
        clearKaryawanErrors('create');

        try {
            // Option 1: Gunakan URL langsung (temporary)
            const url = '/admin/karyawan'; // Coba pakai URL langsung dulu

            console.log('Sending request to:', url);

            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            console.log('Response status:', res.status);

            const result = await res.json();
            console.log('Response data:', result);

            if (res.ok) {
                showNotification(result.message || 'Karyawan berhasil ditambahkan', 'success');
                closeCreateKaryawanModal();
                setTimeout(() => window.location.reload(), 800);
            } else {
                if (result.errors) displayKaryawanErrors('create', result.errors);
                showNotification(result.message || 'Gagal menambahkan karyawan', 'error');
            }
        } catch (err) {
            console.error('Fetch error:', err);
            showNotification('Terjadi kesalahan pada server: ' + err.message, 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Simpan Karyawan';
        }
    }

    async function submitEditKaryawan(event) {
        event.preventDefault();
        const form = document.getElementById('editKaryawanForm');
        const submitBtn = document.getElementById('editKaryawanSubmitBtn');
        const id = document.getElementById('edit_karyawan_id').value;
        const formData = new FormData(form);
        formData.append('_method', 'PUT');

        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengupdate...';
        clearKaryawanErrors('edit');

        try {
            const res = await fetch(`{{ url('admin/karyawan') }}/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const result = await res.json();
            if (res.ok) {
                showNotification(result.message || 'Karyawan berhasil diupdate', 'success');
                closeEditKaryawanModal();
                setTimeout(() => window.location.reload(), 800);
            } else {
                if (result.errors) displayKaryawanErrors('edit', result.errors);
                showNotification(result.message || 'Gagal mengupdate karyawan', 'error');
            }
        } catch (err) {
            console.error(err);
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Update Karyawan';
        }
    }

    async function submitDeleteKaryawan(event) {
        event.preventDefault();
        const submitBtn = document.getElementById('deleteKaryawanSubmitBtn');
        const id = document.getElementById('delete_karyawan_id').value;
        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';

        try {
            const res = await fetch(`{{ url('admin/karyawan') }}/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'DELETE'
                })
            });
            const result = await res.json();
            if (res.ok) {
                showNotification(result.message || 'Karyawan berhasil dihapus', 'success');
                closeDeleteKaryawanModal();
                setTimeout(() => window.location.reload(), 800);
            } else {
                showNotification(result.message || 'Gagal menghapus karyawan', 'error');
            }
        } catch (err) {
            console.error(err);
            showNotification('Terjadi kesalahan pada server', 'error');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Ya, Hapus';
        }
    }

    // ===============================
    // Karyawan - Helpers
    // ===============================

    function clearKaryawanErrors(prefix) {
        document.querySelectorAll(`[id^="error_${prefix}_karyawan_"]`).forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
    }

    function displayKaryawanErrors(prefix, errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const el = document.getElementById(`error_${prefix}_karyawan_${field}`);
            if (el) {
                el.textContent = messages[0];
                el.classList.remove('hidden');
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

    document.addEventListener('click', function(event) {
        ['createKaryawanModal', 'detailKaryawanModal', 'editKaryawanModal', 'deleteKaryawanModal'].forEach(
        id => {
            const modal = document.getElementById(id);
            if (event.target === modal) {
                const fn = window[`close${id.charAt(0).toUpperCase()+id.slice(1)}`];
                if (fn) fn();
            }
        });
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            ['closeCreateKaryawanModal', 'closeDetailKaryawanModal', 'closeEditKaryawanModal',
                'closeDeleteKaryawanModal'
            ].forEach(fn => {
                if (typeof window[fn] === 'function') window[fn]();
            });
        }
    });
</script>
