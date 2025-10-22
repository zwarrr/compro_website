<script>
// Reuse the same function names and IDs so existing admin scripts can be reused with minimal changes.
function openCreateProfileModal() {
    $('#createProfileModal').modal('show');
    document.getElementById('createProfileForm')?.reset();
    clearProfileErrors();
}
function closeCreateProfileModal() { $('#createProfileModal').modal('hide'); }
function openDetailProfileModal() { $('#detailProfileModal').modal('show'); }
function closeDetailProfileModal() { $('#detailProfileModal').modal('hide'); }

async function openEditProfileModal() {
    $('#editProfileModal').modal('show');
    clearProfileErrors();
    try {
        const response = await fetch(`{{ url('admin/konfigurasi') }}`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }});
        if (!response.ok) throw new Error('Gagal mengambil data');
        const result = await response.json();
        const p = result.profile;
        document.getElementById('edit_id_perusahaan').value = p.id_perusahaan;
        document.getElementById('edit_kode_profile').value = p.kode_profile || '';
        document.getElementById('edit_nama_perusahaan').value = p.nama_perusahaan || '';
        document.getElementById('edit_slogan').value = p.slogan || '';
        document.getElementById('edit_deskripsi').value = p.deskripsi || '';
        document.getElementById('edit_visi').value = p.visi || '';
        document.getElementById('edit_misi').value = p.misi || '';
        document.getElementById('edit_alamat').value = p.alamat || '';
        document.getElementById('edit_telepon').value = p.telepon || '';
        document.getElementById('edit_email').value = p.email || '';
    } catch (e) {
        console.error(e);
        alert('Gagal memuat profil');
        $('#editProfileModal').modal('hide');
    }
}
function closeEditProfileModal() { $('#editProfileModal').modal('hide'); }

function clearProfileErrors() {
    const ids = ['kode_profile','nama_perusahaan','slogan','deskripsi','visi','misi','alamat','telepon','email'];
    ids.forEach(id => {
        const el = document.getElementById('error_' + id);
        if (el) { el.textContent = ''; el.classList.add('d-none'); }
    });
}

async function submitCreateProfile(e) {
    e.preventDefault(); clearProfileErrors();
    const form = document.getElementById('createProfileForm');
    const btn = document.getElementById('createSubmitBtn');
    const spinner = document.getElementById('createLoadingSpinner');
    btn.disabled = true; if (spinner) spinner.classList.remove('d-none');
    try {
        const formData = new FormData(form);
        const res = await fetch(`{{ url('admin/konfigurasi') }}`, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: formData });
        if (res.status === 422) {
            const { errors } = await res.json();
            Object.keys(errors).forEach(k => { const el = document.getElementById('error_' + k); if (el) { el.textContent = errors[k][0]; el.classList.remove('d-none'); } });
            alert('Validasi gagal');
            return;
        }
        if (!res.ok) throw new Error('Gagal menyimpan');
        const data = await res.json();
        location.reload();
    } catch (err) { console.error(err); alert('Gagal menyimpan'); }
    finally { btn.disabled = false; if (spinner) spinner.classList.add('d-none'); }
}

async function submitEditProfile(e) {
    e.preventDefault(); clearProfileErrors();
    const form = document.getElementById('editProfileForm');
    const btn = document.getElementById('editSubmitBtn');
    const spinner = document.getElementById('editLoadingSpinner');
    btn.disabled = true; if (spinner) spinner.classList.remove('d-none');
    try {
        const id = document.getElementById('edit_id_perusahaan').value;
        const formData = new FormData(form); formData.append('_method','PUT');
        const res = await fetch(`{{ url('admin/konfigurasi') }}/${id}`, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }, body: formData });
        if (res.status === 422) { const { errors } = await res.json(); Object.keys(errors).forEach(k => { const el = document.getElementById('error_' + k); if (el) { el.textContent = errors[k][0]; el.classList.remove('d-none'); } }); alert('Validasi gagal'); return; }
        if (!res.ok) throw new Error('Gagal menyimpan');
        const data = await res.json(); location.reload();
    } catch (err) { console.error(err); alert('Gagal menyimpan'); }
    finally { btn.disabled = false; if (spinner) spinner.classList.add('d-none'); }
}

// Fill detail modal when page loads
document.addEventListener('DOMContentLoaded', () => {
    const p = @json(isset($profile) ? $profile : null);
    if (p) {
        document.getElementById('detail_kode_profile').textContent = p.kode_profile;
        document.getElementById('detail_nama_perusahaan').textContent = p.nama_perusahaan;
        document.getElementById('detail_slogan').textContent = p.slogan;
        document.getElementById('detail_deskripsi').textContent = p.deskripsi;
        document.getElementById('detail_visi').textContent = p.visi;
        document.getElementById('detail_misi').textContent = p.misi;
        document.getElementById('detail_alamat').textContent = p.alamat;
        document.getElementById('detail_telepon').textContent = p.telepon;
        document.getElementById('detail_email').textContent = p.email;
    }
});
</script>