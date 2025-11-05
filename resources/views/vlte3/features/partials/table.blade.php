
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Features
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $features->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($features->count() > 0)
            <div class="table-responsive">
                <table id="featuresTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Kode</th>
                            <th width="20%">Judul</th>
                            <th width="20%">Sub Judul</th>
                            <th width="10%">Posisi</th>
                            <th width="10%">Status</th>
                            <th width="12%">Dibuat</th>
                            <th width="13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $index => $feature)
                            <tr>
                                <td>{{ $features->firstItem() + $index }}</td>
                                <td><span class="badge badge-secondary">{{ $feature->kode_features }}</span></td>
                                <td class="font-weight-bold">{{ $feature->judul }}</td>
                                <td>{{ $feature->sub_judul ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="fas fa-map-marker-alt"></i> {{ $feature->replace_position ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($feature->status == 'public')
                                        <span class="badge badge-success"><i class="fas fa-globe"></i> Public</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> Draft</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $feature->created_at ? $feature->created_at->format('d M Y') : '-' }}</small></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $feature->id_features }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $feature->id_features }}">
                                            <a class="dropdown-item text-info" href="#" onclick="showDetail({{ $feature->id_features }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $feature->id_features }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $feature->id_features }}, '{{ $feature->judul }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $features->firstItem() }} sampai {{ $features->lastItem() }}
                        dari {{ $features->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $features->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data features yang ditemukan</p>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.features.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
