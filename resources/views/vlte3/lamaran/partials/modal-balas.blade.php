<!-- Modal Balas Lamaran -->
<div class="modal fade" id="modalLamaranBalas" tabindex="-1" role="dialog" aria-labelledby="modalLamaranBalasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLamaranBalasLabel">Balas Lamaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formBalasLamaran" onsubmit="return false;">
                <div class="modal-body">
                    <!-- PASTIKAN INPUT HIDDEN ADA -->
                    <input type="hidden" id="lamaran_id_for_reply" name="lamaran_id" value="">
                    <div class="form-group">
                        <label for="catatan_hrd">Catatan HRD <span class="text-danger">*</span></label>
                        <textarea name="catatan_hrd" id="catatan_hrd" class="form-control" rows="4" placeholder="Masukkan catatan untuk pelamar..." required></textarea>
                        <small class="form-text text-muted">Catatan ini akan dikirimkan ke email pelamar</small>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_interview">Tanggal Interview</label>
                        <input type="datetime-local" name="tanggal_interview" id="tanggal_interview" class="form-control">
                        <small class="form-text text-muted">Opsional - Atur jadwal interview jika diperlukan</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="sendBalasBtn" onclick="try{ submitReply(); }catch(e){ console && console.error(e); }">
                        <i class="fas fa-paper-plane"></i> Kirim Balasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>