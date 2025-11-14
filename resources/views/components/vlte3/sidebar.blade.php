<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{asset('images/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <style>
                /* Wave melengkung halus untuk sidebar */
                .sidebar-custom-wave {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    overflow: hidden;
                    line-height: 0;
                    z-index: 30;
                }

                .sidebar-custom-wave svg {
                    position: relative;
                    display: block;
                    width: calc(100% + 1.3px);
                    height: 48px;
                }

                .sidebar-custom-wave path {
                    fill: #ffffff;
                    stroke: none;
                }
            </style>
            <div class="image" style="padding-top: 23px;">
                @if(Auth::user()->foto_profile)
                    <div class="position-relative" style="width: 48px; height: 48px; filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.25));">
                        <!-- Background Circle (Black) - dengan background image -->
                        <div class="position-absolute rounded-circle" 
                             style="top: -1.2px; left: 0; width: 48px; height: 48px; z-index: 0; 
                                    background-image: url('{{ asset('storage/' . Auth::user()->foto_profile) }}'); 
                                    background-size: cover; 
                                    background-position: center; 
                                    background-color: #000000;">
                        </div>
                        
                        <!-- Profile Image (Bulat) -->
                        <div class="position-absolute rounded-circle overflow-hidden" 
                             style="top: -26px; left: 0; width: 48px; height: 48px; z-index: 10;">
                            <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" 
                                 alt="User Photo" 
                                 class="w-100 h-100"
                                 style="object-fit: cover; object-position: top;">
                        </div>
                        
                        <!-- Wave putih MEMOTONG foto di bawah -->
                        <div class="sidebar-custom-wave">
                            <svg viewBox="-50 0 600 500" preserveAspectRatio="xMidYMid meet">
                                <path d="M-50,195 C100,260 200,130 250,175 C300,220 400,130 550,195 L550,220 A250,250 0 0,1 -50,220 Z"></path>
                            </svg>
                        </div>
                    </div>
                @else
                    <div class="position-relative" style="width: 48px; height: 48px; filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.25));">
                        <!-- Background Circle (Black) - dengan background image -->
                        <div class="position-absolute rounded-circle" 
                             style="top: -1.2px; left: 0; width: 48px; height: 48px; z-index: 0; 
                                    background-image: url('{{ asset('img/team_cards/bg_cards.png') }}'); 
                                    background-size: cover; 
                                    background-position: center; 
                                    background-color: #000000;">
                        </div>
                        
                        <!-- Profile Image (Bulat) -->
                        <div class="position-absolute rounded-circle overflow-hidden" 
                             style="top: -26px; left: 0; width: 48px; height: 48px; z-index: 10;">
                            <img src="{{ asset('img/team_cards/eja.png') }}" 
                                 alt="No Photo"
                                 class="w-100 h-100"
                                 style="object-fit: cover; object-position: top;">
                        </div>
                        
                        <!-- Wave putih MEMOTONG foto di bawah -->
                        <div class="sidebar-custom-wave">
                            <svg viewBox="-50 0 600 500" preserveAspectRatio="xMidYMid meet">
                                <path d="M-50,195 C100,260 200,130 250,175 C300,220 400,130 550,195 L550,220 A250,250 0 0,1 -50,220 Z"></path>
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
            <div class="info d-flex align-items-center" style="padding-top: 23px;">
                <a href="#" class="d-block">{{ Auth::user()->nama ?? 'Administrator' }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $currentRoute = request()->route()->getName();
                @endphp

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- <!-- User Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>User Management</p>
                    </a>
                </li> --}}

                <!-- Ilustrasi -->
                <li class="nav-item">
                    <a href="{{ route('admin.ilustrasi.index') }}" class="nav-link {{ $currentRoute == 'admin.ilustrasi.index' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Ilustrasi</p>
                    </a>
                </li>

                <!-- Page -->
                <li class="nav-item">
                    <a href="{{ route('admin.page.index') }}" class="nav-link {{ $currentRoute == 'admin.page.index' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Page</p>
                    </a>
                </li>

                <!-- Features -->
                <li class="nav-item">
                    <a href="{{ route('admin.features.index') }}" class="nav-link {{ $currentRoute == 'admin.features.index' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>Features</p>
                    </a>
                </li>

                <!-- Company Profile -->
                <li class="nav-item">
                    <a href="{{ route('admin.konfigurasi.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.konfigurasi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Profil Perusahaan</p>
                    </a>
                </li>

                <!-- Content Management -->
                <li class="nav-header">CONTENT MANAGEMENT</li>

                <!-- Pengetahuan -->
                <li class="nav-item">
                    <a href="{{ route('admin.pengetahuan.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.pengetahuan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Pengetahuan</p>
                    </a>
                </li>
                
                <!-- Kategori -->
                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.kategori') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <!-- Layanan -->
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.layanan.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.layanan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Layanan</p>
                    </a>
                </li> --}}


                <!-- Galeri -->
                <li class="nav-item">
                    <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.galeri') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Galeri</p>
                    </a>
                </li>

                <!-- Loker / Lowongan Kerja -->
                <li class="nav-item">
                    <a href="{{ route('admin.loker.index')}}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.loker') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Loker</p>
                    </a>
                </li>

                <!-- Lamaran -->
                <li class="nav-item">
                    <a href="{{ route('admin.lamaran.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.lamaran') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Lamaran
                            @if(isset($pendingApplications) && $pendingApplications > 0)
                                <span class="badge badge-warning right">{{ $pendingApplications }}</span>
                            @endif
                        </p>
                    </a>
                </li>

                <!-- Team & Client -->
                <li class="nav-header">TEAM & CLIENT</li>
                
                <!-- Karyawan -->
                <li class="nav-item">
                    <a href="{{ route('admin.karyawan.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.karyawan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Karyawan</p>
                    </a>
                </li>

                <!-- Client -->
                <li class="nav-item">
                    <a href="{{ route('admin.layanan.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.layanan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>Client</p>
                    </a>
                </li>

                <!-- Testimoni -->
                <li class="nav-item">
                    <a href="{{ route('admin.testimoni.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.testimoni') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>Testimoni</p>
                    </a>
                </li>

                <!-- Communication -->
                <li class="nav-header">COMMUNICATION</li>
                
                <!-- Pesan -->
                <li class="nav-item">
                    <a href="{{ route('admin.pesan.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.pesan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Pesan
                            @if(isset($unreadMessages) && $unreadMessages > 0)
                            <span class="badge badge-info right">{{ $unreadMessages }}</span>
                            @endif
                        </p>
                    </a>
                </li>

                <!-- FAQ -->
                <li class="nav-item">
                    <a href="{{ route('admin.faq.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.faq') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>FAQ</p>
                    </a>
                </li>

                <!-- Social Media -->
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.sosial.index') }}" class="nav-link {{ Str::startsWith($currentRoute, 'admin.sosial') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-share-alt"></i>
                        <p>Social Media</p>
                    </a>
                </li> --}}

                <!-- Settings -->
                <li class="nav-header">SYSTEM</li>
                
                <!-- Logout -->
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="text-danger">Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>