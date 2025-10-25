<x-vlte3.app>
    <x-slot name="title">Dashboard Admin</x-slot>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) - 8 Cards -->
            <div class="row">
                <!-- Total Layanan -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-info h-100">
                        <div class="inner">
                            <h3>{{ $statistics['layanan'] ?? 0 }}</h3>
                            <p>Total Layanan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a href="{{ route('admin.layanan.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Client -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-success h-100">
                        <div class="inner">
                            <h3>{{ $statistics['client'] ?? 0 }}</h3>
                            <p>Total Client</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <a href="{{ route('admin.client.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Karyawan -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-warning h-100">
                        <div class="inner">
                            <h3>{{ $statistics['karyawan'] ?? 0 }}</h3>
                            <p>Total Karyawan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="{{ route('admin.karyawan.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Pesan -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-danger h-100">
                        <div class="inner">
                            <h3>{{ $statistics['kontak'] ?? 0 }}</h3>
                            <p>Total Pesan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <a href="{{ route('admin.pesan.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Kategori -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-primary h-100">
                        <div class="inner">
                            <h3>{{ $statistics['kategori'] ?? 0 }}</h3>
                            <p>Total Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <a href="{{ route('admin.kategori.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Galeri -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-secondary h-100">
                        <div class="inner">
                            <h3>{{ $statistics['galeri'] ?? 0 }}</h3>
                            <p>Total Galeri</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <a href="{{ route('admin.galeri.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Testimoni -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-indigo h-100">
                        <div class="inner">
                            <h3>{{ $statistics['testimoni'] ?? 0 }}</h3>
                            <p>Total Testimoni</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <a href="{{ route('admin.testimoni.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total User -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="small-box bg-purple h-100">
                        <div class="inner">
                            <h3>{{ $statistics['user'] ?? 0 }}</h3>
                            <p>Total Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row">
                <!-- Pie Chart - Data per Kategori -->
                {{-- <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Distribusi Data
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-info">Pie Chart</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Pie Chart Filter -->
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Pilih Data:</label>
                                <select class="form-control form-control-sm" id="pieChartType" onchange="updatePieChart()">
                                    <option value="kategori">Data per Kategori</option>
                                    <option value="layanan">Layanan Terpopuler</option>
                                    <option value="client">Client Terbanyak</option>
                                    <option value="testimoni">Rating Testimoni</option>
                                </select>
                            </div>

                            <!-- Pie Chart Canvas -->
                            <div class="position-relative" style="height: 320px;">
                                <canvas id="pieChart"></canvas>
                                <div id="pie-loading" class="d-none">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary mb-3" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <p class="text-muted">Memuat data...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Legend Info -->
                            <div id="pieChartLegend" class="mt-3">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Line Chart - Tren Data Berdasarkan Waktu -->
                <div class="col-lg-12 col-md-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-1"></i>
                                Tren Data Berdasarkan Waktu
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-success">Line Chart</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart Filters -->
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6 mb-2">
                                    <label class="form-label font-weight-bold">Pilih Jenis Data:</label>
                                    <div class="btn-group btn-group-sm d-flex flex-wrap" role="group">
                                        <button type="button" class="btn btn-primary filter-btn active flex-fill" id="btn-all" onclick="updateChartType('all')">
                                            <i class="fas fa-chart-bar"></i> <span class="d-none d-sm-inline">Semua</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary filter-btn flex-fill" id="btn-layanan" onclick="updateChartType('layanan')">
                                            <i class="fas fa-briefcase"></i> <span class="d-none d-sm-inline">Layanan</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-success filter-btn flex-fill" id="btn-client" onclick="updateChartType('client')">
                                            <i class="fas fa-handshake"></i> <span class="d-none d-sm-inline">Client</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-warning filter-btn flex-fill" id="btn-karyawan" onclick="updateChartType('karyawan')">
                                            <i class="fas fa-user-tie"></i> <span class="d-none d-sm-inline">Karyawan</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-2">
                                    <label class="form-label font-weight-bold">Periode:</label>
                                    <div class="btn-group btn-group-sm d-flex flex-wrap" role="group">
                                        <button type="button" class="btn btn-primary period-btn active flex-fill" id="btn-daily" onclick="updateChartPeriod('daily')">
                                            <i class="fas fa-calendar-day"></i> <span class="d-none d-sm-inline">Harian</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary period-btn flex-fill" id="btn-weekly" onclick="updateChartPeriod('weekly')">
                                            <i class="fas fa-calendar-week"></i> <span class="d-none d-sm-inline">Mingguan</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary period-btn flex-fill" id="btn-monthly" onclick="updateChartPeriod('monthly')">
                                            <i class="fas fa-calendar-alt"></i> <span class="d-none d-sm-inline">Bulanan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart Canvas -->
                            <div class="position-relative" style="height: 320px;">
                                <canvas id="distributionChart"></canvas>
                                <div id="chart-loading" class="d-none">
                                    <div class="text-center">
                                        {{-- <div class="spinner-border text-primary mb-3" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <p class="text-muted">Memuat data...</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Terbaru & Info Perusahaan -->
            <div class="row">
                <!-- Aktivitas Terbaru -->
                <div class="col-lg-8 col-md-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                Aktivitas Terbaru
                            </h3>
                        </div>
                        <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                            <!-- Latest Messages -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold text-muted mb-3">
                                    <i class="fas fa-envelope text-primary mr-2"></i>
                                    Pesan Terbaru
                                </h5>
                                @forelse($recentMessages ?? [] as $message)
                                    <div class="d-flex mb-3 p-3 border-left border-primary bg-light rounded">
                                        <div class="mr-3">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                                <i class="fas fa-envelope text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1" style="min-width: 0;">
                                            <h6 class="mb-1 font-weight-bold">{{ $message->nama ?? 'Anonim' }}</h6>
                                            <p class="mb-1 text-muted text-truncate">{{ Str::limit($message->pesan ?? 'Tidak ada pesan', 80) }}</p>
                                            <small class="text-muted">{{ $message->created_at->diffForHumans() ?? 'Baru saja' }}</small>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-3">
                                        <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">Belum ada pesan</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Latest Testimonials -->
                            <div>
                                <h5 class="font-weight-bold text-muted mb-3">
                                    <i class="fas fa-star text-warning mr-2"></i>
                                    Testimoni Terbaru
                                </h5>
                                @forelse($recentTestimonials ?? [] as $testimoni)
                                    <div class="d-flex mb-3 p-3 border-left border-warning bg-light rounded">
                                        <div class="mr-3">
                                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                                <i class="fas fa-star text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1" style="min-width: 0;">
                                            <h6 class="mb-1 font-weight-bold">{{ $testimoni->nama_testimoni ?? 'Anonim' }}</h6>
                                            <p class="mb-1 text-muted text-truncate">{{ Str::limit($testimoni->pesan ?? 'Tidak ada testimoni', 80) }}</p>
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                <small class="text-muted">{{ $testimoni->created_at->diffForHumans() ?? 'Baru saja' }}</small>
                                                <div class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star{{ $i <= ($testimoni->rating ?? 5) ? '' : '-o' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-3">
                                        <i class="fas fa-comment-alt fa-2x text-muted mb-2"></i>
                                        <p class="text-muted">Belum ada testimoni</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Perusahaan -->
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-building mr-1"></i>
                                Info Perusahaan
                            </h3>
                        </div>
                        <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                            @if($companyProfile ?? null)
                                <div class="text-center mb-4">
                                    @if($companyProfile->logo)
                                        <img src="{{ asset('storage/' . $companyProfile->logo) }}" alt="Logo" class="img-fluid rounded" style="max-height: 100px;">
                                    @else
                                        <div class="bg-primary rounded d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                            <i class="fas fa-building fa-2x text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="info-item mb-3">
                                    <i class="fas fa-building text-primary mr-2"></i>
                                    <strong>Nama:</strong> 
                                    <span class="d-block mt-1 text-muted">{{ $companyProfile->nama_perusahaan }}</span>
                                </div>
                                
                                <div class="info-item mb-3">
                                    <i class="fas fa-map-marker-alt text-danger mr-2"></i>
                                    <strong>Alamat:</strong>
                                    <span class="d-block mt-1 text-muted">{{ Str::limit($companyProfile->alamat, 100) }}</span>
                                </div>
                                
                                <div class="info-item mb-3">
                                    <i class="fas fa-phone text-success mr-2"></i>
                                    <strong>Telepon:</strong>
                                    <span class="d-block mt-1 text-muted">{{ $companyProfile->telepon }}</span>
                                </div>
                                
                                <div class="info-item mb-3">
                                    <i class="fas fa-envelope text-info mr-2"></i>
                                    <strong>Email:</strong>
                                    <span class="d-block mt-1 text-muted">{{ $companyProfile->email }}</span>
                                </div>
                                
                                @if($companyProfile->website)
                                <div class="info-item mb-3">
                                    <i class="fas fa-globe text-primary mr-2"></i>
                                    <strong>Website:</strong> 
                                    <a href="{{ $companyProfile->website }}" target="_blank" class="d-block mt-1 text-primary text-truncate">
                                        {{ $companyProfile->website }}
                                    </a>
                                </div>
                                @endif
                                
                                @if($companyProfile->deskripsi)
                                <div class="info-item mb-3">
                                    <i class="fas fa-info-circle text-warning mr-2"></i>
                                    <strong>Deskripsi:</strong> 
                                    <p class="text-muted mt-2">{{ Str::limit($companyProfile->deskripsi, 200) }}</p>
                                </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Info perusahaan belum diatur</p>
                                    <a href="#" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Info
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bolt mr-1"></i>
                                Quick Actions
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-app bg-primary w-100">
                                        <i class="fas fa-briefcase"></i> Kelola Layanan
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.client.index') }}" class="btn btn-app bg-success w-100">
                                        <i class="fas fa-handshake"></i> Kelola Client
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-app bg-warning w-100">
                                        <i class="fas fa-user-tie"></i> Kelola Karyawan
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-app bg-info w-100">
                                        <i class="fas fa-images"></i> Kelola Galeri
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.testimoni.index') }}" class="btn btn-app bg-secondary w-100">
                                        <i class="fas fa-star"></i> Kelola Testimoni
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-app bg-purple w-100">
                                        <i class="fas fa-tags"></i> Kelola Kategori
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-app bg-indigo w-100">
                                        <i class="fas fa-users"></i> Kelola User
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ route('admin.pesan.index') }}" class="btn btn-app bg-danger w-100">
                                        <i class="fas fa-envelope"></i> Lihat Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional CSS for better responsiveness -->
    <style>
        @media (max-width: 768px) {
            .small-box .inner h3 {
                font-size: 1.5rem;
            }
            .small-box .inner p {
                font-size: 0.9rem;
            }
            .btn-app {
                min-width: 100%;
                padding: 10px 5px;
            }
        }

        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }

        .hover-shadow:hover {
            box-shadow: 0 2px 5px rgba(0,0,0,.15);
            transition: all 0.3s ease;
        }

        #pieChartLegend .legend-item {
            display: flex;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #f0f0f0;
        }

        #pieChartLegend .legend-item:last-child {
            border-bottom: none;
        }

        #pieChartLegend .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

    <!-- Chart.js Script -->
    <script>
        // Chart variables
        let lineChart = null;
        let pieChart = null;
        let currentType = 'all';
        let currentPeriod = 'daily';
        let currentPieType = 'kategori';

        // Color schemes
        const colorSchemes = {
            layanan: { primary: '#3B82F6', gradient: 'rgba(59, 130, 246, 0.1)' },
            client: { primary: '#10B981', gradient: 'rgba(16, 185, 129, 0.1)' },
            karyawan: { primary: '#8B5CF6', gradient: 'rgba(139, 92, 246, 0.1)' },
            testimoni: { primary: '#F59E0B', gradient: 'rgba(245, 158, 11, 0.1)' },
            galeri: { primary: '#EC4899', gradient: 'rgba(236, 72, 153, 0.1)' }
        };

        const pieColors = [
            '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
            '#EC4899', '#14B8A6', '#F97316', '#6366F1', '#84CC16'
        ];

        // Initialize Line Chart
        function initLineChart(labels, dataInput, type) {
            const ctx = document.getElementById('distributionChart');

            if (lineChart) {
                lineChart.destroy();
            }

            let datasets = [];

            if (type === 'all' && Array.isArray(dataInput) && dataInput.length > 0 && dataInput[0].label) {
                datasets = dataInput.map(dataset => ({
                    label: dataset.label,
                    data: dataset.data,
                    borderColor: dataset.color,
                    backgroundColor: dataset.color + '20',
                    borderWidth: 3,
                    fill: false,
                    tension: 0.4,
                    pointBackgroundColor: dataset.color,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }));
            } else {
                const colors = colorSchemes[type] || { primary: '#3B82F6', gradient: 'rgba(59, 130, 246, 0.1)' };
                datasets = [{
                    label: 'Jumlah ' + type.charAt(0).toUpperCase() + type.slice(1),
                    data: dataInput,
                    borderColor: colors.primary,
                    backgroundColor: colors.gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: colors.primary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }];
            }

            lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            },
                            ticks: {
                                precision: 0
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        // Initialize Pie Chart
        function initPieChart(labels, data, backgroundColors) {
            const ctx = document.getElementById('pieChart');

            if (pieChart) {
                pieChart.destroy();
            }

            pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.parsed || 0;
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = ((value / total) * 100).toFixed(1);
                                    return label + ': ' + value + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            // Update custom legend
            updatePieChartLegend(labels, data, backgroundColors);
        }

        // Update Pie Chart Legend
        function updatePieChartLegend(labels, data, colors) {
            const legendContainer = document.getElementById('pieChartLegend');
            let total = data.reduce((a, b) => a + b, 0);
            
            let legendHTML = '';
            labels.forEach((label, index) => {
                let percentage = ((data[index] / total) * 100).toFixed(1);
                legendHTML += `
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: ${colors[index]}"></div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold">${label}</span>
                                <span class="badge badge-primary">${data[index]}</span>
                            </div>
                            <small class="text-muted">${percentage}% dari total</small>
                        </div>
                    </div>
                `;
            });
            
            legendContainer.innerHTML = legendHTML;
        }

        // Load Line Chart Data
        async function loadLineChartData() {
            const loading = document.getElementById('chart-loading');
            loading.classList.remove('d-none');
            loading.classList.add('d-flex');

            try {
                const response = await fetch(`{{ route('admin.dashboard.chart-data') }}?type=${currentType}&period=${currentPeriod}`);
                const result = await response.json();
                
                if (result.datasets) {
                    initLineChart(result.labels, result.datasets, currentType);
                } else {
                    initLineChart(result.labels, result.data, currentType);
                }
            } catch (error) {
                console.error('Error loading chart data:', error);
                // Dummy data for demo
                const dummyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
                const dummyData = [10, 15, 12, 18, 22, 25];
                initLineChart(dummyLabels, dummyData, currentType);
            } finally {
                loading.classList.add('d-none');
                loading.classList.remove('d-flex');
            }
        }

        // Prepare data from server
        const serverData = {
            kategori: {
                labels: {!! json_encode($kategoriData->pluck('nama')->map(function($n){ return $n ?: 'Tidak Ada Data'; })->toArray()) !!},
                data: {!! json_encode($kategoriData->pluck('layanan_count')->map(function($c){ return $c ?: 1; })->toArray()) !!}
            },
            layanan: {
                labels: ['Web Development', 'Mobile App', 'Design', 'Consulting', 'SEO'],
                data: [{{ $statistics['layanan'] ?? 25 }}, 20, 15, 10, 8]
            },
            client: {
                labels: ['Active', 'Pending', 'Completed'],
                data: [{{ $statistics['client'] ?? 30 }}, 15, 10]
            },
            testimoni: {
                labels: ['⭐⭐⭐⭐⭐', '⭐⭐⭐⭐', '⭐⭐⭐', '⭐⭐', '⭐'],
                data: [{{ $statistics['testimoni'] ?? 20 }}, 15, 8, 3, 1]
            }
        };

        // Load Pie Chart Data
        function loadPieChartData() {
            const data = serverData[currentPieType];
            const colors = data.labels.map((_, index) => pieColors[index % pieColors.length]);
            initPieChart(data.labels, data.data, colors);
        }

        // Update Line Chart Type
        function updateChartType(type) {
            currentType = type;
            
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('btn-primary', 'active');
                btn.classList.add('btn-outline-primary');
            });
            
            const activeBtn = document.getElementById(`btn-${type}`);
            activeBtn.classList.remove('btn-outline-primary');
            activeBtn.classList.add('btn-primary', 'active');
            
            loadLineChartData();
        }

        // Update Line Chart Period
        function updateChartPeriod(period) {
            currentPeriod = period;
            
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.classList.remove('btn-primary', 'active');
                btn.classList.add('btn-outline-primary');
            });
            
            const activeBtn = document.getElementById(`btn-${period}`);
            activeBtn.classList.remove('btn-outline-primary');
            activeBtn.classList.add('btn-primary', 'active');
            
            loadLineChartData();
        }

        // Update Pie Chart
        function updatePieChart() {
            const selectElement = document.getElementById('pieChartType');
            currentPieType = selectElement.value;
            loadPieChartData();
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadLineChartData();
            loadPieChartData();
        });
    </script>

</x-vlte3.app>