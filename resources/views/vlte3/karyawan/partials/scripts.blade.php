<script>
// Modal open/close
function openCreateModal() { $('#createModal').modal('show'); }
function closeCreateModal() { $('#createModal').modal('hide'); }
function openEditModal(id) { loadEditData(id); $('#editModal').modal('show'); }
function closeEditModal() { $('#editModal').modal('hide'); }
function openDetailModal(id) { loadDetailData(id); $('#detailModal').modal('show'); }
function closeDetailModal() { $('#detailModal').modal('hide'); }
function openDeleteModal(id, name) {
    $('#deleteModal').modal('show');
    $('#delete_karyawan_id').val(id);
    $('#delete_karyawan_name').text(name);
}
function closeDeleteModal() { $('#deleteModal').modal('hide'); }

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
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            closeCreateModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            // handle errors
        }
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
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: formData
        });
        const result = await response.json();
        if (response.ok) {
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            // handle errors
        }
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
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: new URLSearchParams({ _method: 'DELETE' })
        });
        const result = await response.json();
        if (response.ok) {
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            // handle errors
        }
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
    }
}
</script>
