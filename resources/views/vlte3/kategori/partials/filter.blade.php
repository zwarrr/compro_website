<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-filter mr-1"></i>
            Filter & Pencarian
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.kategori.index') }}" id="filterForm">
            <div class="row">
                <!-- Search -->
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama kategori atau kode..." class="form-control"
                                id="searchInput">
                        </div>
                    </div>
                </div>

                <!-- Filter Tipe -->
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-filter"></i>
                                </span>
                            </div>
                            <select name="tipe" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Tipe</option>
                                <option value="layanan" {{ request('tipe') == 'layanan' ? 'selected' : '' }}>Layanan</option>
                                <option value="galeri" {{ request('tipe') == 'galeri' ? 'selected' : '' }}>Galeri</option>
                                <option value="karyawan" {{ request('tipe') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                <option value="divisi" {{ request('tipe') == 'divisi' ? 'selected' : '' }}>Divisi</option>
                                <option value="client" {{ request('tipe') == 'client' ? 'selected' : '' }}>Client</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Sort -->
                <div class="col-md-5">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort"></i></span>
                            </div>
                            <select name="sort" class="form-control" id="sortSelect">
                                <option value="created_at" {{ request('sort', 'created_at') == 'created_at' && request('direction', 'desc') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                <option value="created_at" {{ request('sort', 'created_at') == 'created_at' && request('direction') == 'asc' ? 'selected' : '' }}>Terlama</option>
                                <option value="nama_kategori" {{ request('sort') == 'nama_kategori' ? 'selected' : '' }}>Nama Kategori</option>
                                <option value="kode_kategori" {{ request('sort') == 'kode_kategori' ? 'selected' : '' }}>Kode Kategori</option>
                            </select>
                            <button type="button" class="btn btn-light border ml-2" id="sortDirectionBtn" title="Urutkan {{ request('direction', 'desc') == 'desc' ? 'Dari Besar ke Kecil' : 'Dari Kecil ke Besar' }}">
                                <span id="sortArrow">{!! request('direction', 'desc') == 'desc' ? '&#8595;' : '&#8593;' !!}</span>
                            </button>
                            <input type="hidden" name="direction" id="directionInput" value="{{ request('direction', 'desc') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary btn-sm ml-2">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                </div>
            </div>

            <script>
                // Ganti arah sort ASC/DESC secara live
                document.addEventListener('DOMContentLoaded', function() {
                    const sortBtn = document.getElementById('sortDirectionBtn');
                    const directionInput = document.getElementById('directionInput');
                    const sortArrow = document.getElementById('sortArrow');
                    const sortSelect = document.getElementById('sortSelect');
                    const form = document.getElementById('filterForm');

                    if (sortBtn) {
                        sortBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            directionInput.value = directionInput.value === 'desc' ? 'asc' : 'desc';
                            form.submit();
                        });
                    }

                    // Jika pilih Terbaru/Terlama, otomatis set direction
                    if (sortSelect) {
                        sortSelect.addEventListener('change', function() {
                            if (sortSelect.value === 'created_at') {
                                // Jika option ke-1 (Terbaru) dipilih, direction desc, ke-2 (Terlama) asc
                                if (sortSelect.selectedIndex === 0) {
                                    directionInput.value = 'desc';
                                } else if (sortSelect.selectedIndex === 1) {
                                    directionInput.value = 'asc';
                                }
                            }
                            form.submit();
                        });
                    }
                });
            </script>
        </form>
    </div>
</div>