<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Operator | Aplikasi Absensi Sebelas</title>

    <meta name="description" content="" />

    <!-- icon -->
    <link rel="icon" type="image/x-icon" href={{ asset('assets/t2/img/6.png') }} />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href={{ asset('assets/t1/vendor/fonts/boxicons.css') }} />

    <!-- Core CSS -->
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/core.css') }} class="template-customizer-core-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/theme-default.css') }}
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/css/demo.css') }} />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/pages/page-auth.css') }} />

    <!-- Helpers -->
    <script src={{ asset('assets/t1/vendor/js/helpers.js') }}></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src={{ asset('assets/t1/js/config.js') }}></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src={{ asset('assets/t2/img/7.png') }} style="height: 70px; width: auto;">
                        </span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <div class="menu-item">
                        <div class="container row">
                            <a href="{{ route('operatorProfil') }}" class="btn btn-absen"> Kelola Akun </a>
                        </div>
                    </div>


                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Pengaturan Presensi</span>
                    </li>

                    <li class="menu-item">
                        <a href="/" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div data-i18n="Basic">Koordinat & Waktu</div>
                        </a>
                    </li>


                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Data Kelas </span>
                    </li>

                    <!-- Pages -->
                    <li class="menu-item" style="">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Dashboards">Data Pengguna</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item ">
                                <a href="{{ route('OPsiswa') }}" class="menu-link">
                                    <div data-i18n="Basic">Siswa</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="{{ route('OPwalikelas') }}" class="menu-link">
                                    <div data-i18n="Basic">Wali Kelas</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="{{ route('OPwalisiswa') }}" class="menu-link">
                                    <div data-i18n="Basic">Wali Siswa</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="{{ route('OPkesiswaan') }}" class="menu-link">
                                    <div data-i18n="Basic">Kesiswaan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('OPkelas') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-alt-2"></i>
                            <div data-i18n="Basic">Kelas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('OPjurusan') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                            <i class='book-bookmark'></i>
                            <div data-i18n="laporan">Jurusan</div>
                        </a>
                    </li>

                    <li class="menu-item">

                        <a class="menu-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="menu-icon tf-icons bx bx-power-off"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action=" {{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <h4 class="m-1"><a href="{{url()->previous()}}" class="btn btn-outline-danger"><i class="bx bx-chevron-left"></i></a> Profil</h4>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container container-p-y">


                        <form action={{ route('operatorProfilUpdate') }} method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value={{ $user->id_user }}>
                            @if (Session('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ Session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @elseif(Session('failed'))
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    {{ Session('failed') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row mb-2">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-item-start gap-4">
                                                <img src="{{ asset('/storage/user_avatar/' . $user->user->foto) }}"
                                                    alt="" class="d-block rounded" height="100"
                                                    width="100">
                                                <div class="button-wrapper">
                                                    <label for="upload" class="btn btn-absen me-2 mb-4"
                                                        tabindex="0">
                                                        <span class="d-none d-sm-block">Upload new photo</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                        <input type="file" id="upload"
                                                            class="account-file-input" hidden="" name="foto"
                                                            accept="image/png, image/jpeg, image/jpg">
                                                    </label>
                                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="mb-3 col-md-6">
                                                    <label for="Nama" class="form-label">Nama Panjang</label>
                                                    <input class="form-control" type="text" id="Nama"
                                                        value="{{ $user->user->name }}" disabled>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="nik" class="form-label">NIP</label>
                                                    <input class="form-control" type="text" id="nik"
                                                        value="{{ $user->nip }}" disabled>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="Email" class="form-label">Email</label>
                                                    <input class="form-control" type="Email" id="Email"
                                                        name="email" value="{{ $user->user->email }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="password" class="form-label">ganti password</label>
                                                    <input class="form-control" type="password" id="password"
                                                        name="password" placeholder="masukkan password baru">
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="kpassword" class="form-label">konfirmasi
                                                        password</label>
                                                    <input class="form-control" type="password" id="kpassword"
                                                        name="kPassword" placeholder="masukkan password baru">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-absen me-2">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div
                                class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by
                                    <a href="https://themeselection.com" target="_blank"
                                        class="footer-link fw-medium">ThemeSelection</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeselection.com/license/" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://themeselection.com/" target="_blank"
                                        class="footer-link me-4">More
                                        Themes</a>

                                    <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                        target="_blank" class="footer-link">Support</a>
                                </div>
                            </div>
                        </footer>


                    </div>

                </div>

            </div>



            <script src={{ asset('assets/t1/vendor/libs/jquery/jquery.js') }}></script>
            <script src={{ asset('assets/t1/vendor/libs/popper/popper.js') }}></script>
            <script src={{ asset('assets/t1/vendor/js/bootstrap.js') }}></script>
            <script src={{ asset('assets/t1/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}></script>
            <script src={{ asset('assets/t1/vendor/js/menu.js') }}></script>

            <!-- endbuild -->

            <!-- Vendors JS -->

            <!-- Main JS -->
            <script src={{ asset('assets/t1/js/main.js') }}></script>

            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <link rel="stylesheet" type="text/css"
                href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

            <!-- Page JS -->

            <!-- Place this tag in your head or just before your close body tag. -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>
