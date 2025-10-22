<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Pesan
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary" id="pesanTotal"></span>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="18%">Nama Pengirim</th>
                        <th width="18%">Email</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th width="12%">Status</th>
                        <th width="13%">Dibuat</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pesanTableBody">
                    @if (isset($pesan) && $pesan->count() > 0)
                        @foreach ($pesan as $index => $item)
                            <tr>
                                <td>{{ $pesan->firstItem() + $index }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->subjek ?? '-' }}</td>
                                <td>{{ Str::limit($item->pesan, 40) }}</td>
                                <td>
                                    @if ($item->status_baca == 'belum')
                                        <span class="badge badge-warning">Belum Dibaca</span>
                                    @else
                                        <span class="badge badge-success">Sudah Dibaca</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border dropdown-toggle" type="button"
                                            data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#"
                                                onclick="openDetailModal('{{ $item->id_kontak }}'); return false;"><i
                                                    class="fas fa-eye mr-1"></i> Detail</a>
                                            <a class="dropdown-item text-danger" href="#"
                                                onclick="openDeleteModal('{{ $item->id_kontak }}', '{{ $item->nama }}'); return false;"><i
                                                    class="fas fa-trash mr-1"></i> Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data pesan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div class="mb-2 mb-md-0">
                    <p class="text-sm text-muted mb-0">
                        Menampilkan {{ $pesan->firstItem() }} sampai {{ $pesan->lastItem() }}
                        dari {{ $pesan->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $pesan->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
