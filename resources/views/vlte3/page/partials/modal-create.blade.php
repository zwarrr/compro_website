<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 900px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus mr-2"></i>Tambah Page
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createPageForm" onsubmit="submitCreate(event)" style="width:100%;">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-2">
                        <!-- Baris 1: Ilustrasi, Judul, Digunakan Untuk -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="digunakan_untuk">Digunakan Untuk <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-cog"></i></span>
                                        </div>
                                        <select class="form-control" id="digunakan_untuk" name="digunakan_untuk" required>
                                            <option value="">-- Pilih Kegunaan --</option>
                                            <option value="hero">Hero Section</option>
                                            <option value="team">Team Section</option>
                                            <option value="features">Features Section</option>
                                            <option value="client">Client Section</option>
                                            <option value="faq">Faq Section</option>
                                            <option value="galeri">Galeri Section</option>
                                            <option value="loker">Loker Section</option>
                                            <option value="kontak">Kontak Section</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="ilustrasi_id">Ilustrasi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <select class="form-control" id="ilustrasi_id" name="ilustrasi_id" required>
                                            <option value="">-- Pilih Ilustrasi --</option>
                                            @foreach($ilustrasis as $ilustrasi)
                                                <option value="{{ $ilustrasi->id_ilustrasi }}">{{ $ilustrasi->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="judul">Judul <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="judul" name="judul" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Baris 2: Sub Judul dan Status -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="sub_judul">Sub Judul</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="sub_judul" name="sub_judul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                        </div>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="public">Public</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Baris 3: Deskripsi (Full Width) -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi lengkap..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Baris 4: Button Primary -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_primary_text">Button Primary Text</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mouse-pointer"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="button_primary_text" name="button_primary_text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_primary_link">Button Primary Link</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="button_primary_link" name="button_primary_link">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Baris 5: Button Secondary -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_secondary_text">Button Secondary Text</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mouse-pointer"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="button_secondary_text" name="button_secondary_text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_secondary_link">Button Secondary Link</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="button_secondary_link" name="button_secondary_link">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="createSubmitBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>