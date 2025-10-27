<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fas fa-list mr-1"></i> Daftar Page
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $pages->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($pages->count() > 0)
            <div class="table-responsive">
                <table id="pageTable1" class="table table-bordered table-hover">
                    <thead <tr>
                        <th style="width:5%">No</th>
                        <th style="width:7%">Kode</th>
                        <th style="width:10%">Digunakan Untuk</th>
                        <th style="width:18%">Judul</th>
                        {{-- <th style="width:15%">Sub Judul</th> --}}
                        <th style="width:10%">Status</th>
                        <th style="width:15%">Ilustrasi</th>
                        <th style="width:10%">Image</th>
                        <th style="width:10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $index => $page)
                            <tr>
                                <td class="text-center">{{ $pages->firstItem() + $index }}</td>
                                <td><span class="badge badge-secondary">{{ $page->kode_page }}</span></td>
                                <td>{{ $page->digunakan_untuk }}</td>
                                <td class="font-weight-bold">{{ $page->judul }}</td>
                                {{-- <td>{{ $page->sub_judul }}</td> --}}
                                <td>
                                    @if ($page->status == 'public')
                                        <span class="badge badge-success"><i class="fas fa-globe"></i> Publik</span>
                                    @else
                                        <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i>
                                            Draft</span>
                                    @endif
                                </td>
                                <td>{{ $page->ilustrasi ? $page->ilustrasi->judul : '-' }}</td>
                                <td class="text-center">
                                    @if ($page->ilustrasi && $page->ilustrasi->image)
                                        <img src="{{ asset('storage/' . $page->ilustrasi->image) }}" alt="img"
                                            class="img-thumbnail"
                                            style="max-width: 60px; max-height: 60px; object-fit:cover;">
                                    @else
                                        <span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            id="aksiDropdown{{ $page->id_page }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="aksiDropdown{{ $page->id_page }}">
                                            <a class="dropdown-item text-info" href="#"
                                                onclick="showDetail({{ $page->id_page }})"><i
                                                    class="fas fa-eye mr-2"></i> Detail</a>
                                            <a class="dropdown-item text-warning" href="#"
                                                onclick="openEditModal({{ $page->id_page }})"><i
                                                    class="fas fa-edit mr-2"></i> Edit</a>
                                            <a class="dropdown-item text-danger" href="#"
                                                onclick="confirmDelete({{ $page->id_page }}, '{{ $page->judul }}')"><i
                                                    class="fas fa-trash mr-2"></i> Hapus</a>
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
                        Menampilkan {{ $pages->firstItem() }} sampai {{ $pages->lastItem() }}
                        dari {{ $pages->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $pages->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada data page yang ditemukan</p>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.page.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
