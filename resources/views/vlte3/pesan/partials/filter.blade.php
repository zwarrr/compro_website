<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-filter mr-1"></i>
            Filter & Pencarian
        </h3>
    </div>
    <div class="card-body">
        <form method="GET" action="" id="filterForm">
            <div class="row">
                <!-- Search -->
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama/email/subjek..." class="form-control" id="searchInput">
                        </div>
                    </div>
                </div>
                <!-- Filter Status Baca -->
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope-open-text"></i>
                                </span>
                            </div>
                            <select class="form-control" name="status_baca" id="statusBacaSelect">
                                <option value="">Semua Status</option>
                                <option value="belum" {{ request('status_baca') == 'belum' ? 'selected' : '' }}>Belum Dibaca
                                </option>
                                <option value="sudah" {{ request('status_baca') == 'sudah' ? 'selected' : '' }}>Sudah Dibaca
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group d-flex">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i>
                            Filter</button>
                        <button type="button" class="btn btn-secondary" id="resetFilterBtn"><i class="fas fa-undo"></i>
                            Reset</button>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const statusSelect = document.getElementById('statusBacaSelect');
                                if (statusSelect) {
                                    statusSelect.addEventListener('change', function() {
                                        document.getElementById('filterForm').submit();
                                    });
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
