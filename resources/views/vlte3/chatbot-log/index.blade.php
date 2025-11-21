<x-vlte3.app>
    <x-slot name="title">Log Chatbot</x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Log Chatbot</h1>
                    <p class="text-muted">Pertanyaan yang tidak ditemukan di knowledge base</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Log Chatbot</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            @include('vlte3.chatbot-log.partials.filter')
            @include('vlte3.chatbot-log.partials.table')
        </div>
    </section>
    @include('vlte3.chatbot-log.partials.modal-detail')
    @include('vlte3.chatbot-log.partials.modal-delete')
    @include('vlte3.chatbot-log.partials.modal-clear-all')
    @include('vlte3.chatbot-log.partials.scripts')
</x-vlte3.app>
