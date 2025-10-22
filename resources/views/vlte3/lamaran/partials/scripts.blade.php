<script>
    // Konfirmasi SweetAlert untuk aksi Tolak Lamaran
    function confirmTolakLamaran(id, nama) {
        if (typeof Swal === 'undefined') {
            // fallback jika SweetAlert tidak tersedia
            if(confirm('Yakin ingin menolak lamaran dari ' + nama + '?')) {
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
    // Lamaran scripts (modeled after loker partials)
function notify(message, type = 'success'){
    $('#notification').remove();
    const icon = type === 'success' ? '<i class="fas fa-check-circle mr-2"></i>' : '<i class="fas fa-exclamation-circle mr-2"></i>';
    const el = $(
        `<div id="notification" class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">${icon}${message}<button type="button" class="close" data-dismiss="alert">&times;</button></div>`
    );
    $('body').append(el);
    setTimeout(()=> el.alert('close'), 5000);
}

let currentLamaranId = null;

async function showLamaranDetail(id){
    currentLamaranId = id;
    $('#modalLamaranDetail').modal('show');
    $('#lamaranDetailContent').html('<div class="text-center py-5 text-muted">Memuat...</div>');
    try{
        const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
        if(!res.ok) throw new Error('Gagal memuat');
        const data = await res.json();
        const l = data.lamaran || data;
        const html = `
            <div class="row">
                <div class="col-md-8">
                    <h5>${l.kode_lamaran} - ${l.nama_lengkap}</h5>
                    <p><strong>Email:</strong> ${l.email}</p>
                    <p><strong>Loker:</strong> ${l.loker ? l.loker.posisi + ' - ' + l.loker.perusahaan : '-'}</p>
                    <p><strong>Pesan:</strong><br>${l.pesan || '-'}</p>
                    <p><strong>Catatan HRD:</strong><br>${l.catatan_hrd || '-'}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Status:</strong> <span class="badge badge-info">${l.status}</span></p>
                    <p><strong>Dibuat:</strong><br>${l.created_at}</p>
                    <p><strong>Resume:</strong><br>${l.resume ? `<a href='${l.resume}' target='_blank'>Download</a>` : '-'}</p>
                </div>
            </div>
        `;
        $('#lamaranDetailContent').html(html);
        // ensure reply id fallback
        if($('#lamaran_id_for_reply').length) $('#lamaran_id_for_reply').val(id);
    }catch(e){
        console.error(e);
        $('#lamaranDetailContent').html('<div class="text-danger">Gagal memuat data</div>');
    }
}

function openReplyModal(){
    const id = currentLamaranId || $('#lamaran_id_for_reply').val();
    if(!id) return notify('Tidak ada lamaran yang dipilih', 'error');
    $('#lamaran_id_for_reply').val(id);
    $('#modalLamaranBalas').modal('show');
}

async function submitReply(e){
    e.preventDefault();
    const id = currentLamaranId || $('#lamaran_id_for_reply').val();
    if(!id) return notify('Tidak ada lamaran yang dipilih', 'error');
    const btn = $('#sendBalasBtn');
    const payload = { catatan_hrd: $('#catatan_hrd').val(), tanggal_interview: $('#tanggal_interview').val() };
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');
    try{
        const res = await fetch(`{{ url('admin/lamaran') }}/${id}/reply`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: JSON.stringify(payload)
        });
        const data = await res.json().catch(()=>null);
        if(res.ok){
            $('#modalLamaranBalas').modal('hide');
            $('#modalLamaranDetail').modal('hide');
            notify((data && data.message) || 'Balasan terkirim', 'success');
            setTimeout(()=> location.reload(),800);
        } else {
            notify((data && data.message) || 'Gagal mengirim balasan', 'error');
        }
    }catch(err){
        console.error(err);
        notify('Gagal mengirim balasan', 'error');
    }finally{
        btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Kirim Balasan');
    }
}

function confirmDeleteLamaran(id, name){
    console.log('[LAMARAN] Konfirmasi hapus untuk id =', id, ', nama =', name);
    $('#deleteLamaranText').text('Hapus lamaran dari: ' + name + ' (ID: ' + id + ')?');
    // set both jQuery data dan attribute supaya robust
    $('#confirmDeleteLamaranBtn').data('id', id).attr('data-id', id);
    // lepas handler lama lalu pasang handler baru agar tidak dobel
    $('#confirmDeleteLamaranBtn').off('click').on('click', function(e){
        e.preventDefault();
        console.log('[LAMARAN] Tombol Hapus diklik, id =', id);
        submitDeleteLamaran();
    });
    $('#modalLamaranDelete').modal('show');
}

async function submitDeleteLamaran(){
    const btn = $('#confirmDeleteLamaranBtn');
    const id = btn.data('id') || btn.attr('data-id');
    console.log('[LAMARAN] Proses hapus, id =', id);
    if(!id) {
        notify('ID lamaran tidak valid, tidak bisa menghapus!', 'error');
        console.warn('[LAMARAN] Gagal hapus: id tidak ditemukan di tombol konfirmasi');
        return;
    }
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menghapus...');
    try{
        const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
        const data = await res.json().catch(()=>null);
        if(res.ok){
            $('#modalLamaranDelete').modal('hide');
            notify((data && data.message) || 'Lamaran berhasil dihapus.', 'success');
            setTimeout(()=> location.reload(),800);
        } else {
            notify((data && data.message) || 'Gagal menghapus lamaran. Silakan coba lagi.', 'error');
        }
    }catch(err){
        console.error('[LAMARAN] Error saat hapus:', err);
        notify('Terjadi kesalahan saat menghapus lamaran.', 'error');
    }finally{
        btn.prop('disabled', false).text('Hapus');
    }
}

async function rejectLamaran(id){
    if(!id) return notify('ID tidak valid', 'error');
    try{
        const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, body: JSON.stringify({ status: 'Ditolak' }) });
        const data = await res.json().catch(()=>null);
        if(res.ok){ notify((data && data.message) || 'Lamaran ditolak', 'success'); setTimeout(()=> location.reload(),800); } else { notify((data && data.message) || 'Gagal menolak', 'error'); }
    }catch(err){ console.error(err); notify('Gagal menolak lamaran', 'error'); }
}

async function cancelLamaran(id){
    if(!id) return notify('ID tidak valid', 'error');
    try{
        const res = await fetch(`{{ url('admin/lamaran') }}/${id}`, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, body: JSON.stringify({ status: 'Diajukan' }) });
        const data = await res.json().catch(()=>null);
        if(res.ok){ notify((data && data.message) || 'Lamaran dibatalkan', 'success'); setTimeout(()=> location.reload(),800); } else { notify((data && data.message) || 'Gagal membatalkan', 'error'); }
    }catch(err){ console.error(err); notify('Gagal membatalkan lamaran', 'error'); }
}

// Attach handlers when DOM ready
$(function(){
    // reply form
    $('#formBalasLamaran').on('submit', submitReply);
    // reply button in detail modal
    $(document).on('click', '#btnReply', openReplyModal);
    // Handler hapus sekarang dipasang ulang setiap modal dibuka lewat confirmDeleteLamaran
    // delegated actions (table uses onclick inline, so functions are global)
});
</script>
