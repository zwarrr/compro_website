<form id="filterForm" class="mb-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter mr-1"></i>
                Filter & Pencarian
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" onclick="openCreateModal()">
                    <i class="fas fa-plus"></i> Tambah Loker
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari posisi/perusahaan/lokasi..." class="form-control" id="searchInput">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                            </div>
                            <select name="status" class="form-control" id="statusSelect">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif" {{ request('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort"></i></span>
                            </div>
                            <select name="sort" class="form-control mr-2" id="sortSelect">
                                <option value="created_at" {{ request('sort', 'created_at') == 'created_at' && request('direction', 'desc') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                <option value="created_at" {{ request('sort', 'created_at') == 'created_at' && request('direction') == 'asc' ? 'selected' : '' }}>Terlama</option>
                                <option value="posisi" {{ request('sort') == 'posisi' ? 'selected' : '' }}>Posisi</option>
                                <option value="perusahaan" {{ request('sort') == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-light border" id="sortDirectionBtn" title="Urutkan {{ request('direction', 'desc') == 'desc' ? 'Dari Besar ke Kecil' : 'Dari Kecil ke Besar' }}">
                                    <span id="sortArrow" style="font-size:1.2em;line-height:1;">{!! request('direction', 'desc') == 'desc' ? '&#8595;' : '&#8593;' !!}</span>
                                </button>
                            </div>
                            <input type="hidden" name="direction" id="directionInput" value="{{ request('direction', 'desc') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.loker.index') }}" class="btn btn-secondary btn-sm ml-2">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const sortBtn = document.getElementById('sortDirectionBtn');
                    const directionInput = document.getElementById('directionInput');
                    const sortArrow = document.getElementById('sortArrow');
                    const sortSelect = document.getElementById('sortSelect');
                    const statusSelect = document.getElementById('statusSelect');
                    const form = document.getElementById('filterForm');
                    if (sortBtn) {
                        sortBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            directionInput.value = directionInput.value === 'desc' ? 'asc' : 'desc';
                            form.submit();
                        });
                    }
                    if (sortSelect) {
                        sortSelect.addEventListener('change', function() {
                            if (sortSelect.value === 'created_at') {
                                if (sortSelect.selectedIndex === 0) {
                                    directionInput.value = 'desc';
                                } else if (sortSelect.selectedIndex === 1) {
                                    directionInput.value = 'asc';
                                }
                            }
                            form.submit();
                        });
                    }
                    if (statusSelect) {
                        statusSelect.addEventListener('change', function() {
                            form.submit();
                        });
                    }
                });
            </script>
        </div>
    </div>
</form>
