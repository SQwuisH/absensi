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

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Pengaturan Presensi</span>
                    </li>

                    <li class="menu-item active">
                        <a href="#" class="menu-link">
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
                                <a href="/kelolawalikelas" class="menu-link">
                                    <div data-i18n="Basic">Siswa</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="/kelolawalikelas" class="menu-link">
                                    <div data-i18n="Basic">Wali Kelas</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="/kelolawalisiswa" class="menu-link">
                                    <div data-i18n="Basic">Wali Siswa</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="/kelolakesiswaan" class="menu-link">
                                    <div data-i18n="Basic">Kesiswaan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="/kelolakelas" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-alt-2"></i>
                            <div data-i18n="Basic">Kelas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="/kelolajurusan" class="menu-link">
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
                        <h4 class="m-1">Pengaturan Presensi</h4>
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
                        <div class="row">

                            <div class="col">

                                <div class="card">
                                    <input type="hidden" id="lokasi">
                                    <div class="card-header">
                                        <h4 class="card-title">Kelola Titik Koordinat</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="map" style="height: 260px"></div>
                                        <form method="POST" action="editkoordinat">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="k" class="col-form-label">Titik
                                                        Koordinat</label>
                                                    <input name="k" type="text" id="k"
                                                        class="form-control"
                                                        value= "{{ $koordinat->titik_koordinat }}">
                                                </div>

                                                <div class="col">
                                                    <label for="r" class="col-form-label">radius</label>
                                                    <input name="r" type="text" id="k"
                                                        class="form-control" value={{ $koordinat->radius }}>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-absen">Simpan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="col">
                                <div class="card">

                                    <div class="card-header">
                                        <h4 class="card-title">Kelola Waktu Presensi</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action={{ route('editabsen') }}>
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="mulaiMasuk" class="col-form-label">Mulai Presensi
                                                        Masuk</label>
                                                    <input class="form-control" type="time"
                                                        value={{ $waktu->mulai_absen }} id="mulaiMasuk"
                                                        name="mulai_absen">
                                                </div>
                                                <div class="col">
                                                    <label for="batasMasuk" class="col-form-label">Batas Presensi
                                                        Masuk</label>
                                                    <input class="form-control" type="time"
                                                        value={{ $waktu->batas_absen }} id="batasMasuk"
                                                        name="batas_absen">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="mulaiPulang" class="col-form-label">Mulai Presensi
                                                        Pulang</label>
                                                    <input class="form-control" type="time"
                                                        value="{{ $waktu->mulai_pulang }}" id="mulaiPulang"
                                                        name="mulai_pulang">
                                                </div>
                                                <div class="col">
                                                    <label for="batasPulang" class="col-form-label">Batas Presensi
                                                        Pulang</label>
                                                    <input class="form-control" type="time"
                                                        value={{ $waktu->batas_pulang }} id="batasPulang"
                                                        name="batas_pulang">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-absen">Simpan</button>
                                    </div>
                                    </form>
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }


        function successCallback(position) {

            var lokasi_sekolah = "{{ $koordinat->titik_koordinat }}";
            var lok = lokasi_sekolah.split(",");
            var lat_sekolah = lok[0];
            var long_sekolah = lok[1];
            var map = L.map('map').setView([lat_sekolah, long_sekolah], 17);
            var radius = "{{ $koordinat->radius }}";
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([lat_sekolah, long_sekolah]).addTo(map);
            var circle = L.circle([lat_sekolah, long_sekolah], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback(params) {

        }
    </script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
