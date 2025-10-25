<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit mr-2"></i> Edit Profil Perusahaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form id="editProfileForm" onsubmit="submitEditProfile(event)">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id_perusahaan" name="id_perusahaan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kode Profile</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-code"></i></span>
                                    </div>
                                <input id="edit_kode_profile" name="kode_profile" class="form-control"
                                    readonly>
                                </div>
                            <div class="invalid-feedback d-none" id="error_kode_profile"></div>
                            </div>
                        <div class="col-md-6 mb-3">
                            <label>Nama Perusahaan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-building"></i></span>
                                    </div>
                                <input id="edit_nama_perusahaan" name="nama_perusahaan"
                                    class="form-control">
                                </div>
                            <div class="invalid-feedback d-none" id="error_nama_perusahaan"></div>
                            </div>

                        <div class="col-md-12 mb-3">
                            <label>Slogan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-quote-left"></i></span>
                                    </div>
                                <input id="edit_slogan" name="slogan" class="form-control">
                                </div>
                            <div class="invalid-feedback d-none" id="error_slogan"></div>
                            </div>

                        <div class="col-md-12 mb-3">
                            <label>Deskripsi <span class="text-danger">*</span></label>
                            
                            <textarea id="edit_deskripsi" name="deskripsi" rows="4" class="form-control summernote"></textarea>
                            <div class="invalid-feedback d-none" id="error_deskripsi"></div>
                            
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Visi</label>
                            
                            <textarea id="edit_visi" name="visi" rows="3" class="form-control summernote"></textarea>
                            <div class="invalid-feedback d-none" id="error_visi"></div>
                            
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Misi</label>
                            
                            <textarea id="edit_misi" name="misi" rows="3" class="form-control summernote"></textarea>
                            <div class="invalid-feedback d-none" id="error_misi"></div>
                            
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Alamat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                
                                <textarea id="edit_alamat" name="alamat" rows="3" class="form-control"></textarea>
                                
                            </div>
                            <div class="invalid-feedback d-none" id="error_alamat"></div>
                            </div>

                        <div class="col-md-6 mb-3">
                            <label>Telepon</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                <input id="edit_telepon" name="telepon" class="form-control">
                                </div>
                            <div class="invalid-feedback d-none" id="error_telepon"></div>
                            </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                            class="fas fa-envelope"></i></span>
                                    </div>
                                <input id="edit_email" name="email" class="form-control">
                                </div>
                            <div class="invalid-feedback d-none" id="error_email"></div>
                            </div>

                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Batal</button>
                    <button type="submit" class="btn btn-primary" id="editSubmitBtn"><i class="fas fa-save mr-1"></i>Simpan
                        Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
</div>