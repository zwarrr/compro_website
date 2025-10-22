<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Karyawan
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $karyawans->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($karyawans->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Foto</th>
                            <th width="13%">Kode</th>
                            <th width="20%">Nama</th>
                            <th width="13%">NIK</th>
                            <th width="13%">Kategori</th>
                            <th width="10%">Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $index => $karyawan)
                            <tr>
                                <td>{{ $karyawans->firstItem() + $index }}</td>
                                <td>
                                    @if ($karyawan->foto)
                                        <img src="{{ asset('storage/karyawan/' . $karyawan->foto) }}" alt="img" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit:cover;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
                                    @endif
                                </td>
                                <td><span class="badge badge-secondary">{{ $karyawan->kode_karyawan }}</span></td>
                                <td class="font-weight-bold">{{ $karyawan->nama }}</td>
                                <td>{{ $karyawan->nik }}</td>
                                <td>{{ $karyawan->kategori->nama_kategori ?? '-' }}</td>
                                <td>
                                    @if ($karyawan->status == 'aktif')
                                        <span class="badge badge-success"><i class="fas fa-check"></i> Aktif</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $karyawan->id_karyawan }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $karyawan->id_karyawan }}">
                                            <a class="dropdown-item text-info" href="#" onclick="openDetailModal({{ $karyawan->id_karyawan }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $karyawan->id_karyawan }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="openDeleteModal({{ $karyawan->id_karyawan }}, '{{ $karyawan->nama }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $karyawans->firstItem() }} sampai {{ $karyawans->lastItem() }}
                        dari {{ $karyawans->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $karyawans->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data karyawan yang ditemukan</p>
                @if (request('search') || request('kategori_id') || request('status'))
                    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
