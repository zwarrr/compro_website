@php
// $kategoris harus sudah tersedia dari controller
@endphp
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-filter mr-1"></i>
            Filter & Pencarian
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Tambah Galeri
            </button>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.galeri.index') }}" id="filterForm">
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
                                placeholder="Cari judul/kode galeri..." class="form-control"
                                id="searchInput">
                        </div>
                    </div>
                </div>
                <!-- Filter Kategori -->
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-filter"></i>
                                </span>
                            </div>
                            <select name="kategori_id" class="form-control" id="kategoriSelect">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}" {{ request('kategori_id') == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Filter Status -->
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-toggle-on"></i>
                                </span>
                            </div>
                            <select name="status" class="form-control" id="statusSelect">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Sort -->
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort"></i></span>
                            </div>
                            <select name="sort" class="form-control mr-2" id="sortSelect">
                                <option value="created_at" {{ request('sort', 'created_at') == 'created_at' && request('direction', 'desc') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                                <option value="created_at" {{ request('sort', 'created_at') == 'created_at' && request('direction') == 'asc' ? 'selected' : '' }}>Terlama</option>
                                <option value="judul" {{ request('sort') == 'judul' ? 'selected' : '' }}>Judul</option>
                                <option value="kode_galeri" {{ request('sort') == 'kode_galeri' ? 'selected' : '' }}>Kode Galeri</option>
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
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-sm ml-2">
                        <i class="fas fa-sync"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filterForm');
        const kategoriSelect = document.getElementById('kategoriSelect');
        const statusSelect = document.getElementById('statusSelect');
        const sortBtn = document.getElementById('sortDirectionBtn');
        const directionInput = document.getElementById('directionInput');
        const sortSelect = document.getElementById('sortSelect');

        // Live submit on kategori/status change
        if (kategoriSelect) kategoriSelect.addEventListener('change', function() { form.submit(); });
        if (statusSelect) statusSelect.addEventListener('change', function() { form.submit(); });

        // Sort direction toggle
        if (sortBtn) {
            sortBtn.addEventListener('click', function(e) {
                e.preventDefault();
                directionInput.value = directionInput.value === 'desc' ? 'asc' : 'desc';
                form.submit();
            });
        }
        // Sort select change
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
    });
</script>
