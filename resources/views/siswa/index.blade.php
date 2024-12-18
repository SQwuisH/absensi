<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @laravelPWA

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== CSS ===============-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    <link rel="stylesheet" href={{ asset('assets/t2/css/styles.css') }}>
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

    <!-- icon -->
    <link rel="icon" type="image/x-icon" href={{ asset('assets/t2/img/6.png') }} />

    <script></script>

    <title>Siswa | Aplikasi Absensi Sebelas</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.html" class="nav__logo">
                <img src={{ asset('assets/t2/img/7.png') }} style="height: 35px; width: auto;">
            </a>

            {{-- NAV --}}
            <div class="nav__menu mt-3" id="nav-menu">
                <ul class="nav__list">
                    {{-- Beranda --}}
                    <li class="nav__item">
                        <a href="#" class="nav__link " style="color: hsl(174, 63%, 40%)">
                            <i class='bx bx-home-alt nav__icon'></i>
                            <span class="nav__name">Beranda</span>
                        </a>
                    </li>

                    {{-- Laporan Absensi --}}
                    <li class="nav__item">
                        <a href="{{ route('sLaporan') }}" class="nav__link">
                            <i class='bx bx-book nav__icon'></i>
                            <span class="nav__name">Laporan Absensi</span>
                        </a>
                    </li>

                    {{-- Profil & Logout --}}
                    <li class="nav__item" style="color: #222b2a;">
                        <div class="btn-group" id="dropdown-icon-demo">
                            <a class="dropdown nav__link" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-user me-1 nav__icon"></i>
                                <span class="nav__name"> Profil <i class="bx bx-chevron-down me-1"></i> </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                {{-- Profil --}}
                                <li>
                                    <a href="{{ route('sProfil') }}" class="dropdown-item d-flex align-items-center"><i
                                            class="bx bx-user scaleX-n1-rtl"></i> Profil </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                {{-- Logout --}}
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                        class="dropdown-item d-flex align-items-center">
                                        <i class="bx bx-log-out scaleX-n1-rtl"></i> Logout
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>


        </nav>
    </header>

    <!--=============== HOME ===============-->
    <div class="content-wrapper">
        <div class="container flex-grow-1 container-p-y">

            {{--  --}}
            <div class="d-block d-sm-none" style="min-height: 25px"></div>
            <div class="d-none d-sm-block d-md-none" style="min-height: 30px"></div>
            <div class="d-none d-md-block d-lg-none" style="min-height: 50px"></div>
            <div class="d-none d-lg-block d-xl-none" style="min-height: 60px"></div>
            <div class="d-none d-xl-block" style="min-height: 60px"></div>

            {{-- MODAL --}}
            <div class="modal fade" id="izinSakitModal" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Laporan Izin Atau Sakit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row d-flex justify-content-center text-centered">
                                <div class="col mb-3 d-flex justify-content-center text-centered">
                                    <a href="/pengajuan/izin" class="btn btn-outline-warning">
                                        <i class='bx bx-edit'></i>&nbsp; Izin
                                    </a>
                                </div>
                                <div class="col mb-3 d-flex justify-content-center text-centered">
                                    <a href="/pengajuan/sakit" class="btn btn-outline-warning"
                                        style="min-height: 75px; min-width:75px">
                                        <i class='bx bx-injection'></i>&nbsp; Sakit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ALERT --}}
            <div class="row">
                @if (Session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
            </div>

            {{-- USERNAME --}}
            <div class="row mb-2">
                <div class="col d-none d-lg-block">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Halo, {{ Auth::user()->name }} !
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ROW 1 --}}
            <div class="row text-center">

                {{-- JADWAL ABSEN --}}
                <div class="col d-none d-lg-block">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="card-title">
                                Jadwal Absen Masuk
                            </h6>
                        </div>
                        <div class="card-body">
                            @php
                                echo $waktu->mulai_absen;
                                echo '-';
                                echo $waktu->batas_absen;
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="col d-none d-lg-block">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="card-title">
                                jadwal Absen Pulang
                            </h6>
                        </div>
                        <div class="card-body">
                            @php
                                echo $waktu->mulai_pulang;
                                echo '-';
                                echo $waktu->batas_pulang;
                            @endphp
                        </div>
                    </div>
                </div>

                {{-- JARAK --}}
                <div class="col d-none d-lg-block">
                    <div class="card mb-4" style="max-height: 125px">
                        <div class="card-header">
                            <h6 class="card-title">
                                Jarak (< {{ $lokasi->radius }} m) </h6>
                        </div>
                        <div class="card-body">
                            <p id="distance"></p>
                        </div>
                    </div>
                </div>

                {{-- JAM --}}
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header ">
                            <h6 class="card-title d-none d-lg-block">
                                Tanggal
                            </h6>
                            <div class="text-center d-lg-none">
                                {{ $date }}
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="text-center d-none d-lg-block">
                                {{ $date }}
                            </div>
                            <div class="card-title d-flex justify-content-center text-center d-lg-none">
                                <div class="row" style="width: 200px">
                                    <h1 class="col" id="jj"></h1>
                                    <h1 class="col">:</h1>
                                    <h1 class="col" id="mm"></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- ROW 2 --}}
            <div class="row text-center">
                {{-- JAM || JARAK  --}}
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title d-none d-lg-block">
                                Jam
                            </h4>

                            <h4 class="card-title d-lg-none">
                                Jarak
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="d-none d-lg-block">
                                <div class="d-flex justify-content-center text-center">
                                    <div class="row" style="width: 200px">
                                        <h1 class="col" id="j"></h1>
                                        <h1 class="col">:</h1>
                                        <h1 class="col" id="m"></h1>
                                    </div>
                                </div>
                            </div>
                            <h5 class="d-lg-none" id="d"></h5>
                        </div>
                    </div>
                </div>

                {{-- KETERANGAN --}}
                @include('siswa.keteranganstatus')

            </div>

            @if ($statusabsen != 'libur')
                <div class="p-3 card mb-4">
                    <div class="row">
                        <div class="col">
                            <div class="card bg-absen">
                                <div class="card-header text-center">
                                    <h5 class="card-title text-white">Jam Masuk</h5>
                                </div>
                                <div class="card-body text-center">
                                    @if ($absen->jam_masuk == null)
                                        <h2 class="text-white">-</h2>
                                    @else
                                        <h2 class="text-white">{{ $absen->jam_masuk }}</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-warning">
                                <div class="card-header text-center">
                                    <h5 class="card-title text-white">Jam Pulang</h5>
                                </div>
                                <div class="card-body text-center">
                                    @if ($absen->jam_pulang == null)
                                        <h2 class="text-white">-</h2>
                                    @else
                                        <h2 class="text-white">{{ $absen->jam_pulang }}</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- BUTTON --}}
            <div class="container mb-2">
                @include('siswa.tombolAbsen')
            </div>

            {{-- REKAP --}}
            <div class="container">
                <div class="row">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h4 class="card-title">
                                Rekap
                            </h4>
                            <div>
                                {{-- BUTTON NAV --}}
                                <ul class="nav nav-tabs nav-fill" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                                            aria-controls="true" aria-selected="navs-justified-home" tabindex="-1">
                                            <span>Bulan ini</span>

                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-justified-messages"
                                            aria-controls="navs-justified-messages" aria-selected="false"
                                            tabindex="-1">
                                            <span>Bulan lalu</span>
                                        </button>
                                    </li>
                                </ul>

                                {{-- CONTENT --}}
                                <div class="tab-content">

                                    {{-- BULAN INI --}}
                                    <div class="tab-pane fade active show" id="navs-justified-profile"
                                        role="tabpanel">
                                        <p><b>Total Kehadiran : </b>{{$jumlah['hadirIni'] . " / " . $daysnow}}</p>
                                        <div class="progress mb-3" style="height: 35px; font-size:13px;">
                                            @if ($persentase['ini'] == 0)
                                                <div class="progress-bar" role="progressbar"
                                                    style="width:100%; background-color:white; color:black"
                                                    aria-valuenow={{ $persentase['ini'] }} aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $persentase['ini'] }}%
                                                </div>
                                            @else
                                                <div class="progress-bar" role="progressbar"
                                                    style="width:{{ $persentase['ini'] }}%; background-color: hsl(174, 63%, 40%)"
                                                    aria-valuenow={{ $persentase['ini'] }} aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $persentase['ini'] }}%
                                                </div>
                                            @endif
                                        </div>
                                        {{-- INFO --}}
                                        <div>
                                            <div class="row">

                                                {{-- hadir --}}
                                                <div class="col">
                                                    <div class="card bg-absen text-white mb-3">
                                                        <div class="card-header">
                                                            <h6 class="card-title text-white">Hadir:</h6>
                                                            {{ $jumlah['hadirIni'] }} Hari
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- tidak hadir --}}
                                                <div class="col">
                                                    <div class="card bg-secondary text-white mb-3">
                                                        <div class="card-header">
                                                            <h6 class="card-title text-white">Tidak Hadir:</h6>
                                                            {{ $jumlah['tidakHadirIni'] }} Hari
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- BULAN LALU --}}
                                    <div class="tab-pane fade" id="navs-justified-messages">
                                        <p><b>Total Kehadiran</b>{{$jumlah['hadirLalu'] . " / " . $daysbefore}}</p>
                                        <div class="progress mb-3" style="height: 35px; font-size:13px;">
                                            @if ($persentase['lalu'] == 0)
                                                <div class="progress-bar" role="progressbar"
                                                    style="width:100%;  height: 35px; font-size:13px; background-color:white; color:black"
                                                    aria-valuenow={{ $persentase['lalu'] }} aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $persentase['lalu'] }}%
                                                </div>
                                            @else
                                                <div class="progress-bar" role="progressbar"
                                                    style="width:{{ $persentase['lalu'] }}%;  height: 35px; font-size:13px; background-color: hsl(174, 63%, 40%)"
                                                    aria-valuenow={{ $persentase['lalu'] }} aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $persentase['lalu'] }}%
                                                </div>
                                            @endif
                                        </div>
                                        {{-- INFO --}}
                                        <div>
                                            <div class="row">

                                                {{-- hadir --}}
                                                <div class="col">
                                                    <div class="card bg-absen text-white mb-3">
                                                        <div class="card-header">
                                                            <h6 class="card-title text-white">Hadir:</h6>
                                                            {{ $jumlah['hadirLalu'] }} Hari
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- tidak hadir --}}
                                                <div class="col">
                                                    <div class="card bg-secondary text-white mb-3">
                                                        <div class="card-header">
                                                            <h6 class="card-title text-white">Tidak Hadir:</h6>
                                                            {{ $jumlah['tidakHadirLalu'] }} Hari
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


            <i class='bx bx-copyright'></i> Aplikasi Absensi Sebelas, 2024


        </div>


        <!--=============== MAIN JS ===============-->
        <script src={{ asset('assets/waktu.js') }}></script>

        {{-- Location --}}
        <script>
            function jarak() {
                var lokasi = document.getElementById('lokasi');
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
                }

                // Output the server values to verify
                var lokasi_sekolah = "{{ $lokasi->titik_koordinat }}";
                var radius = parseFloat("{{ $lokasi->radius }}");
                console.log('lokasi_sekolah:', lokasi_sekolah);
                console.log('radius:', radius);

                function successCallback(position) {
                    console.log('User coordinates:', position.coords.latitude, position.coords.longitude);
                    var lat_user = position.coords.latitude;
                    var long_user = position.coords.longitude;

                    // Example coordinates for testing
                    var lok = lokasi_sekolah.split(",");
                    var lat_sekolah = lok[0];
                    var long_sekolah = lok[1];

                    var userLatLng = L.latLng(lat_user, long_user);
                    var schoolLatLng = L.latLng(lat_sekolah, long_sekolah);

                    var distance = userLatLng.distanceTo(schoolLatLng).toFixed(0);
                    var distanceInKm = (distance / 1000).toFixed(2);

                    document.getElementById('distance').innerText = distance + ' m';
                    document.getElementById('d').innerText = distance + ' m';
                    if (distance > radius) document.getElementById('presensi').classList.add('disabled');
                    if (distance > radius) document.getElementById('presensi').classList.add('disabled');

                }

                function errorCallback(error) {
                    console.error("Error retrieving location:", error);
                }
            }
            setInterval(jarak, 100);
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script src={{ asset('assets/t2/js/main.js') }}></script>
        <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/core.css') }}
            class="template-customizer-core-css" />
        <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/theme-default.css') }}
            class="template-customizer-theme-css" />
        <link rel="stylesheet" href={{ asset('assets/t1/css/demo.css') }} />

        <script src={{ asset('assets/t1/js/main.js') }}></script>


        {{-- SCRIPTS --}}

        <script src="{{ asset('/sw.js') }}"></script>

        <script src={{ asset('assets/t1/vendor/libs/jquery/jquery.js') }}></script>
        <script src={{ asset('assets/t1/vendor/libs/popper/popper.js') }}></script>
        <script src={{ asset('assets/t1/vendor/js/bootstrap.js') }}></script>
        <script src={{ asset('assets/t1/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}></script>
        <script src={{ asset('assets/t1/vendor/js/menu.js') }}></script>

        <script src={{ asset('assets/t1/js/main.js') }}></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
</body>

</html>
