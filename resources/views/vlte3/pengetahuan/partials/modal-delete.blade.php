<!-- Modal Delete Pengetahuan -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-delete-pengetahuan">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Hapus Pengetahuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_pengetahuan" id="delete-id-pengetahuan">
                    <p id="delete-pengetahuan-name">Apakah Anda yakin ingin menghapus pengetahuan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" onclick="submitDelete(event)">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
