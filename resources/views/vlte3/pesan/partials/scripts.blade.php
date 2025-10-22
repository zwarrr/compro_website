<script>
// ==================== TABLE & FILTER ====================

async function loadPesanTable(page = 1) {
    const form = document.getElementById('filterForm');
    const params = new URLSearchParams(new FormData(form));
    params.append('page', page);
    $('#pesanTableBody').html('<tr><td colspan="8" class="text-center"><div class="spinner-border"></div></td></tr>');
    try {
    const response = await fetch(`/admin/pesan?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        });
        const res = await response.json();
        // res.tableHtml = <tbody>...</tbody>, ambil isinya saja
        let tbodyHtml = res.tableHtml;
        if (tbodyHtml && tbodyHtml.startsWith('<tbody')) {
            // Ambil isi tbody saja
            const match = tbodyHtml.match(/<tbody[^>]*>([\s\S]*)<\/tbody>/i);
            if (match) tbodyHtml = match[1];
        }
        $('#pesanTableBody').html(tbodyHtml);
        $('#pagination').html(res.paginationHtml);
        if (res.total !== undefined) {
            $('#pesanTotal').text(res.total + ' total');
        }
    } catch (error) {
        $('#pesanTableBody').html('<tr><td colspan="8" class="text-center text-danger">Gagal memuat data</td></tr>');
    }
}

function goToPage(page) {
    loadPesanTable(page);
}

// ==================== MODAL MANAGEMENT ====================
async function openDetailModal(id_kontak) {
    $('#detailModal').modal('show');
    $('#detailData').addClass('hidden');
    try {
        const response = await fetch(`/admin/pesan/${id_kontak}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        });
        if (!response.ok) {
            if (response.status === 404) {
                showNotification('Pesan tidak ditemukan', 'error');
            } else {
                showNotification('Gagal mengambil data pesan (server error)', 'error');
            }
            closeDetailModal();
            return;
        }
        const res = await response.json();
        if (res.success && res.data) {
            const data = res.data;
            $('#detail_nama').val(data.nama ?? '');
            $('#detail_email').val(data.email ?? '');
            $('#detail_subjek').val(data.subjek ?? '');
            $('#detail_status_baca').val(data.status_baca === 'belum' ? 'Belum Dibaca' : 'Sudah Dibaca');
            $('#detail_pesan').val(data.pesan ?? '');
            $('#detail_created_at').val(data.created_at ?? '');
            $('#detail_updated_at').val(data.updated_at ?? '');

            // Update badge status di modal
            let badge = data.status_baca === 'belum'
                ? '<span class="badge badge-warning" id="modal_status_badge">Belum Dibaca</span>'
                : '<span class="badge badge-success" id="modal_status_badge">Sudah Dibaca</span>';
            $('#detail_status_baca').parent().find('#modal_status_badge').remove();
            $('#detail_status_baca').parent().append(badge);

            // AJAX: Jika status_baca 'belum', update ke sudah di database dan UI
            if (data.status_baca === 'belum') {
                try {
                    const markRes = await fetch(`/admin/pesan/${id_kontak}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    });
                    const markResult = await markRes.json();
                    if (markRes.ok && markResult.success) {
                        // Update badge status di tabel secara live (lebih spesifik)
                        const row = $(`#pesanTableBody tr`).filter(function() {
                            return $(this).find(`a[onclick*="openDetailModal('${id_kontak}')"]`).length > 0;
                        });
                        row.find('span.badge-warning').removeClass('badge-warning').addClass('badge-success').text('Sudah Dibaca');
                        // Update badge di modal
                        $('#detail_status_baca').val('Sudah Dibaca');
                        $('#modal_status_badge').removeClass('badge-warning').addClass('badge-success').text('Sudah Dibaca');
                    }
                } catch (e) {
                    // silent fail, biarkan UI tetap update
                }
            }

            // Tampilkan tombol balas dan tandai belum dibaca
            if ($('#detail_balas_btn').length === 0) {
                const btns = `
                    <button type="button" class="btn btn-primary mr-2" id="detail_balas_btn">Balas</button>
                    <button type="button" class="btn btn-warning" id="detail_unread_btn">Tandai Belum Dibaca</button>
                `;
                $('#detailModal .modal-footer').prepend(btns);
            }
            // Event balas
            $('#detail_balas_btn').off('click').on('click', function() {
                const email = data.email;
                const subjek = data.subjek ?? '';
                window.location.href = `mailto:${email}?subject=Re: ${subjek}`;
            });
            // Event tandai belum dibaca
            $('#detail_unread_btn').off('click').on('click', async function() {
                try {
                    const res = await fetch(`/admin/pesan/${id_kontak}/mark-unread`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    });
                    const result = await res.json();
                    if (res.ok && result.success) {
                        // Update badge di modal dan table
                        $('#detail_status_baca').val('Belum Dibaca');
                        $('#modal_status_badge').removeClass('badge-success').addClass('badge-warning').text('Belum Dibaca');
                        $(`#pesanTableBody tr`).each(function() {
                            if ($(this).find('a[onclick*="openDetailModal(\'' + id_kontak + '\')"]').length) {
                                $(this).find('span.badge-success').removeClass('badge-success').addClass('badge-warning').text('Belum Dibaca');
                            }
                        });
                        showNotification('Status berhasil diubah ke Belum Dibaca', 'success');
                    } else {
                        showNotification(result.message || 'Gagal menandai belum dibaca', 'error');
                    }
                } catch (e) {
                    showNotification('Gagal menandai belum dibaca', 'error');
                }
            });

            $('#detailData').removeClass('hidden');
        } else {
            showNotification(res.message || 'Gagal mengambil data pesan', 'error');
            closeDetailModal();
        }
    } catch (error) {
        showNotification('Gagal mengambil data pesan (network error)', 'error');
        closeDetailModal();
    }
}
function closeDetailModal() {
    $('#detailModal').modal('hide');
}

function openDeleteModal(id_kontak, nama) {
    $('#deleteModal').modal('show');
    $('#delete_pesan_id').val(id_kontak);
    $('#delete_pesan_nama').text(nama);
}
function closeDeleteModal() {
    $('#deleteModal').modal('hide');
}
async function submitDelete(e) {
    e.preventDefault();
    const submitBtn = document.getElementById('deleteSubmitBtn');
    const id = document.getElementById('delete_pesan_id').value;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    try {
    const response = await fetch(`/admin/pesan/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        const result = await response.json();
        if (response.ok) {
            showNotification(result.message || 'Pesan berhasil dihapus', 'success');
            closeDeleteModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showNotification(result.message || 'Gagal menghapus pesan', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
    }
}

// ==================== HELPER ====================
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

// ==================== FILTER EVENTS ====================
$(document).ready(function() {
    loadPesanTable();
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        loadPesanTable();
    });
    $('#resetFilterBtn').on('click', function() {
        $('#filterForm')[0].reset();
        loadPesanTable();
    });
    // Auto submit on search input (with debounce)
    let searchTimeout;
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            $('#filterForm').submit();
        }, 500);
    });
});
</script>
