@php
    $sta = date('m-d-Y', strtotime($start));
    $e = date('m-d-Y', strtotime($end));
@endphp
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Kesiswaan | Aplikasi Absensi Sebelas</title>

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

                    <li class="menu-item">
                        <div class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Basic">{{ $user->name }}<br>
                                <span class="text-secondary">Wali Kelas</span>
                            </div>
                        </div>
                        <div class="container row">
                            <a href="{{route('waliProfil')}}" class="btn btn-absen"> Lihat Profil </a>
                        </div>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Halaman</span>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('wali') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home"></i>
                            <div data-i18n="Basic">Beranda</div>
                        </a>
                    </li>

                    <li class="menu-item active">
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Basic">Laporan</div>
                        </a>
                    </li>


                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Log out</span>
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
                        <h4 class="m-1">Laporan Kelas
                            {{ $k->tingkat . ' ' . strtoupper($k->id_jurusan) . ' ' . $k->nomor_kelas }}</h4>
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

                        {{-- Title --}}
                        <div class="row">
                            <h5><a href="{{ url()->previous() }}" class="btn btn-danger"><i
                                        class='bx bx-arrow-back'></i> <span class="d-none d-md-block">
                                        Kembali</span></a>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- Name --}}
                                        <a href="#">
                                            <h5 class="card-title">
                                                {{ $sis->user->name }} <i class="bx bx-search"></i>
                                            </h5>
                                        </a>

                                        {{-- Date Range --}}
                                        <form action="{{ route('kesiswaanLaporanSiswa', '00' . $sis->nis) }}">
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" name="daterange" class="form-control">
                                                </div>
                                                <div class="col-3 d-flex justify-content-end">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-absen"><i
                                                                class="bx bx-search"></i><span
                                                                class="d-none d-md-block"> search</span></button>
                                                        <a href="#" class="btn btn-absen"><i
                                                                class="bx bx-export"></i> Ekspor</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        {{-- Progress Bar --}}
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="progress" style="height: 30px">
                                                    {{-- HADIR --}}
                                                    @if ($persen['hadir'] != 0)
                                                        <div class="progress-bar bg-absen"
                                                            style="width: {{ $persen['hadir'] }}%"
                                                            aria-valuenow="{{ $persen['hadir'] }}%"
                                                            aria-valuemax="100%">
                                                            {{ $persen['hadir'] }}% Kehadiran</div>
                                                    @endif

                                                    {{-- SAKIT --}}
                                                    @if ($persen['sakit'] != 0)
                                                        <div class="progress-bar bg-info"
                                                            style="width: {{ $persen['sakit'] }}%"
                                                            aria-valuenow="{{ $persen['sakit'] }}%"
                                                            aria-valuemax="100%">
                                                            {{ $persen['sakit'] }}% sakit</div>
                                                    @endif

                                                    {{-- IZIN --}}
                                                    @if ($persen['izin'] != 0)
                                                        <div class="progress-bar bg-warning"
                                                            style="width: {{ $persen['izin'] }}%"
                                                            aria-valuenow="{{ $persen['izin'] }}%"
                                                            aria-valuemax="100%">
                                                            {{ $persen['izin'] }}% izin</div>
                                                    @endif

                                                    {{-- ALFA --}}
                                                    @if ($persen['alfa'] != 0)
                                                        <div class="progress-bar bg-danger"
                                                            style="width: {{ $persen['alfa'] }}%"
                                                            aria-valuenow="{{ $persen['alfa'] }}%"
                                                            aria-valuemax="100%">
                                                            {{ $persen['alfa'] }}% alfa</div>
                                                    @endif

                                                    {{-- TERLAMBAT --}}
                                                    @if ($persen['terlambat'] != 0)
                                                        <div class="progress-bar bg-secondary"
                                                            style="width: {{ $persen['terlambat'] }}%"
                                                            aria-valuenow="{{ $persen['terlambat'] }}%"
                                                            aria-valuemax="100%">
                                                            {{ $persen['terlambat'] }}% terlambat</div>
                                                    @endif

                                                    {{-- TAP --}}
                                                    @if ($persen['tap'] != 0)
                                                        <div class="progress-bar bg-black"
                                                            style="width: {{ $persen['tap'] }}%"
                                                            aria-valuenow="{{ $persen['tap'] }}%"
                                                            aria-valuemax="100%">
                                                            {{ $persen['tap'] }}% TAP</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Card Info --}}
                                        <div class="row">

                                            {{-- hadir --}}
                                            <div class="col-4">
                                                <div class="card bg-absen text-white mb-3">
                                                    <div class="card-header">
                                                        <h6 class="card-title text-white">Hadir:</h6>
                                                        {{ $count['hadir'] }} Hari
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- sakit --}}
                                            <div class="col-4">
                                                <div class="card bg-info text-white mb-3">
                                                    <div class="card-header">
                                                        <h6 class="card-title text-white">sakit:</h6>
                                                        {{ $count['sakit'] }} Hari
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- izin --}}
                                            <div class="col-4">
                                                <div class="card bg-warning text-white mb-3">
                                                    <div class="card-header">
                                                        <h6 class="card-title text-white">Izin:</h6>
                                                        {{ $count['izin'] }} Hari
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            {{-- ALFA --}}
                                            <div class="col-4">
                                                <div class="card bg-danger text-white mb-3">
                                                    <div class="card-header">
                                                        <h6 class="card-title text-white">Alfa:</h6>
                                                        {{ $count['alfa'] }} Hari
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- TERLAMBAT --}}
                                            <div class="col-4">
                                                <div class="card bg-secondary text-white mb-3">
                                                    <div class="card-header">
                                                        <h6 class="card-title text-white">Terlambat:
                                                        </h6>
                                                        {{ $count['terlambat'] }} Hari
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- TAP --}}
                                            <div class="col-4">
                                                <div class="card bg-black text-white mb-3" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    data-bs-original-title="<span>Tanpa Absen Pulang</span>">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <h6 class="col card-title text-white">TAP:
                                                            </h6>
                                                        </div>

                                                        {{ $count['tap'] }} Hari
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Class List --}}
                                        <h5 class="mt-2 mb-2">
                                            Tabel Kehadiran
                                        </h5>

                                        <table class="table">
                                            <thead>
                                                <td>Tanggal</td>
                                                <td>Status</td>
                                                <td class="text-center">Detil</td>
                                            </thead>
                                            @foreach ($paginated as $a)
                                                <tr>
                                                    <td>{{ $a->date }}</td>
                                                    <td>
                                                        @switch($a->status)
                                                            @case('hadir')
                                                                <span class="badge bg-absen">
                                                                    {{ $a->status }}
                                                                </span>
                                                            @break

                                                            @case('sakit')
                                                                <span class="badge bg-info">
                                                                    {{ $a->status }}
                                                                </span>
                                                            @break

                                                            @case('izin')
                                                                <span class="badge bg-warning">
                                                                    {{ $a->status }}
                                                                </span>
                                                            @break

                                                            @case('alfa')
                                                                <span class="badge bg-danger">
                                                                    {{ $a->status }}
                                                                </span>
                                                            @break

                                                            @case('terlambat')
                                                                <span class="badge bg-secondary">
                                                                    {{ $a->status }}
                                                                </span>
                                                            @break

                                                            @case('TAP')
                                                                <span class="badge bg-black">
                                                                    {{ $a->status }}
                                                                </span>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td class="text-center">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#modal{{ $a->id_absensi }}"
                                                            class="btn btn-absen">
                                                            <i class="bx bx-show"></i><span
                                                                class="d-none d-md-block">Lihat</span>
                                                        </button>
                                                    </td>
                                                </tr>

                                                @include('siswa.modalLaporan')
                                            @endforeach
                                        </table>


                                        {{-- PAGINATION --}}
                                        <div class="d-flex justify-content-center">
                                            {{ $paginated->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {

            $('input[name="daterange"]').daterangepicker({
                startDate: "{{ $sta }}",
                endDate: "{{ $e }}"
            });
        });
    </script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
