<x-vlte3.app>
    <x-slot name="title">Konfigurasi Perusahaan</x-slot>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konfigurasi Perusahaan</h1>
                    <p class="text-muted">Kelola profil perusahaan Anda dengan mudah</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Konfigurasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col">
                    {{-- action buttons moved into header; keep for quick actions --}}
                </div>
                <div class="col-auto">
                    @if(isset($profile))
                        <button class="btn btn-sm btn-primary" onclick="openEditProfileModal()"><i class="fas fa-edit mr-1"></i> Edit Profil</button>
                    @else
                        <button class="btn btn-sm btn-primary" onclick="openCreateProfileModal()"><i class="fas fa-plus mr-1"></i> Buat Profil</button>
                    @endif
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div id="profileContent">
                @if(!isset($profile))
                    <div class="card card-outline card-secondary">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="mb-2">Profil Perusahaan Belum Dibuat</h5>
                            <p class="text-muted">Mulai dengan membuat profil perusahaan untuk menampilkan informasi lengkap di website Anda</p>
                            <div class="mt-3">
                                <button class="btn btn-primary" onclick="openCreateProfileModal()"><i class="fas fa-plus mr-1"></i> Buat Profil Sekarang</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row align-items-stretch">
                        <div class="col-lg-3 d-flex mb-3">
                            <div class="card w-100 h-100">
                                <div class="card-header bg-primary text-white d-flex align-items-center">
                                    <span class="bg-white text-primary rounded-circle mr-2 p-2" style="width:38px;height:38px;display:inline-flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    <h3 class="card-title mb-0">Informasi Umum</h3>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div>
                                        <p class="text-sm text-muted"><i class="fas fa-key mr-1 text-muted"></i> Kode Profil</p>
                                        <p class="font-weight-bold">{{ $profile->kode_profile }}</p>

                                        <p class="text-sm text-muted"><i class="fas fa-id-badge mr-1 text-muted"></i> Nama Perusahaan</p>
                                        <p class="font-weight-bold">{{ $profile->nama_perusahaan }}</p>

                                        <p class="text-sm text-muted"><i class="fas fa-quote-left mr-1 text-muted"></i> Slogan</p>
                                        <p class="font-weight-bold">{{ $profile->slogan ?: '-' }}</p>
                                    </div>
                                    <div class="mt-auto text-right">
                                        <button class="btn btn-sm btn-secondary" onclick="openDetailProfileModal()"><i class="fas fa-eye mr-1"></i> Detail</button>
                                        <button class="btn btn-sm btn-primary" onclick="openEditProfileModal()"><i class="fas fa-edit mr-1"></i> Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex mb-3">
                            <div class="card w-100 h-100">
                                <div class="card-header bg-primary text-white d-flex align-items-center">
                                    <span class="bg-white text-primary rounded-circle mr-2 p-2" style="width:38px;height:38px;display:inline-flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-file-alt"></i>
                                    </span>
                                    <h3 class="card-title mb-0">Konten Perusahaan</h3>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div>
                                        <p class="text-sm text-muted"><i class="fas fa-align-left mr-1 text-muted"></i> Deskripsi</p>
                                        <p class="text-muted">{{ $profile->deskripsi }}</p>

                                        <hr>
                                        <p class="text-sm text-muted"><i class="fas fa-bullseye mr-1 text-muted"></i> Visi</p>
                                        <p class="text-muted">{{ $profile->visi ?: '-' }}</p>

                                        <p class="text-sm text-muted"><i class="fas fa-bullhorn mr-1 text-muted"></i> Misi</p>
                                        <p class="text-muted">{{ $profile->misi ?: '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 d-flex mb-3">
                            <div class="card w-100 h-100">
                                <div class="card-header bg-primary text-white d-flex align-items-center">
                                    <span class="bg-white text-primary rounded-circle mr-2 p-2" style="width:38px;height:38px;display:inline-flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-address-book"></i>
                                    </span>
                                    <h3 class="card-title mb-0">Kontak & Alamat</h3>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div>
                                        <p class="text-sm text-muted"><i class="fas fa-map-marker-alt mr-1 text-muted"></i> Alamat</p>
                                        <p class="text-muted">{{ $profile->alamat ?: '-' }}</p>

                                        <p class="text-sm text-muted"><i class="fas fa-phone mr-1 text-muted"></i> Telepon</p>
                                        <p class="text-muted">{{ $profile->telepon ?: '-' }}</p>

                                        <p class="text-sm text-muted"><i class="fas fa-envelope mr-1 text-muted"></i> Email</p>
                                        <p class="text-muted">{{ $profile->email ?: '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @include('vlte3.konfigurasi.modals.create')
            @include('vlte3.konfigurasi.modals.detail')
            @include('vlte3.konfigurasi.modals.edit')

            @include('vlte3.konfigurasi.scripts')
        </div>
    </section>
</x-vlte3.app>
