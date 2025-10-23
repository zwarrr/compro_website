<x-vlte3.app>
    <x-slot name="title">Manajemen Karyawan</x-slot>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Karyawan</h1>
                    <p class="text-muted">Kelola data karyawan perusahaan</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.karyawan.partials.filter')
            @include('vlte3.karyawan.partials.table')
        </div>
    </section>

    @include('vlte3.karyawan.partials.modal-create')
    @include('vlte3.karyawan.partials.modal-edit')
    @include('vlte3.karyawan.partials.modal-detail')
    @include('vlte3.karyawan.partials.modal-delete')
    @include('vlte3.karyawan.partials.posisi-modal')
    @include('vlte3.karyawan.partials.scripts')
</x-vlte3.app>
