
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-1"></i>
            Daftar Client
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $clients->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($clients->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="13%">Kategori</th>
                            <th width="20%">Nama Client</th>
                            <th width="13%">Website</th>
                            <th width="13%">Deskripsi</th>
                            <th width="10%">Logo</th>
                            <th width="10%">Status</th>
                            <th width="10%">Dibuat</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="clientTableBody">
                        @foreach ($clients as $index => $client)
                            <tr>
                                <td>{{ $clients->firstItem() + $index }}</td>
                                <td>{{ $client->kategori ? $client->kategori->nama_kategori : '-' }}</td>
                                <td class="font-weight-bold">{{ $client->nama_client }}</td>
                                <td>
                                    @if($client->website)
                                        <a href="{{ $client->website }}" target="_blank" rel="noopener" class="badge badge-primary px-2 py-1" style="font-size:0.95em;">
                                            <i class="fas fa-external-link-alt"></i> {{ $client->website }}
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $client->deskripsi ?? '-' }}</td>
                                <td>
                                    @if($client->logo)
                                        <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit:cover;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($client->status == 'publik')
                                        <span class="badge badge-success"><i class="fas fa-globe"></i> Publik</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> Draft</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $client->created_at ? $client->created_at->format('d M Y') : '-' }}</small></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $client->id_client }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $client->id_client }}">
                                            <a class="dropdown-item text-info" href="#" onclick="openDetailModal({{ $client->id_client }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $client->id_client }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#" onclick="openDeleteModal({{ $client->id_client }}, '{{ $client->nama_client }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $clients->firstItem() }} sampai {{ $clients->lastItem() }} dari {{ $clients->total() }} data
                    </p>
                </div>
                <div id="pagination">
                    {{ $clients->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="alert alert-info">Tidak ada data client.</div>
        @endif
    </div>
</div>
