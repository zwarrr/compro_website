<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Pengetahuan
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $pengetahuans->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($pengetahuans->count() > 0)
            <div class="table-responsive">
                <table id="pengetahuanTable1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Kode</th>
                            <th width="20%">Kategori Pertanyaan</th>
                            <th width="20%">Sub Kategori</th>
                            <th width="28%">Jawaban</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengetahuans as $index => $pengetahuan)
                        <tr>
                            <td>{{ $pengetahuans->firstItem() + $index }}</td>
                            <td>
                                <span class="badge badge-secondary">{{ $pengetahuan->kode_pengetahuan }}</span>
                            </td>
                            <td class="font-weight-bold">{{ $pengetahuan->kategori_pertanyaan }}</td>
                            <td>{{ $pengetahuan->sub_kategori }}</td>
                            <td>
                                <small class="text-muted">{{ Str::limit($pengetahuan->jawaban, 50) }}</small>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $pengetahuan->id_pengetahuan }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $pengetahuan->id_pengetahuan }}">
                                        <a class="dropdown-item text-info" href="#" onclick="showDetail({{ $pengetahuan->id_pengetahuan }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                        <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $pengetahuan->id_pengetahuan }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                        <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $pengetahuan->id_pengetahuan }})"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $pengetahuans->firstItem() }} sampai {{ $pengetahuans->lastItem() }}
                        dari {{ $pengetahuans->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $pengetahuans->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data pengetahuan yang ditemukan</p>
                @if (request('search') || request('kategori_pertanyaan') || request('sub_kategori'))
                    <a href="{{ route('admin.pengetahuan.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
