<tr>
    <td>{{ $lamarans->firstItem() + $index }}</td>
    <td><span class="badge badge-secondary">{{ $item->kode_lamaran }}</span></td>
    <td>{{ $item->nama_lengkap }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->loker ? $item->loker->posisi : '-' }}</td>
    <td>
        @if ($item->status == 'Diajukan')
            <span class="badge badge-warning">Diajukan</span>
        @elseif ($item->status == 'Diterima')
            <span class="badge badge-success">Diterima</span>
        @elseif ($item->status == 'Ditolak')
            <span class="badge badge-danger">Ditolak</span>
        @else
            <span class="badge badge-secondary">{{ $item->status }}</span>
        @endif
    </td>
    <td><small class="text-muted">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</small></td>
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdown{{ $item->id_lamaran }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $item->id_lamaran }}">
                @if(in_array($item->status, ['Diterima','Ditolak']))
                    {{-- Only delete --}}
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="confirmDeleteLamaran({{ $item->id_lamaran }}, '{{ addslashes($item->nama_lengkap) }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                @elseif($item->status == 'Dikirim')
                    {{-- Delete and Batal --}}
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="confirmDeleteLamaran({{ $item->id_lamaran }}, '{{ addslashes($item->nama_lengkap) }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                    <a class="dropdown-item text-warning" href="#" onclick="cancelLamaran({{ $item->id_lamaran }})"><i class="fas fa-undo mr-2"></i> Batal</a>
                @elseif($item->status == 'Diajukan')
                    {{-- Detail and Tolak --}}
                    <a class="dropdown-item text-info" href="javascript:void(0)" onclick="showLamaranDetail({{ $item->id_lamaran }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="confirmTolakLamaran({{ $item->id_lamaran }}, '{{ addslashes($item->nama_lengkap) }}')"><i class="fas fa-ban mr-2"></i> Tolak</a>
                        <a class="dropdown-item text-primary" href="javascript:void(0)" onclick="openEditLamaranModal({{ $item->id_lamaran }}, '{{ addslashes($item->nama_lengkap) }}', '{{ $item->status }}', '{{ $item->email }}', '{{ $item->kode_lamaran }}', '{{ $item->nama_lengkap }}')"><i class="fas fa-edit mr-2"></i> Edit Status</a>
                @else
                    {{-- Fallback: show detail and delete --}}
                    <a class="dropdown-item text-info" href="javascript:void(0)" onclick="showLamaranDetail({{ $item->id_lamaran }})"><i class="fas fa-eye mr-2"></i> Detail</a>
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="confirmDeleteLamaran({{ $item->id_lamaran }}, '{{ addslashes($item->nama_lengkap) }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                        <a class="dropdown-item text-primary" href="javascript:void(0)" onclick="openEditLamaranModal({{ $item->id_lamaran }}, '{{ addslashes($item->nama_lengkap) }}', '{{ $item->status }}', '{{ $item->email }}', '{{ $item->kode_lamaran }}', '{{ $item->nama_lengkap }}')"><i class="fas fa-edit mr-2"></i> Edit Status</a>
                @endif
            </div>
        </div>
    </td>
</tr>