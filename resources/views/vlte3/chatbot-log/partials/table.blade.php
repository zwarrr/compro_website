<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list"></i> Daftar Log Pertanyaan</h3>
        <div class="card-tools">
            <span class="badge badge-info">{{ $logs->total() }} pertanyaan</span>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="width:40px;">No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th style="width:150px;">Device/Browser</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:140px;">Tanggal</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $index => $log)
                        <tr>
                            <td>{{ ($logs->currentPage() - 1) * $logs->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="text-truncate" style="max-width: 300px;">
                                    {{ $log->question }}
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 300px;">
                                    {{ $log->answer ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="fas fa-{{ $log->device === 'Mobile' ? 'mobile-alt' : ($log->device === 'Tablet' ? 'tablet-alt' : 'desktop') }}"></i>
                                    {{ $log->device ?? 'Unknown' }}<br>
                                    {{ $log->browser ?? 'Unknown' }}
                                </small>
                            </td>
                            <td>
                                @if ($log->knowledge_status === 'found')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Ada
                                    </span>
                                    @if ($log->matched_knowledge)
                                        <br><small class="text-muted">({{ $log->matched_knowledge }})</small>
                                    @endif
                                @elseif ($log->knowledge_status === 'not_found')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Tidak Ada
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $log->created_at->format('d M Y H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item text-info" href="#" onclick="showDetail({{ $log->id }}); return false;">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $log->id }}, '{{ addslashes(Str::limit($log->question, 30)) }}'); return false;">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                Tidak ada log pertanyaan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div class="mb-2 mb-md-0">
                    <p class="text-sm text-muted mb-0">
                        Menampilkan {{ $logs->firstItem() }} sampai {{ $logs->lastItem() }}
                        dari {{ $logs->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $logs->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
