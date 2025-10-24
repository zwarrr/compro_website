<x-vlte3.app>
    <x-slot name="title">Manajemen Lamaran</x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Lamaran</h1>
                    <p class="text-muted">Kelola data lamaran masuk</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lamaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.lamaran.partials.filter')
            @include('vlte3.lamaran.partials.table')
        </div>
    </section>

    @include('vlte3.lamaran.partials.modal-detail')
    @include('vlte3.lamaran.partials.modal-delete')
    @include('vlte3.lamaran.partials.modal-balas')
    @include('vlte3.lamaran.partials.modal-edit')
    @include('vlte3.lamaran.partials.scripts')
</x-vlte3.app>