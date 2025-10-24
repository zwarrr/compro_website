<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Kode</th>
            <th>Kategori Pertanyaan</th>
            <th>Sub Kategori</th>
            <th>Jawaban</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengetahuans as $index => $pengetahuan)
        <tr>
            <td>{{ $pengetahuans->firstItem() + $index }}</td>
            <td>{{ $pengetahuan->kode_pengetahuan }}</td>
            <td>{{ $pengetahuan->kategori_pertanyaan }}</td>
            <td>{{ $pengetahuan->sub_kategori }}</td>
            <td>{{ Str::limit($pengetahuan->jawaban, 50) }}</td>
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
<div class="mt-3">
    {{ $pengetahuans->links() }}
</div>
