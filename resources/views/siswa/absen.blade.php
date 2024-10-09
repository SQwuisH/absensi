<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/fonts/boxicons.css') }}>

    <!-- icon -->
    <link rel="icon" type="image/x-icon" href={{ asset('assets/t2/img/6.png') }} />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="{{ asset('assets/face-api.js/dist/face-api.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <title>Siswa | Aplikasi Absensi Sebelas</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.html" class="nav__logo">
                <img src={{ asset('assets/t2/img/7.png') }} style="height: 35px; width: auto;">
            </a>

            <div class="nav__menu mt-3" id="nav-menu">
                <ul class="nav__list">
                    {{-- Beranda --}}
                    <li class="nav__item">
                        <a href="{{ route('siswa') }}" class="nav__link">
                            <i class='bx bx-home-alt nav__icon'></i>
                            <span class="nav__name">Beranda</span>
                        </a>
                    </li>

                    {{-- Laporan Absensi --}}
                    <li class="nav__item">
                        <a href="#" class="nav__link">
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
                                {{-- Profile --}}
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i
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

    <!-- Content wrapper -->
    <div class="content-wrapper">

        <input type="hidden" id="lokasi">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y" style="margin-top: 40px;">

            {{-- Back Button --}}
            <h4 class="py-3 mb-2">
                <a href={{ route('siswa') }} class="btn rounded btn-outline-danger"><i
                        class='bx bx-chevron-left'></i></a>
                Absen
            </h4>

            {{-- Warning --}}
            @if (Session::get('warning'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                    {{ Session::get('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Photo -->
                <div class="col">
                    <div class="card mb-4">
                        <h5 class="card-header">Foto</h5>
                        <div class="card-body">

                            {{-- Photo --}}
                            <div class="row d-flex justify-content-center">
                                <div style="overflow: hidden; position: relative;"
                                    class="mb-3">
                                    <div style="width: 450px; height: 300px; overflow:hidden">
                                        <div style="width: 100%; height: 100%;" id="webcamCapture">
                                        </div>
                                        <img id="result" style="width: 100%; height: 100%;">
                                        <canvas id="faceCanvas" style="position: absolute; top: 0; left: 0;">
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                            {{-- Button Photo --}}
                            <div class="d-flex justify-content-center">
                                <button type="button" id="takeSnapshot" class="btn btn-absen"><i
                                        class='bx bx-fullscreen'></i>&nbsp;Ambil Foto</button>
                                <div class="m-3"></div>
                                <button type="button" id="resetCamera" class="btn btn-warning"><i
                                        class='bx bx-repeat'></i>&nbsp;Ulang</button>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="col">
                    <div class="card mb-4">
                        <h5 class="card-header">Titik Koordinat</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div style="min-height: 10cm; min-width:10cm" id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Button Absen --}}
                @if ($cek > 0)
                    <button type="button" class="btn-absen btn-danger btn-block" id="absen"
                        style="border-radius: 10px; padding:7px; font-size: 20px">
                        <i class="ik ik-maximize"></i>&nbsp;Absen Pulang
                    </button>
                @else
                    <button type="button" class="btn-absen btn-absen btn-block" id="absen"
                        style="border-radius: 10px; padding:7px; font-size: 20px">
                        <i class="ik ik-maximize"></i>&nbsp;Absen Masuk
                    </button>
                @endif

                <div class="d-block d-md-none" style="height: 50px"></div>

            </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
    </div>

    {{-- Location --}}
    <script>
        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }


        function successCallback(position) {
            var lokasi = document.getElementById('lokasi');
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;

            // Use the variables from the inline script
            var lokasi_sekolah = "{{ $lokasi->titik_koordinat }}";
            var radius = "{{ $lokasi->radius }}";

            var lok = lokasi_sekolah.split(",");
            var lat_sekolah = lok[0];
            var long_sekolah = lok[1];
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src={{ asset('assets/t2/js/main.js') }}></script>
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/core.css') }} class="template-customizer-core-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/theme-default.css') }}
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/css/demo.css') }} />

    <script src={{ asset('assets/t1/js/main.js') }}></script>

    <script src="{{ asset('assets/absen.js') }}"></script>

</body>

</html>
