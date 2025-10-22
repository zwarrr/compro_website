<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-inbox mr-1"></i>
            Daftar Lamaran
        </h3>
        <div class="card-tools">
            <span class="badge badge-primary">{{ $lamarans->total() }} total</span>
        </div>
    </div>
    <div class="card-body">
        @if ($lamarans->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:40px;">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Loker</th>
                            <th>Status</th>
                            <th>Diterima</th>
                            <th style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="lamaranTableBody">
                        @foreach ($lamarans as $index => $item)
                            @include('vlte3.lamaran.partials.table-rows', ['index' => $index, 'item' => $item])
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div class="mb-2 mb-md-0">
                    <p class="text-sm text-muted mb-0">
                        Menampilkan {{ $lamarans->firstItem() }} sampai {{ $lamarans->lastItem() }}
                        dari {{ $lamarans->total() }} entri
                    </p>
                </div>
                <div>
                    {{ $lamarans->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada lamaran yang ditemukan</p>
                @if (request('search') || request('status') || request('loker_id'))
                    <a href="{{ route('admin.lamaran.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>