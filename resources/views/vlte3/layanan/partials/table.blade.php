<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Layanan
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $layanans->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($layanans->count() > 0)
            <div class="table-responsive">
                <table id="layananTable1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Gambar</th>
                            <th width="10%">Background</th>
                            <th width="13%">Kode</th>
                            <th width="20%">Judul</th>
                            <th width="13%">Kategori</th>
                            <th width="10%">Status</th>
                            <th width="12%">Link</th>
                            <th width="10%">Dibuat</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanans as $index => $layanan)
                            <tr>
                                <td>{{ $layanans->firstItem() + $index }}</td>
                                <td>
                                    @if ($layanan->gambar)
                                        <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="img" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit:cover;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($layanan->background)
                                        <img src="{{ asset('storage/' . $layanan->background) }}" alt="bg" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit:cover;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
                                    @endif
                                </td>
                                <td><span class="badge badge-secondary">{{ $layanan->kode_layanan }}</span></td>
                                <td class="font-weight-bold">{{ $layanan->judul }}</td>
                                <td>{{ $layanan->kategori->nama_kategori ?? '-' }}</td>
                                <td>
                                    @if ($layanan->status == 'publik')
                                        <span class="badge badge-success"><i class="fas fa-globe"></i> Publik</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> Draft</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($layanan->link && preg_match('/^https?:\/\//', $layanan->link))
                                        <a href="{{ $layanan->link }}" target="_blank" rel="noopener" class="badge badge-primary px-2 py-1" style="font-size:0.95em;">
                                            <i class="fas fa-external-link-alt"></i> {{ $layanan->link }}
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $layanan->created_at ? $layanan->created_at->format('d M Y') : '-' }}</small></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $layanan->id_layanan }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $layanan->id_layanan }}">
                                            <a class="dropdown-item text-info" href="#" onclick="showDetail({{ $layanan->id_layanan }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $layanan->id_layanan }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $layanan->id_layanan }}, '{{ $layanan->judul }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $layanans->firstItem() }} sampai {{ $layanans->lastItem() }}
                        dari {{ $layanans->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $layanans->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data layanan yang ditemukan</p>
                @if (request('search') || request('kategori_id') || request('status'))
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
