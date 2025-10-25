</script>
<script>
// =====================================================
// HELPER FUNCTIONS (Notification/Toast)
// =====================================================
function showToast(message, type = 'success') {
    $('#notification').remove();
    const icon = type === 'success'
        ? '<i class="fas fa-check-circle mr-2"></i>'
        : '<i class="fas fa-exclamation-circle mr-2"></i>';
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
</script>
<script>
    // Modal Atur Posisi Karyawan
    function openPosisiModal() {
        $('#modalPosisiKaryawan').modal('show');
        loadPosisiKaryawan();
    }

    function closePosisiModal() {
        $('#modalPosisiKaryawan').modal('hide');
    }

    // Load data karyawan dan kategori untuk modal posisi
    function loadPosisiKaryawan() {
        fetch('/admin/karyawan/posisi-data')
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Isi divisi filter
                    const kategoriSelect = document.getElementById('filterKategoriPosisi');
                    if (kategoriSelect) {
                        kategoriSelect.innerHTML = '<option value=\"\">Semua Divisi</option>';
                        // Handle baik divisis maupun kategoris (untuk compatibility)
                        const divisis = data.divisis || data.kategoris || [];
                        if (divisis && divisis.length > 0) {
                            divisis.forEach(div => {
                                kategoriSelect.innerHTML +=
                                    `<option value=\"${div.id_kategori}\">${div.nama_kategori}</option>`;
                            });
                        }
                        kategoriSelect.onchange = function() {
                            renderKaryawanCards(data.karyawans, this.value);
                        };
                    }
                    // Render karyawan cards
                    if (kategoriSelect) {
                        renderKaryawanCards(data.karyawans, kategoriSelect.value);
                    }
                }
            })
            .catch(error => {
                console.error('Error loading posisi data:', error);
            });
    }

    // Render karyawan cards ke grid, filter by kategori
    function renderKaryawanCards(karyawans, kategoriId) {
        const grid = document.getElementById('posisiKaryawanList');
        grid.innerHTML = '';
        let filtered = kategoriId ? karyawans.filter(k => k.kategori_id == kategoriId) : karyawans;
        const template = document.getElementById('karyawanCardTemplate');
        filtered.forEach((k, idx) => {
            const clone = template.content.cloneNode(true);
            const card = clone.querySelector('.karyawan-card-grid');
            card.setAttribute('draggable', 'true');
            card.dataset.id = k.id_karyawan;
            // Foto
            const foto = card.querySelector('.foto-karyawan');
            foto.src = k.foto ? '/storage/karyawan/' + k.foto : '/img/user-default.png';
            foto.alt = k.nama;
            // Nama
            card.querySelector('.nama').textContent = k.nama;
            // Staff
            if(card.querySelector('.staff')) card.querySelector('.staff').textContent = k.staff || '-';
            // Kategori
            card.querySelector('.kategori').textContent = k.kategori_nama || '-';
            // NIK
            card.querySelector('.nik').textContent = k.nik;
            // Posisi badge
            const posisiBadge = card.querySelector('.posisi-badge');
            posisiBadge.textContent = (k.posisi !== null && k.posisi !== undefined) ? (k.posisi + 1) : (idx + 1);
            grid.appendChild(clone);
        });
        // Animate cards after render
        setTimeout(() => {
            document.querySelectorAll('.karyawan-card-grid').forEach(card => {
                card.classList.add('animate-card');
            });
            enableCardNavigation();
        }, 10);
        enableDragDrop();
    }

    // Card selection and keyboard navigation for posisi modal
    function enableCardNavigation() {
        const grid = document.getElementById('posisiKaryawanList');
        let cards = Array.from(grid.querySelectorAll('.karyawan-card-grid'));
        let selectedIdx = -1;
        function selectCard(idx) {
            cards.forEach(card => card.classList.remove('selected'));
            if (idx >= 0 && idx < cards.length) {
                cards[idx].classList.add('selected');
                cards[idx].focus();
                selectedIdx = idx;
            }
        }
        function moveCard(fromIdx, toIdx) {
            if (fromIdx === toIdx || toIdx < 0 || toIdx >= cards.length) return;
            const card = cards[fromIdx];
            if (toIdx > fromIdx) {
                grid.insertBefore(card, cards[toIdx].nextSibling);
            } else {
                grid.insertBefore(card, cards[toIdx]);
            }
            // Re-query cards after move
            cards = Array.from(grid.querySelectorAll('.karyawan-card-grid'));
            selectCard(toIdx);
        }
        cards.forEach((card, idx) => {
            card.setAttribute('tabindex', '0');
            card.onclick = function() {
                selectCard(idx);
            };
        });
        grid.onkeydown = function(e) {
            if (selectedIdx === -1) return;
            let nextIdx = selectedIdx;
            if (e.key === 'ArrowRight') nextIdx = Math.min(cards.length - 1, selectedIdx + 1);
            if (e.key === 'ArrowLeft') nextIdx = Math.max(0, selectedIdx - 1);
            if (e.key === 'ArrowDown') nextIdx = Math.min(cards.length - 1, selectedIdx + 4);
            if (e.key === 'ArrowUp') nextIdx = Math.max(0, selectedIdx - 4);
            if (nextIdx !== selectedIdx) {
                moveCard(selectedIdx, nextIdx);
                cards[nextIdx].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        };
        // Initial select first card
        if (cards.length > 0) selectCard(0);
    }
    // Simpan posisi karyawan
    document.getElementById('btnSimpanPosisiKaryawan').onclick = function() {
        const ids = Array.from(document.querySelectorAll('#posisiKaryawanList .karyawan-card-grid')).map(
            card => card.dataset.id);
        fetch('/admin/karyawan/update-posisi', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                ids
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast('Urutan posisi berhasil disimpan!', 'success');
                closePosisiModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast('Gagal menyimpan urutan posisi!', 'danger');
            }
        })
        .catch(() => showToast('Terjadi error saat menyimpan posisi!', 'danger'));
    };
    // Modal open/close
    function openCreateModal() {
        $('#createModal').modal('show');
    }

    function closeCreateModal() {
        $('#createModal').modal('hide');
    }

    function openEditModal(id) {
        loadEditData(id);
        $('#editModal').modal('show');
    }

    function closeEditModal() {
        $('#editModal').modal('hide');
    }

    function openDetailModal(id) {
        loadDetailData(id);
        $('#detailModal').modal('show');
    }

    function closeDetailModal() {
        $('#detailModal').modal('hide');
    }

    function openDeleteModal(id, name) {
        $('#deleteModal').modal('show');
        $('#delete_karyawan_id').val(id);
        $('#delete_karyawan_name').text(name);
    }

    function closeDeleteModal() {
        $('#deleteModal').modal('hide');
    }

    // AJAX load detail
    function loadDetailData(id) {
        fetch(`/admin/karyawan/${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const k = data.karyawan;
                    $('#detail_kode_karyawan').text(k.kode_karyawan);
                    $('#detail_nik').text(k.nik);
                    $('#detail_nama').text(k.nama);
                    $('#detail_kategori').text(k.kategori_nama || '-');
                    $('#detail_staff').text(k.staff_nama || '-');
                    $('#detail_status').text(k.status);
                    $('#detail_deskripsi').text(k.deskripsi || '-');
                    if (k.foto) {
                        $('#detail_foto').attr('src', '/storage/karyawan/' + k.foto).removeClass('d-none');
                    } else {
                        $('#detail_foto').attr('src', '#').addClass('d-none');
                    }
                }
            });
    }
    // AJAX load edit
    function loadEditData(id) {
        fetch(`/admin/karyawan/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const k = data.karyawan;
                    $('#edit_id').val(k.id_karyawan);
                    $('#edit_kategori_id').val(k.kategori_id);
                    $('#edit_staff_id').val(k.staff_id);
                    $('#edit_nik').val(k.nik);
                    $('#edit_nama').val(k.nama);
                    $('#edit_status').val(k.status);
                    $('#edit_deskripsi').val(k.deskripsi);
                    $('#edit_foto').val('');
                    if (k.foto) {
                        $('#preview-edit-img').attr('src', '/storage/karyawan/' + k.foto).removeClass('d-none');
                    } else {
                        $('#preview-edit-img').attr('src', '#').addClass('d-none');
                    }
                }
            });
    }
    // AJAX submit create
    async function submitCreate(event) {
        event.preventDefault();
        const form = document.getElementById('createKaryawanForm');
        const submitBtn = document.getElementById('createSubmitBtn');
        const formData = new FormData(form);
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        try {
            const response = await fetch('/admin/karyawan', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const result = await response.json();
            if (response.ok) {
                showToast('Karyawan berhasil ditambahkan!', 'success');
                closeCreateModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast('Gagal menambah karyawan!', 'danger');
            }
        } catch {
            showToast('Terjadi error saat menambah karyawan!', 'danger');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
        }
    }
    // AJAX submit edit
    async function submitEdit(event) {
        event.preventDefault();
        const form = document.getElementById('editKaryawanForm');
        const submitBtn = document.getElementById('editSubmitBtn');
        const karyawanId = document.getElementById('edit_id').value;
        const formData = new FormData(form);
        formData.append('_method', 'PUT');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupdate...';
        try {
            const response = await fetch(`/admin/karyawan/${karyawanId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });
            const result = await response.json();
            if (response.ok) {
                showToast('Karyawan berhasil diupdate!', 'success');
                closeEditModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast('Gagal mengupdate karyawan!', 'danger');
            }
        } catch {
            showToast('Terjadi error saat update karyawan!', 'danger');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
        }
    }
    // AJAX submit delete
    async function submitDelete(event) {
        event.preventDefault();
        const submitBtn = document.getElementById('deleteSubmitBtn');
        const karyawanId = document.getElementById('delete_karyawan_id').value;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
        try {
            const response = await fetch(`/admin/karyawan/${karyawanId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({
                    _method: 'DELETE'
                })
            });
            const result = await response.json();
            if (response.ok) {
                showToast('Karyawan berhasil dihapus!', 'success');
                closeDeleteModal();
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast('Gagal menghapus karyawan!', 'danger');
            }
        } catch {
            showToast('Terjadi error saat hapus karyawan!', 'danger');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
        }
    }
</script>
