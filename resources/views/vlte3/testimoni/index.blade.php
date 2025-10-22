<x-vlte3.app>
    <x-slot name="title">Manajemen Testimoni</x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Testimoni</h1>
                    <p class="text-muted">Kelola data testimoni perusahaan</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Testimoni</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.testimoni.partials.filter')
            @include('vlte3.testimoni.partials.table')
        </div>
    </section>
    @include('vlte3.testimoni.partials.modal-create')
    @include('vlte3.testimoni.partials.modal-edit')
    @include('vlte3.testimoni.partials.modal-detail')
    @include('vlte3.testimoni.partials.modal-delete')
    @include('vlte3.testimoni.partials.scripts')
</x-vlte3.app>
