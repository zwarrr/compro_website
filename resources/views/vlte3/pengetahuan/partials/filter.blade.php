<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-filter mr-1"></i>
            Filter & Pencarian
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-create">
                <i class="fas fa-plus"></i> Tambah Pengetahuan
            </button>
        </div>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.pengetahuan.index') }}" id="filterForm">
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
                                placeholder="Cari kode/kategori/jawaban..." class="form-control"
                                id="searchInput">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="{{ route('admin.pengetahuan.index') }}" class="btn btn-secondary ml-2">
                                    <i class="fas fa-sync"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Filter Kategori Pertanyaan -->
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-filter"></i>
                                </span>
                            </div>
                            <select name="kategori_pertanyaan" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Kategori Pertanyaan</option>
                                @foreach($kategoriPertanyaanList as $kategori)
                                    <option value="{{ $kategori }}" {{ request('kategori_pertanyaan') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Filter Sub Kategori -->
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-filter"></i>
                                </span>
                            </div>
                            <select name="sub_kategori" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Sub Kategori</option>
                                @foreach($subKategoriList as $sub)
                                    <option value="{{ $sub }}" {{ request('sub_kategori') == $sub ? 'selected' : '' }}>{{ $sub }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- ...no extra filter button needed, handled above... -->
            </div>
        </form>
    </div>
</div>
