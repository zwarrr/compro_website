<x-vlte3.app>
    <x-slot name="title">Manajemen Kategori</x-slot>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Kategori</h1>
                    <p class="text-muted">Kelola kategori layanan, galeri, karyawan, divisi, dan client</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.kategori.partials.filter')

            @include('vlte3.kategori.partials.table')
        </div>
    </section>

    @include('vlte3.kategori.partials.modal-create')

    @include('vlte3.kategori.partials.modal-edit')

    @include('vlte3.kategori.partials.modal-detail')

    @include('vlte3.kategori.partials.modal-delete')

    @include('vlte3.kategori.partials.scripts')


</x-vlte3.app>
