<x-vlte3.app>
    <x-slot name="title">Profile</x-slot>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                    <p class="text-muted">Kelola profile akun Anda</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <style>
                                /* Wave melengkung halus - MEMOTONG FOTO DI BAWAH */
                                .custom-wave {
                                    position: absolute;
                                    bottom: 0;
                                    left: 0;
                                    width: 100%;
                                    overflow: hidden;
                                    line-height: 0;
                                    z-index: 30;
                                }

                                .custom-wave svg {
                                    position: relative;
                                    display: block;
                                    width: calc(100% + 1.3px);
                                    height: 120px;
                                }

                                .custom-wave path {
                                    fill: #ffffff;
                                    stroke: none;
                                }
                            </style>
                            
                            <div class="text-center">
                                <div class="position-relative mx-auto mb-3" style="width: 120px; height: 120px; margin-top: 30px; filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.25));">
                                    @if($user->foto_profile)
                                        <!-- Background Circle (Black) - dengan background image -->
                                        <div class="position-absolute rounded-circle" 
                                             style="top: -7.2px; left: 0; width: 100%; height: 100%; z-index: 0; 
                                                    background-image: url('{{ asset('storage/' . $user->foto_profile) }}'); 
                                                    background-size: cover; 
                                                    background-position: center; 
                                                    background-color: #000000;">
                                        </div>
                                        
                                        <!-- Profile Image (Bulat) -->
                                        <div class="position-absolute rounded-circle overflow-hidden" 
                                             style="top: -64.8px; left: 0; width: 100%; height: 100%; z-index: 10;">
                                            <img src="{{ asset('storage/' . $user->foto_profile) }}" 
                                                 alt="Profile Photo" 
                                                 class="w-100 h-100"
                                                 style="object-fit: cover; object-position: top;">
                                        </div>
                                        
                                        <!-- Wave putih MEMOTONG foto di bawah -->
                                        <div class="custom-wave">
                                            <svg viewBox="-50 0 600 500" preserveAspectRatio="xMidYMid meet">
                                                <path d="M-50,195 C100,260 200,130 250,175 C300,220 400,130 550,195 L550,220 A250,250 0 0,1 -50,220 Z"></path>
                                            </svg>
                                        </div>
                                    @else
                                        <!-- Background Circle (Black) - dengan background image -->
                                        <div class="position-absolute rounded-circle" 
                                             style="top: -7.2px; left: 0; width: 100%; height: 100%; z-index: 0; 
                                                    background-image: url('{{ asset('img/team_cards/bg_cards.png') }}'); 
                                                    background-size: cover; 
                                                    background-position: center; 
                                                    background-color: #000000;">
                                        </div>
                                        
                                        <!-- Profile Image (Bulat) -->
                                        <div class="position-absolute rounded-circle overflow-hidden" 
                                             style="top: -64.8px; left: 0; width: 100%; height: 100%; z-index: 10;">
                                            <img src="{{ asset('img/team_cards/eja.png') }}" 
                                                 alt="No Photo" 
                                                 class="w-100 h-100"
                                                 style="object-fit: cover; object-position: top;">
                                        </div>
                                        
                                        <!-- Wave putih MEMOTONG foto di bawah -->
                                        <div class="custom-wave">
                                            <svg viewBox="-50 0 600 500" preserveAspectRatio="xMidYMid meet">
                                                <path d="M-50,195 C100,260 200,130 250,175 C300,220 400,130 550,195 L550,220 A250,250 0 0,1 -50,220 Z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h3 class="profile-username text-center mt-3">{{ $user->nama }}</h3>

                            <p class="text-muted text-center">{{ $user->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Bergabung Sejak</b>
                                    <a class="float-right">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Terakhir Update</b>
                                    <a class="float-right">{{ $user->updated_at ? $user->updated_at->format('d M Y H:i') : '-' }}</a>
                                </li>
                            </ul>

                            <button class="btn btn-primary btn-block" onclick="openEditModal()">
                                <i class="fas fa-edit"></i> <b>Edit Profile</b>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <!-- About Me Box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Profile</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-user mr-1"></i> Nama Lengkap</strong>
                            <p class="text-muted">{{ $user->nama }}</p>
                            <hr>

                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">{{ $user->email }}</p>
                            <hr>

                            <strong><i class="fas fa-calendar mr-1"></i> Terdaftar Sejak</strong>
                            <p class="text-muted">{{ $user->created_at ? $user->created_at->format('d F Y, H:i') : '-' }}</p>
                            <hr>

                            <strong><i class="fas fa-clock mr-1"></i> Terakhir Diupdate</strong>
                            <p class="text-muted">{{ $user->updated_at ? $user->updated_at->format('d F Y, H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('vlte3.profile.modals.edit')
    @include('vlte3.profile.scripts')
</x-vlte3.app>
