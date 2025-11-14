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
                            <div class="text-center">
                                @if($user->foto_profile)
                                    <img src="{{ asset('storage/' . $user->foto_profile) }}" 
                                         alt="Profile Photo" 
                                         class="profile-user-img img-fluid img-circle"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    @php
                                        $userName = $user->nama ?? 'User';
                                        $words = explode(' ', $userName);
                                        $initials = '';
                                        foreach($words as $word) {
                                            $initials .= strtoupper(substr($word, 0, 1));
                                        }
                                        if(strlen($initials) > 2) {
                                            $initials = substr($initials, 0, 2);
                                        }
                                    @endphp
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                         style="width: 100px; height: 100px; font-size: 40px; font-weight: bold;
                                                background: linear-gradient(145deg, #4a9eff 0%, #007bff 50%, #0056b3 100%);
                                                box-shadow: 
                                                    0 -8px 16px rgba(74, 158, 255, 0.6),
                                                    0 8px 16px rgba(0, 0, 0, 0.3),
                                                    inset 0 -6px 12px rgba(0, 0, 0, 0.3),
                                                    inset 0 6px 12px rgba(255, 255, 255, 0.3);
                                                border: 2px solid rgba(255, 255, 255, 0.3);
                                                position: relative;
                                                transform: translateY(-3px);">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $user->nama }}</h3>

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
