<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
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
    @yield('title')

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

                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Dashboard</span>
                        </li>

                        <li class="menu-item ">
                            <a href="operator" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                <div data-i18n="Basic">Dashboard</div>
                            </a>
                        </li>

                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Presensi</span>
                        </li>

                        <li class="menu-item">
                            <a href="kelolakoordinat" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-map"></i>
                                <div data-i18n="Basic">Titik Koordinat</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="kelolawaktuabsen" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-time"></i>
                                <div data-i18n="Basic">Waktu Absen</div>
                            </a>
                        </li>


                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Data Kelas </span>
                        </li>

                        <!-- Pages -->
                        <li class="menu-item" style="">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div data-i18n="Dashboards">Wali Kelas & Kesiswaan</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item ">
                                    <a href="kelolawalikelas" class="menu-link">
                                        <div data-i18n="Basic">Wali Kelas</div>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="kelolakesiswaan" class="menu-link">
                                        <div data-i18n="Basic">Kesiswaan</div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item active">
                            <a href="kelolakelas" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-home-alt-2"></i>
                                <div data-i18n="Basic">Kelas</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="kelolajurusan" class="menu-link">
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
                            <h4 class="m-1">Kelola Kelas</h4>
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
                            <div class="card">
                                <div class="card-header d-flex">
                                    <input class="form-control" list="datalistOptions" id="search"
                                        placeholder="Type to search...">
                                    <div class="col-5"></div>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-toggle="modal" data-bs-target="#tambah"><i
                                                class="bx bxs-file-plus"></i> Tambah</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#impor"><i
                                                class="bx bx-import"></i> Impor</button>
                                    </div>

                                </div>

                                {{-- Tambah --}}

                                <div class="modal fade" id="tambah" tabindex="-1" style="display: none;"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Kelas</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/tambahkelas" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="tingkat" class="form-label">tingkat
                                                                Kelas</label>
                                                            <select name="tingkat" id="tingkat"
                                                                class="form-select">
                                                                @foreach ($kelas as $w)
                                                                    <option value={{ $w->tingkat }}>
                                                                        {{ $w->tingkat }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="jurusan" class="form-label">jurusan</label>
                                                            <select name="id_jurusan" id="jurusan"
                                                                class="form-select">
                                                                @foreach ($jurusan as $w)
                                                                    <option value={{ $w->id_jurusan }}>
                                                                        {{ $w->id_jurusan }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nomor" class="form-label">Nomor
                                                                Kelas</label>
                                                            <input name="nomor_kelas" id="nomor"
                                                                class="form-control"
                                                                placeholder="Masukkan Nomor Kelas">
                                                            </input>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="wali" class="form-label">Wali
                                                                Kelas</label>
                                                            <select name="nuptk" id="wali"
                                                                class="form-select">
                                                                <option value="">Tanpa Wali Kelas</option>
                                                                @foreach ($kosong as $o)
                                                                    <option value={{ $o->nuptk }}>
                                                                        {{ $o->user->name }}</option>>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Impor --}}
                                <div class="modal fade" id="impor" tabindex="-1" style="display: none;"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Impor Data Kelas
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <p>Gunakan <a href={{ route('exportkelas') }}><i><u>Format
                                                                    Ini</u></i></a> Untuk Impor Data!</p>
                                                </div>

                                                <form action= "/kelolakelas/import" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <input name="file" type="file" class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Batalkan
                                                </button>
                                                <button type="submit" class="btn btn-primary">Impor</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive text-nowrap">
                                    <table class="table" id="tabel">
                                        <thead>
                                            <tr>
                                                <th>Rombel</th>
                                                <th>Wali Kelas</th>
                                                <th class="text-center">Siswa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">

                                            @foreach ($kelas as $w)
                                                <tr>
                                                    <td>
                                                        <span class="fw-medium"> @php
                                                            echo $w->tingkat;
                                                            echo ' ';
                                                            echo strtoupper($w->id_jurusan);
                                                            echo ' ';
                                                            echo $w->nomor_kelas;
                                                        @endphp</span>
                                                    </td>
                                                    @if ($w->wali)
                                                        <td>@php echo($w->user->name); @endphp</td>
                                                    @else
                                                        <td>Tanpa Wali Kelas</td>
                                                    @endif
                                                    <td class="text-center">
                                                        <a href={{ route('kelassiswa', ['id' => $w->id_kelas]) }}
                                                            class="btn btn-outline-primary">
                                                            <span class="tf-icons bx bx-show p-o"></span> Lihat
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#edit{{ $w->id_kelas }}"><i
                                                                        class="bx bx-edit-alt me-2"></i> Edit</button>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#hapus{{ $w->id_kelas }}"><i
                                                                        class="bx bx-trash me-2"></i> Hapus</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @include('operator.kelas.editHapuskelas')
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- / Content -->

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
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More
                                    Themes</a>

                                <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank" class="footer-link me-4">Documentation</a>

                                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank" class="footer-link">Support</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->


        <script src={{ asset('assets/t1/vendor/libs/jquery/jquery.js') }}></script>
        <script src={{ asset('assets/t1/vendor/libs/popper/popper.js') }}></script>
        <script src={{ asset('assets/t1/vendor/js/bootstrap.js') }}></script>
        <script src={{ asset('assets/t1/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}></script>
        <script src={{ asset('assets/t1/vendor/js/menu.js') }}></script>

        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src={{ asset('assets/t1/js/main.js') }}></script>
        <script src={{ asset('assets/tabel.js') }}></script>

        <!-- Page JS -->

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>

</html>
