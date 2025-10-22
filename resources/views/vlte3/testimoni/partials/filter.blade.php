<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-filter mr-1"></i>
            Filter & Pencarian
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" onclick="openCreateModal()">
                <i class="fas fa-plus"></i> Tambah Testimoni
            </button>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.testimoni.index') }}" id="filterForm">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/jabatan..." class="form-control" id="searchInput">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                            </div>
                            <select name="status" class="form-control" id="statusSelect">
                                <option value="">Semua Status</option>
                                <option value="publik" {{ request('status') == 'publik' ? 'selected' : '' }}>Publik</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-star"></i></span>
                            </div>
                            <select name="rating" class="form-control" id="ratingSelect">
                                <option value="">Semua Rating</option>
                                @for($i=1;$i<=5;$i++)
                                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                                @endfor
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
                                <option value="nama_testimoni" {{ request('sort') == 'nama_testimoni' ? 'selected' : '' }}>Nama</option>
                                <option value="jabatan" {{ request('sort') == 'jabatan' ? 'selected' : '' }}>Jabatan</option>
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
                    <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary btn-sm ml-2">
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
        const statusSelect = document.getElementById('statusSelect');
        const ratingSelect = document.getElementById('ratingSelect');
        const sortBtn = document.getElementById('sortDirectionBtn');
        const directionInput = document.getElementById('directionInput');
        const sortSelect = document.getElementById('sortSelect');
        if (statusSelect) statusSelect.addEventListener('change', function() { form.submit(); });
        if (ratingSelect) ratingSelect.addEventListener('change', function() { form.submit(); });
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
