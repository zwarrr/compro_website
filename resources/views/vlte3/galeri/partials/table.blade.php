<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-images mr-1"></i>
            Daftar Galeri
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $galeris->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($galeris->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Gambar</th>
                            <th width="13%">Kode</th>
                            <th width="20%">Judul</th>
                            <th width="13%">Kategori</th>
                            <th width="10%">Status</th>
                            <th width="12%">Dibuat</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galeris as $index => $galeri)
                            <tr>
                                <td>{{ $galeris->firstItem() + $index }}</td>
                                <td>
                                    @if ($galeri->gambar)
                                        <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="img" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit:cover;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
                                    @endif
                                </td>
                                <td><span class="badge badge-secondary">{{ $galeri->kode_galeri }}</span></td>
                                <td class="font-weight-bold">{{ $galeri->judul }}</td>
                                <td>{{ $galeri->kategori->nama_kategori ?? '-' }}</td>
                                <td>
                                    @if ($galeri->status == 'aktif')
                                        <span class="badge badge-success"><i class="fas fa-check"></i> Aktif</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-times"></i> Nonaktif</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $galeri->created_at ? $galeri->created_at->format('d M Y') : '-' }}</small></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $galeri->id_galeri }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $galeri->id_galeri }}">
                                            <a class="dropdown-item text-info" href="#" onclick="showDetail({{ $galeri->id_galeri }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $galeri->id_galeri }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $galeri->id_galeri }}, '{{ $galeri->judul }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $galeris->firstItem() }} sampai {{ $galeris->lastItem() }}
                        dari {{ $galeris->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $galeris->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data galeri yang ditemukan</p>
                @if (request('search') || request('kategori_id') || request('status'))
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
