<x-vlte3.app>
    <x-slot name="title">Manajemen FAQ</x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen FAQ</h1>
                    <p class="text-muted">Kelola data pertanyaan yang sering diajukan</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.faq.partials.filter')
            @include('vlte3.faq.partials.table')
        </div>
    </section>
    @include('vlte3.faq.partials.modal-create')
    @include('vlte3.faq.partials.modal-edit')
    @include('vlte3.faq.partials.modal-detail')
    @include('vlte3.faq.partials.modal-delete')
    @include('vlte3.faq.partials.scripts')
</x-vlte3.app>
