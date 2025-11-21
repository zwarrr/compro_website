<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-filter"></i> Filter Data</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-danger btn-sm" onclick="confirmClearAll()" title="Hapus Semua Log">
                <i class="fas fa-trash-alt"></i> Hapus Semua
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.chatbot-log.index') }}" method="GET" class="form-inline">
            <div class="form-group mr-3 mb-2">
                <label for="knowledge_status" class="mr-2">Status:</label>
                <select name="knowledge_status" id="knowledge_status" class="form-control">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('knowledge_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="found" {{ request('knowledge_status') === 'found' ? 'selected' : '' }}>Ada</option>
                    <option value="not_found" {{ request('knowledge_status') === 'not_found' ? 'selected' : '' }}>Tidak Ada</option>
                </select>
            </div>
            <div class="form-group mr-3 mb-2">
                <label for="search" class="mr-2">Cari:</label>
                <input type="text" name="search" id="search" class="form-control"
                    placeholder="Cari pertanyaan..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary mb-2 mr-2">
                <i class="fas fa-search"></i> Filter
            </button>
            <a href="{{ route('admin.chatbot-log.index') }}" class="btn btn-secondary mb-2">
                <i class="fas fa-redo"></i> Reset
            </a>
        </form>
    </div>
</div>
