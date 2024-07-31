<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== CSS ===============-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href={{ asset('assets/t2/css/styles.css') }}>
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/fonts/boxicons.css') }}>

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

            <div class="nav__menu mt-3" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#" class="nav__link " style="color: hsl(174, 63%, 40%)">
                            <i class='bx bx-home-alt nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <i class='bx bx-book nav__icon'></i>
                            <span class="nav__name">Laporan Absensi</span>
                        </a>
                    </li>

                    <li class="nav__item" style="color: #222b2a;">
                        <div class="btn-group" id="dropdown-icon-demo">
                            <a  class="dropdown nav__link" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bx bx-user me-1 nav__icon"></i>
                                <span class="nav__name"> Profil <i class="bx bx-chevron-down me-1"></i> </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" >
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i
                                            class="bx bx-user scaleX-n1-rtl"></i> Profil </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item d-flex align-items-center">
                                        <i class="bx bx-log-out scaleX-n1-rtl"></i> Logout
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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

    <main>
        <!--=============== HOME ===============-->
        <div class="container flex-grow-1 container-p-y" style="margin-top: 60px;">
            <div class="row mb-2">
                <div class="card" >
                    <div class="card-header">
                        <h4 class="card-title">
                            Halo, {{ auth::user()->name}} !
                        </h4>
                    </div>
                </div>
            </div>

            <div class="row mb-2 text-center">
                <div class="card col m-1">
                    <div class="card-header">
                        <h6 class="card-title">
                            Jadwal Absen Masuk
                        </h6>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card col m-1" >
                    <div class="card-header">
                        <h6 class="card-title">
                            jadwal Absen Pulang
                        </h6>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card col m-1" >
                    <div class="card-header">
                        <h6 class="card-title">
                            Jarak
                        </h6>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card col m-1" >
                    <div class="card-header">
                        <h6 class="card-title">
                            Tanggal
                        </h6>
                    </div>
                    <div class="card-body">
                        @php
                            echo date('D, d-m-y');
                        @endphp
                    </div>
                </div>
            </div>

            <div class="row mb-2 text-center">
                <div class="card col m-1" >
                    <div class="card-header">
                        <h4 class="card-title">
                            Jam
                        </h4>
                    </div>
                    <div class="card-body">
                        @php
                            echo now();
                        @endphp
                    </div>
                </div>
                <div class="card col m-1" >
                    <div class="card-header">
                        <h4 class="card-title">
                            Keterangan Kehadiran
                        </h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>

            <div class="row mb-2 text-center">
                <a href="#" class="card col m-1" >
                    <div class="card-header">
                        <h4 class="card-title">
                            Absen
                        </h4>
                    </div>
                </a>
            </div>

            <div class="row mb-2 text-center">
                <a href="#" class="card col m-1" >
                    <div class="card-header">
                        <h4 class="card-title">
                            Izin atau Sakit
                        </h4>
                    </div>
                </a>
            </div>

            <div style="height: 50px">
                <br>
                <br>
                <i class='bx bx-copyright'></i> Aplikasi Absensi Sebelas, 2024
            </div>

        </div>
    </main>


    <!--=============== MAIN JS ===============-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src={{ asset('assets/t2/js/main.js') }}></script>
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/core.css') }} class="template-customizer-core-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/theme-default.css') }}
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/css/demo.css') }} />

    <script src={{ asset('assets/t1/js/main.js') }}></script>


    {{-- SCRIPTS --}}

</body>

</html>
