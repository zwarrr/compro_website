<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Loker
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $lokers->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($lokers->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:40px;">No</th>
                            <th>Kode</th>
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th>Lokasi</th>
                            <th>Gaji</th>
                            <th>Total Lamaran</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="lokerTableBody">
                        @foreach ($lokers as $index => $loker)
                            <tr>
                                <td>{{ $lokers->firstItem() + $index }}</td>
                                <td><span class="badge badge-secondary">{{ $loker->kode_loker }}</span></td>
                                <td>{{ $loker->posisi }}</td>
                                <td>{{ $loker->perusahaan }}</td>
                                <td>{{ $loker->lokasi }}</td>
                                <td>
                                    @if ($loker->gaji_awal && $loker->gaji_akhir)
                                        Rp{{ number_format($loker->gaji_awal) }} - Rp{{ number_format($loker->gaji_akhir) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $loker->lamaran_count ?? 0 }}</span>
                                </td>
                                <td>
                                    @if ($loker->status == 'aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $loker->created_at ? $loker->created_at->format('d M Y') : '-' }}</small></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $loker->id_loker }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $loker->id_loker }}">
                                            <a class="dropdown-item text-info" href="#" onclick="showDetail({{ $loker->id_loker }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $loker->id_loker }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $loker->id_loker }}, '{{ $loker->posisi }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $lokers->firstItem() }} sampai {{ $lokers->lastItem() }}
                        dari {{ $lokers->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $lokers->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data loker yang ditemukan</p>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.loker.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
