<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link" target="_blank">View Site</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> --}}

        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center mr-3" 
                             style="width: 50px; height: 50px; font-size: 18px; font-weight: bold;">
                            BD
                        </div>
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mr-3" 
                             style="width: 50px; height: 50px; font-size: 18px; font-weight: bold;">
                            JP
                        </div>
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mr-3" 
                             style="width: 50px; height: 50px; font-size: 18px; font-weight: bold;">
                            NS
                        </div>
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.pesan.index') }}" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li> --}}
        
        <!-- Notifications Dropdown Menu Dinamis -->
        <li class="nav-item dropdown" id="notif-dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="notif-count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notif-menu">
                <span class="dropdown-item dropdown-header" id="notif-header">Loading...</span>
                <div id="notif-list"></div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            function loadNotifications() {
                fetch("{{ route('admin.notifikasi.all') }}")
                    .then(res => res.json())
                    .then(data => {
                        let notifList = document.getElementById('notif-list');
                        let notifCount = document.getElementById('notif-count');
                        let notifHeader = document.getElementById('notif-header');
                        notifList.innerHTML = '';
                        notifCount.textContent = data.length;
                        notifHeader.textContent = data.length + ' Notifications';
                        if(data.length === 0) {
                            notifList.innerHTML = '<span class="dropdown-item">Tidak ada notifikasi baru.</span>';
                        } else {
                            data.forEach(function(item) {
                                // Hindari null pada title/desc
                                let title = item.title ?? 'Notifikasi';
                                let desc = (item.desc === null || item.desc === undefined || item.desc === 'null') ? '-' : item.desc;
                                let time = item.time ?? '';
                                notifList.innerHTML += `
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-bell mr-2"></i> ${title}: ${desc}
                                        <span class="float-right text-muted text-sm">${time}</span>
                                    </a>
                                `;
                            });
                        }
                    });
            }
            // Polling setiap 5 detik
            setInterval(loadNotifications, 5000);
            // Load pertama kali
            loadNotifications();
            // Load saat dropdown dibuka (agar responsif)
            document.getElementById('notif-dropdown').addEventListener('show.bs.dropdown', loadNotifications);
        });
        </script>
        
        <!-- User Account Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                @if(Auth::user()->foto_profile)
                    <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" 
                         alt="User" 
                         class="img-circle elevation-2"
                         style="width: 32px; height: 32px; object-fit: cover;
                                box-shadow: 
                                    0 -4px 8px rgba(74, 158, 255, 0.4),
                                    0 4px 8px rgba(0, 0, 0, 0.3);
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                position: relative;
                                transform: translateY(-1px);">
                @else
                    @php
                        $userName = Auth::user()->nama ?? 'Administrator';
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
                         style="width: 32px; height: 32px; font-size: 14px; font-weight: bold;
                                background: linear-gradient(145deg, #4a9eff 0%, #007bff 50%, #0056b3 100%);
                                box-shadow: 
                                    0 -4px 8px rgba(74, 158, 255, 0.4),
                                    0 4px 8px rgba(0, 0, 0, 0.3),
                                    inset 0 -3px 6px rgba(0, 0, 0, 0.3),
                                    inset 0 3px 6px rgba(255, 255, 255, 0.3);
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                position: relative;
                                transform: translateY(-1px);">
                        {{ $initials }}
                    </div>
                @endif
                <span class="d-none d-md-inline ml-2">{{ Auth::user()->nama ?? 'Administrator' }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-header text-center">
                    @if(Auth::user()->foto_profile)
                        <img src="{{ asset('storage/' . Auth::user()->foto_profile) }}" 
                             alt="User" 
                             class="img-circle elevation-2 mb-2"
                             style="width: 60px; height: 60px; object-fit: cover;
                                    box-shadow: 
                                        0 -6px 12px rgba(74, 158, 255, 0.5),
                                        0 6px 12px rgba(0, 0, 0, 0.3);
                                    border: 2px solid rgba(255, 255, 255, 0.3);
                                    position: relative;
                                    transform: translateY(-2px);">
                    @else
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" 
                             style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;
                                    background: linear-gradient(145deg, #4a9eff 0%, #007bff 50%, #0056b3 100%);
                                    box-shadow: 
                                        0 -6px 12px rgba(74, 158, 255, 0.5),
                                        0 6px 12px rgba(0, 0, 0, 0.3),
                                        inset 0 -5px 10px rgba(0, 0, 0, 0.3),
                                        inset 0 5px 10px rgba(255, 255, 255, 0.3);
                                    border: 2px solid rgba(255, 255, 255, 0.3);
                                    position: relative;
                                    transform: translateY(-2px);">
                            {{ $initials }}
                        </div>
                    @endif
                    <strong>{{ Auth::user()->nama ?? 'Administrator' }}</strong><br>
                    <small class="text-muted">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                </div>
                <div class="dropdown-divider"></div>
                <a href="/admin/profile" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                {{-- <a href="#" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a> --}}
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
                    <i class="fas fa-sign-out-alt mr-2 text-danger"></i> 
                    <span class="text-danger">Logout</span>
                </a>
                <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>