<x-vlte3.app>
    <x-slot name="title">Manajemen Features</x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="mb-4">Manajemen Features</h1>
                    <p class="text-muted">Kelola data fitur perusahaan</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Features</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.features.partials.filter')
            @include('vlte3.features.partials.table')
        </div>
    </section>
    @include('vlte3.features.partials.modal-create')
    @include('vlte3.features.partials.modal-edit')
    @include('vlte3.features.partials.modal-detail')
    @include('vlte3.features.partials.modal-delete')
    @include('vlte3.features.partials.scripts')
</x-vlte3.app>