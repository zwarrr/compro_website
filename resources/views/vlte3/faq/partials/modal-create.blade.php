<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus mr-2"></i>Tambah FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeCreateModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createFaqForm" onsubmit="submitCreate(event)">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create_pertanyaan">Pertanyaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="create_pertanyaan" name="pertanyaan" required>
                    </div>
                    <div class="form-group">
                        <label for="create_jawaban">Jawaban <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="create_jawaban" name="jawaban" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="create_status">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="create_status" name="status" required>
                            <option value="publik">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeCreateModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="createSubmitBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
