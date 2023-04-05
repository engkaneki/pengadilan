<div class="navbar-header">
    <div class="d-flex">
        <div class="navbar-brand-box">
            <a href="{{ url('/') }}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('/') }}img/logo.png" alt="" height="26">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('/') }}img/logo.png" alt="" height="26"> <span
                        class="logo-txt">Dukcapil
                        Hadir di Pengadilan</span>
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse"
            id="horimenu-btn" data-bs-target="#topnav-menu-content">
            <i class="fa fa-fw fa-bars"></i>
        </button>

        {{-- Menu Admin --}}
        @if ($user->level == 1)
            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{ url('/') }}"
                                    id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bx bx-home-circle icon"></i>
                                    <span data-key="t-dashboard">Beranda</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow-none" id="topnav-uielement"
                                    role="button">
                                    <i class="bx bx-book icon"></i>
                                    <span data-key="t-pages">Pelayanan</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{ url('layanan') }}" class="dropdown-item" data-key="t-pages">Pengajuan
                                        Berkas</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas
                                        Selesai</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas
                                        Ditolak</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow-none" id="topnav-uielement"
                                    role="button">
                                    <i class="bx bxs-user-detail icon"></i>
                                    <span data-key="t-pages">Daftar Pengguna</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow-none" id="topnav-uielement"
                                    role="button">
                                    <i class="bx bxs-report icon"></i>
                                    <span data-key="t-pages">Laporan Berkas</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{ url('pengajuan/berkas') }}" class="dropdown-item"
                                        data-key="t-pages">Berkas Belum Diterima</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas Sudah Diterima</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        @endif

        {{-- Menu Pelayanan --}}
        @if ($user->level == 2)
            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{ url('/') }}"
                                    id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bx bx-home-circle icon"></i>
                                    <span data-key="t-dashboard">Beranda</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow-none" id="topnav-uielement"
                                    role="button">
                                    <i class="bx bx-book icon"></i>
                                    <span data-key="t-pages">Pelayanan</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{ url('pengajuan') }}" class="dropdown-item"
                                        data-key="t-pages">Pengajuan Berkas</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas
                                        Selesai</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas
                                        Ditolak</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow-none" id="topnav-uielement"
                                    role="button">
                                    <i class="bx bxs-report icon"></i>
                                    <span data-key="t-pages">Laporan Berkas</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{ url('pengajuan/berkas') }}" class="dropdown-item"
                                        data-key="t-pages">Berkas Belum Diterima</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas Sudah
                                        Diterima</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        @endif

        {{-- Menu Petugas --}}
        @if ($user->level == 3)
            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{ url('/') }}"
                                    id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bx bx-home-circle icon"></i>
                                    <span data-key="t-dashboard">Beranda</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow-none" id="topnav-uielement"
                                    role="button">
                                    <i class="bx bx-book icon"></i>
                                    <span data-key="t-pages">Pelayanan</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{ url('pengajuan/berkas') }}" class="dropdown-item"
                                        data-key="t-pages">Pengajuan Berkas</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas
                                        Selesai</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas
                                        Ditolak</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle arrow-none" id="topnav-uielement"
                                    role="button">
                                    <i class="bx bxs-report icon"></i>
                                    <span data-key="t-pages">Laporan Berkas</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{ url('pengajuan/berkas') }}" class="dropdown-item"
                                        data-key="t-pages">Berkas Belum Diterima</a>
                                    <a href="#" class="dropdown-item" data-key="t-pages">Berkas Sudah
                                        Diterima</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        @endif


    </div>


    <div class="d-flex">
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item user text-start d-flex align-items-center"
                id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user"
                    src="{{ asset('/') }}assets/images/users/admin_killua.jpg" alt="Header Avatar">
                <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                    <span class="user-name">{{ $user->name }} <i class="mdi mdi-chevron-down"></i></span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <h6 class="dropdown-header">Selamat Datang, {{ $user->name }}</h6>
                <a class="dropdown-item" href="pages-profile.html"><i
                        class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                        class="align-middle">Profile</span></a>
                <a class="dropdown-item d-flex align-items-center" href="contacts-settings.html"><i
                        class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                        class="align-middle">Settings</span></a>
                <a class="dropdown-item" href="{{ url('logout') }}"><i
                        class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                        class="align-middle">Logout</span></a>
            </div>
        </div>
    </div>
</div>
