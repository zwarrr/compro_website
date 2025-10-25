<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeCreateModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createFaqForm" onsubmit="submitCreate(event)">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pertanyaan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
                            </div>
                            <input type="text" class="form-control" id="create_pertanyaan" name="pertanyaan" required placeholder="Masukkan pertanyaan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jawaban <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
                            </div>
                            <textarea class="form-control" id="create_jawaban" name="jawaban" rows="3" required placeholder="Masukkan jawaban"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                            </div>
                            <select class="form-control" id="create_status" name="status" required>
                                <option value="publik">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="createSubmitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>