<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-filter mr-1"></i>
            Filter & Pencarian
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCreate">
                <i class="fas fa-plus"></i> Tambah Page
            </button>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.page.index') }}" id="filterForm">
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
                                placeholder="Cari judul/kode page..." class="form-control"
                                id="searchInput">
                        </div>
                    </div>
                </div>
                <!-- Filter Digunakan Untuk -->
                {{-- <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-cog"></i>
                                </span>
                            </div>
                            <input type="text" name="digunakan_untuk" value="{{ request('digunakan_untuk') }}" placeholder="Digunakan Untuk..." class="form-control" onchange="this.form.submit()">
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-image"></i>
                                </span>
                            </div>
                            <select name="ilustrasi_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Ilustrasi</option>
                                @foreach($ilustrasis as $ilustrasi)
                                    <option value="{{ $ilustrasi->id_ilustrasi }}" {{ request('ilustrasi_id') == $ilustrasi->id_ilustrasi ? 'selected' : '' }}>{{ $ilustrasi->judul }}</option>
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
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="public" {{ request('status') == 'public' ? 'selected' : '' }}>Public</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
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
                                <option value="kode_page" {{ request('sort') == 'kode_page' ? 'selected' : '' }}>Kode Page</option>
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
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.page.index') }}" class="btn btn-secondary btn-sm ml-2">
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
                });
            </script>
        </form>
    </div>
</div>
