<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Kategori
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $kategoris->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($kategoris->count() > 0)
            <div class="table-responsive">
                <table id="kategoriTable1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Kode</th>
                            <th width="35%">Nama Kategori</th>
                            <th width="15%">Tipe</th>
                            <th width="15%">Dibuat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $index => $kategori)
                            <tr>
                                <td>{{ $kategoris->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge badge-secondary">{{ $kategori->kode_kategori }}</span>
                                </td>
                                <td class="font-weight-bold">{{ $kategori->nama_kategori }}</td>
                                <td>
                                    @if ($kategori->tipe == 'layanan')
                                        <span class="badge badge-primary">
                                            <i class="fas fa-briefcase"></i> Layanan
                                        </span>
                                    @elseif($kategori->tipe == 'galeri')
                                        <span class="badge badge-success">
                                            <i class="fas fa-images"></i> Galeri
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-user-tie"></i> Karyawan
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $kategori->created_at ? $kategori->created_at->format('d M Y') : '-' }}
                                    </small>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $kategori->id_kategori }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $kategori->id_kategori }}">
                                            <a class="dropdown-item text-info" href="#" onclick="showDetail({{ $kategori->id_kategori }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $kategori->id_kategori }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $kategori->id_kategori }}, '{{ $kategori->nama_kategori }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div class="mb-2 mb-md-0">
                    <p class="text-sm text-muted mb-0">
                        Menampilkan {{ $kategoris->firstItem() }} sampai {{ $kategoris->lastItem() }}
                        dari {{ $kategoris->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $kategoris->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data kategori yang ditemukan</p>
                @if (request('search') || request('tipe'))
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>