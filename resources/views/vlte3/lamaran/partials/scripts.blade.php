<script>
    // Konfirmasi SweetAlert untuk aksi Tolak Lamaran
    function confirmTolakLamaran(id, nama) {
        console.log('confirmTolakLamaran called', id, nama);
        if (typeof Swal === 'undefined') {
            if (confirm('Yakin ingin menolak lamaran dari ' + nama + '?')) {
                rejectLamaran(id);
            }
            return;
        }
        Swal.fire({
            title: 'Tolak Lamaran?',
            html: 'Yakin ingin menolak lamaran dari <b>' + nama + '</b>?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                rejectLamaran(id);
            }
        });
    }

    function notify(message, type = 'success') {
        $('#notification').remove();
        const icon = type === 'success' ? '<i class="fas fa-check-circle mr-2"></i>' :
            '<i class="fas fa-exclamation-circle mr-2"></i>';
        const el = $(
            `<div id="notification" class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">${icon}${message}<button type="button" class="close" data-dismiss="alert">&times;</button></div>`
        );
        $('body').append(el);
        setTimeout(() => el.alert('close'), 5000);
    }

    let currentLamaranId = null;

    async function showLamaranDetail(id) {
        console.log('showLamaranDetail', id);
        currentLamaranId = id;

        // SET ID KE INPUT HIDDEN
        $('#currentLamaranId').val(id);

        $('#modalLamaranDetail').modal('show');
        // Kosongkan dulu semua field
        $('#detail-kode-nama').text('');
        $('#detail-email').text('');
        $('#detail-loker').text('');
        $('#detail-pesan').val('');
        $('#detail-catatan-hrd').val('');
        $('#detail-status').text('');
        $('#detail-created-at').text('');
        $('#detail-resume').html('');

        try {
            const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) throw new Error('Gagal memuat');
            const data = await res.json();
            const l = data.lamaran || data;
            $('#detail-kode-nama').text((l.kode_lamaran || '-') + ' - ' + (l.nama_lengkap || '-'));
            $('#detail-email').text(l.email || '-');
            $('#detail-loker').text(l.loker ? (l.loker.posisi + ' - ' + l.loker.perusahaan) : '-');
            $('#detail-pesan').val(l.pesan || '-');
            $('#detail-catatan-hrd').val(l.catatan_hrd || '-');
            $('#detail-status').text(l.status || '-');
            $('#detail-created-at').text(l.created_at || '-');
            $('#detail-resume').html(l.resume ? `<a href='../storage/${l.resume}' target='_blank' class='btn btn-sm btn-outline-primary'><i class="fas fa-download mr-1"></i>Download</a>` : '-');
            console.log('Detail loaded successfully');
        } catch (e) {
            console.error('Error loading detail:', e);
            // Tampilkan error di salah satu field
            $('#detail-kode-nama').text('Gagal memuat data');
        }
    }

    // FUNGSI UNTUK TOMBOL BALAS
    function openReplyModal() {
        console.log('openReplyModal called');

        // Ambil ID dari berbagai sumber
        const idFromHidden = $('#currentLamaranId').val();
        const idFromVariable = currentLamaranId;

        console.log('ID from hidden field:', idFromHidden);
        console.log('ID from variable:', idFromVariable);

        const id = idFromHidden || idFromVariable;

        if (!id) {
            console.error('No ID found for reply!');
            notify('Tidak ada lamaran yang dipilih', 'error');
            return;
        }

        console.log('Opening reply modal for ID:', id);

        // Set ID ke modal balas
        $('#lamaran_id_for_reply').val(id);
        $('#modalLamaranBalas').modal('show');
    }

    // FUNGSI UNTUK TOMBOL TOLAK
    function rejectLamaranFromModal() {
        console.log('rejectLamaranFromModal called');

        // Ambil ID dari berbagai sumber
        const idFromHidden = $('#currentLamaranId').val();
        const idFromVariable = currentLamaranId;

        console.log('ID from hidden field:', idFromHidden);
        console.log('ID from variable:', idFromVariable);

        const id = idFromHidden || idFromVariable;

        if (!id) {
            console.error('No ID found for rejection!');
            notify('Tidak ada lamaran yang dipilih', 'error');
            return;
        }

        // Ambil nama dari konten yang sudah dimuat
        let nama = 'Pelamar';
        try {
            const namaElement = $('#lamaranDetailContent').find('h5');
            if (namaElement.length) {
                const fullText = namaElement.text();
                const parts = fullText.split(' - ');
                if (parts.length > 1) {
                    nama = parts[1];
                }
            }
        } catch (e) {
            console.log('Error getting name:', e);
        }

        console.log('Confirming rejection for:', nama, 'ID:', id);
        confirmTolakLamaran(id, nama);
    }

    // FUNGSI BALAS LAMARAN (untuk form submit)
    async function submitReply(e) {
        console.log('submitReply called');
        if (e && typeof e.preventDefault === 'function') e.preventDefault();

        const id = $('#lamaran_id_for_reply').val();
        console.log('Submitting reply for ID:', id);

        if (!id) {
            notify('Tidak ada lamaran yang dipilih', 'error');
            return;
        }

        const btn = $('#sendBalasBtn');
        const payload = {
            catatan_hrd: $('#catatan_hrd').val(),
            tanggal_interview: $('#tanggal_interview').val()
        };

        console.log('Payload:', payload);

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');

        try {
            const res = await fetch(`{{ url('admin/lamaran') }}/${id}/reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json().catch(() => null);
            console.log('Response status:', res.status, 'Data:', data);

            if (res.ok) {
                $('#modalLamaranBalas').modal('hide');
                $('#modalLamaranDetail').modal('hide');
                notify((data && data.message) || 'Balasan terkirim', 'success');
                setTimeout(() => location.reload(), 800);
            } else {
                notify((data && data.message) || 'Gagal mengirim balasan', 'error');
            }
        } catch (err) {
            console.error('Error in submitReply:', err);
            notify('Gagal mengirim balasan', 'error');
        } finally {
            btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Kirim Balasan');
        }
    }

    // FUNGSI TOLAK LAMARAN
    async function rejectLamaran(id) {
        console.log('rejectLamaran called with id:', id);

        if (!id) {
            notify('ID tidak valid', 'error');
            return;
        }

        try {
            const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: 'Ditolak'
                })
            });

            const data = await res.json().catch(() => null);
            console.log('Reject response:', data);

            if (res.ok) {
                $('#modalLamaranDetail').modal('hide');
                notify((data && data.message) || 'Lamaran ditolak', 'success');
                setTimeout(() => location.reload(), 800);
            } else {
                notify((data && data.message) || 'Gagal menolak', 'error');
            }
        } catch (err) {
            console.error('Error in rejectLamaran:', err);
            notify('Gagal menolak lamaran', 'error');
        }
    }

    // FUNGSI LAINNYA (delete, cancel, dll) - tetap sama
    function confirmDeleteLamaran(id, name) {
        console.log('confirmDeleteLamaran', id, name);
        $('#deleteLamaranText').text('Hapus lamaran dari: ' + name + ' (ID: ' + id + ')?');
        $('#confirmDeleteLamaranBtn').data('id', id).attr('data-id', id);

        $('#confirmDeleteLamaranBtn').off('click').on('click', function(e) {
            e.preventDefault();
            submitDeleteLamaran();
        });

        $('#modalLamaranDelete').modal('show');
    }

    async function submitDeleteLamaran() {
        const btn = $('#confirmDeleteLamaranBtn');
        const id = btn.data('id') || btn.attr('data-id');

        if (!id) {
            notify('ID lamaran tidak valid', 'error');
            return;
        }

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menghapus...');

        try {
            const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await res.json().catch(() => null);

            if (res.ok) {
                $('#modalLamaranDelete').modal('hide');
                notify((data && data.message) || 'Lamaran berhasil dihapus.', 'success');
                setTimeout(() => location.reload(), 800);
            } else {
                notify((data && data.message) || 'Gagal menghapus lamaran.', 'error');
            }
        } catch (err) {
            console.error('Error deleting:', err);
            notify('Terjadi kesalahan saat menghapus lamaran.', 'error');
        } finally {
            btn.prop('disabled', false).text('Hapus');
        }
    }

    async function cancelLamaran(id) {
        if (!id) return notify('ID tidak valid', 'error');

        try {
            const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: 'Diajukan'
                })
            });

            const data = await res.json().catch(() => null);

            if (res.ok) {
                notify((data && data.message) || 'Lamaran dibatalkan', 'success');
                setTimeout(() => location.reload(), 800);
            } else {
                notify((data && data.message) || 'Gagal membatalkan', 'error');
            }
        } catch (err) {
            console.error(err);
            notify('Gagal membatalkan lamaran', 'error');
        }
    }


    // Fungsi untuk membuka modal edit lamaran
    function openEditLamaranModal(id, nama, status, email, kode_lamaran, nama_lengkap) {
        $('#edit_lamaran_id').val(id);
        $('#edit_kode_lamaran').val(kode_lamaran);
        $('#edit_nama_lengkap').val(nama_lengkap);
        $('#edit_email').val(email);
        $('#edit_status').val(status);
        $('#modalLamaranEdit').modal('show');
    }

    // Handler untuk form balas dan edit lamaran
    $(document).ready(function() {
        console.log('Document ready - attaching form handler');
        // keep form submit handler (in case of enter key)
        $('#formBalasLamaran').on('submit', submitReply);
        // ensure click on the button triggers the same AJAX flow and does not submit the form normally
        $('#sendBalasBtn').off('click').on('click', function(evt) {
            evt.preventDefault();
            submitReply();
        });

        // Handler untuk form edit lamaran
        $('#formEditLamaran').on('submit', submitEditLamaran);
        $('#saveEditLamaranBtn').off('click').on('click', function(evt) {
            evt.preventDefault();
            submitEditLamaran();
        });
    });

    // Fungsi submit edit lamaran (status saja)
    async function submitEditLamaran(e) {
        if (e && typeof e.preventDefault === 'function') e.preventDefault();
        const id = $('#edit_lamaran_id').val();
        const status = $('#edit_status').val();
        const btn = $('#saveEditLamaranBtn');
        if (!id) {
            notify('ID lamaran tidak valid', 'error');
            return;
        }
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
        try {
            const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status
                })
            });
            const data = await res.json().catch(() => null);
            if (res.ok) {
                $('#modalLamaranEdit').modal('hide');
                notify((data && data.message) || 'Status lamaran berhasil diubah.', 'success');
                setTimeout(() => location.reload(), 800);
            } else {
                notify((data && data.message) || 'Gagal mengubah status lamaran.', 'error');
            }
        } catch (err) {
            console.error('Error edit lamaran:', err);
            notify('Terjadi kesalahan saat mengubah status lamaran.', 'error');
        } finally {
            btn.prop('disabled', false).text('Simpan Perubahan');
        }
    }
</script>
