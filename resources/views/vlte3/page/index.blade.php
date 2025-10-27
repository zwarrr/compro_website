<x-vlte3.app>
    <x-slot name="title">Manajemen Page</x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Page</h1>
                    <p class="text-muted">Kelola data halaman perusahaan</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.page.partials.filter')
            @include('vlte3.page.partials.table')
        </div>
    </section>
    @include('vlte3.page.partials.modal-create')
    @include('vlte3.page.partials.modal-edit')
    @include('vlte3.page.partials.modal-detail')
    @include('vlte3.page.partials.modal-delete')
    @include('vlte3.page.partials.scripts')
</x-vlte3.app>