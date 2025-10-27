<div class="card">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fas fa-list mr-1"></i>
			Daftar Ilustrasi
		</h3>
		<div class="card-tools">
			<span class="badge badge-primary">{{ $ilustrasis->total() }} total</span>
		</div>
	</div>
	<div class="card-body">
		@if ($ilustrasis->count() > 0)
			<div class="table-responsive">
				<table id="ilustrasiTable1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="10%">Gambar</th>
							<th width="13%">Kode</th>
							<th width="20%">Judul</th>
							<th width="10%">Status</th>
							<th width="12%">Dibuat</th>
							<th width="12%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ilustrasis as $index => $ilustrasi)
							<tr>
								<td>{{ $ilustrasis->firstItem() + $index }}</td>
								<td>
									@if ($ilustrasi->image)
										<img src="{{ asset('storage/' . $ilustrasi->image) }}" alt="img" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit:cover;">
									@else
										<span class="text-muted"><i class="fas fa-image fa-lg"></i></span>
									@endif
								</td>
								<td><span class="badge badge-secondary">{{ $ilustrasi->kode_ilustrasi }}</span></td>
								<td class="font-weight-bold">{{ $ilustrasi->judul }}</td>
								<td>
									@if ($ilustrasi->status == 'public')
										<span class="badge badge-success"><i class="fas fa-globe"></i> Public</span>
									@else
										<span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> Draft</span>
									@endif
								</td>
								<td><small class="text-muted">{{ $ilustrasi->created_at ? $ilustrasi->created_at->format('d M Y') : '-' }}</small></td>
								<td>
									<div class="dropdown">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $ilustrasi->id_ilustrasi }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-ellipsis-v"></i>
										</button>
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $ilustrasi->id_ilustrasi }}">
											<a class="dropdown-item text-info" href="#" onclick="showDetail({{ $ilustrasi->id_ilustrasi }})"><i class="fas fa-eye mr-2"></i> Detail</a>
											<a class="dropdown-item text-warning" href="#" onclick="openEditModal({{ $ilustrasi->id_ilustrasi }})"><i class="fas fa-edit mr-2"></i> Edit</a>
											<a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $ilustrasi->id_ilustrasi }}, '{{ $ilustrasi->judul }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
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
						Menampilkan {{ $ilustrasis->firstItem() }} sampai {{ $ilustrasis->lastItem() }}
						dari {{ $ilustrasis->total() }} entri
					</p>
				</div>
				<div>
					{{ $ilustrasis->appends(request()->query())->links('pagination::bootstrap-4') }}
				</div>
			</div>
		@else
			<div class="text-center py-5">
				<i class="fas fa-inbox fa-3x text-muted mb-3"></i>
				<p class="text-muted">Tidak ada data ilustrasi yang ditemukan</p>
				@if (request('search') || request('status'))
					<a href="{{ route('admin.ilustrasi.index') }}" class="btn btn-primary btn-sm">
						<i class="fas fa-sync"></i> Reset Filter
					</a>
				@endif
			</div>
		@endif
	</div>
</div>
