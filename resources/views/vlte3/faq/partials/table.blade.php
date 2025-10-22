<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th style="width:40px;">No</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th style="width:120px;">Aksi</th>
            </tr>
        </thead>
        <tbody id="faqTableBody">
            @foreach ($faqs as $index => $faq)
                <tr>
                    <td>{{ $faqs->firstItem() + $index }}</td>
                    <td>{{ $faq->pertanyaan }}</td>
                    <td>{{ Str::limit(strip_tags($faq->jawaban), 60) }}</td>
                    <td>
                        @if ($faq->status == 'publik')
                            <span class="badge badge-success"><i class="fas fa-globe"></i> Publik</span>
                        @else
                            <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> Draft</span>
                        @endif
                    </td>
                    <td><small
                            class="text-muted">{{ $faq->created_at ? $faq->created_at->format('d M Y') : '-' }}</small>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                id="aksiDropdown{{ $faq->id_faq }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="aksiDropdown{{ $faq->id_faq }}">
                                <a class="dropdown-item text-info" href="#"
                                    onclick="showDetail({{ $faq->id_faq }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                                <a class="dropdown-item text-warning" href="#"
                                    onclick="openEditModal({{ $faq->id_faq }})"><i class="fas fa-edit mr-2"></i>
                                    Edit</a>
                                <a class="dropdown-item text-danger" href="#"
                                    onclick="confirmDelete({{ $faq->id_faq }}, '{{ $faq->pertanyaan }}')"><i
                                        class="fas fa-trash mr-2"></i> Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            @if ($faqs->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2"></i><br>
                        Tidak ada data FAQ ditemukan
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
        <div class="mb-2 mb-md-0">
            <p class="text-sm text-muted mb-0">
                Menampilkan {{ $faqs->firstItem() }} sampai {{ $faqs->lastItem() }}
                dari {{ $faqs->total() }} entri
            </p>
        </div>
        <div>
            {{ $faqs->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
