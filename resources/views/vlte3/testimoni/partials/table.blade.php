<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list mr-1"></i> Daftar Testimoni</h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $testimonis->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($testimonis->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Foto</th>
                            <th width="20%">Nama</th>
                            <th width="15%">Jabatan</th>
                            <th width="30%">Pesan</th>
                            <th width="8%">Rating</th>
                            <th width="10%">Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonis as $index => $testimoni)
                            <tr>
                                <td>{{ $testimonis->firstItem() + $index }}</td>
                                <td>
                                    @if ($testimoni->foto)
                                        <img src="{{ asset('storage/' . $testimoni->foto) }}" alt="img" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit:cover;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
                                    @endif
                                </td>
                                <td class="font-weight-bold">{{ $testimoni->nama_testimoni }}</td>
                                <td>{{ $testimoni->jabatan }}</td>
                                <td>{{ Str::limit($testimoni->pesan, 60) }}</td>
                                <td>
                                    @for($i=1;$i<=5;$i++)
                                        <i class="fas fa-star{{ $i <= $testimoni->rating ? '' : '-o' }} text-warning"></i>
                                    @endfor
                                </td>
                                <td>
                                    @if ($testimoni->status == 'publik')
                                        <span class="badge badge-success"><i class="fas fa-globe"></i> Publik</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $testimoni->id_testimoni }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $testimoni->id_testimoni }}">
                                            <a class="dropdown-item text-info" href="#" onclick="openDetailModal({{ $testimoni->id_testimoni }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $testimoni->id_testimoni }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="openDeleteModal({{ $testimoni->id_testimoni }}, '{{ $testimoni->nama_testimoni }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div class="mb-2 mb-md-0">
                    <p class="text-sm text-muted mb-0">
                        Menampilkan {{ $testimonis->firstItem() }} sampai {{ $testimonis->lastItem() }}
                        dari {{ $testimonis->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $testimonis->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data testimoni yang ditemukan</p>
                @if (request('search') || request('status') || request('rating'))
                    <a href="{{ route('admin.testimoni.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
