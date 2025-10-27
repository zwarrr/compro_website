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
            <div class="image">
                @php
                    $userName = Auth::user()->name ?? 'Administrator';
                    $words = explode(' ', $userName);
                    $initials = '';
                    foreach($words as $word) {
                        $initials .= strtoupper(substr($word, 0, 1));
                    }
                    if(strlen($initials) > 2) {
                        $initials = substr($initials, 0, 2);
                    }
                @endphp
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                     style="width: 32px; height: 32px; font-size: 14px; font-weight: bold;">
                    {{ $initials }}
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $userName }}</a>
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