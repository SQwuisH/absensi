@php
    $s = date('m-d-Y', strtotime($start));
    $e = date('m-d-Y', strtotime($end));
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @laravelPWA

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--=============== CSS ===============-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

            <div class="nav__menu mt-3" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('siswa') }}" class="nav__link ">
                            <i class='bx bx-home-alt nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#" class="nav__link" style="color: hsl(174, 63%, 40%)">
                            <i class='bx bx-book nav__icon'></i>
                            <span class="nav__name">Laporan Absensi</span>
                        </a>
                    </li>

                    <li class="nav__item" style="color: #222b2a;">
                        <div class="btn-group" id="dropdown-icon-demo">
                            <a class="dropdown nav__link" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-user me-1 nav__icon"></i>
                                <span class="nav__name"> Profil <i class="bx bx-chevron-down me-1"></i> </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="{{ route('sProfil') }}" class="dropdown-item d-flex align-items-center"><i
                                            class="bx bx-user scaleX-n1-rtl"></i> Profil </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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
            <div class="d-block d-sm-none" style="min-height: 30px"></div>
            <div class="d-none d-sm-block d-md-none" style="min-height: 35px"></div>
            <div class="d-none d-md-block d-lg-none" style="min-height: 55px"></div>
            <div class="d-none d-lg-block d-xl-none" style="min-height: 60px"></div>
            <div class="d-none d-xl-block" style="min-height: 60px"></div>

            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (Session::get('error'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h4 class="card-title mb-2">
                <div class="row">
                    <div class="col-10">
                        <a href={{ route('siswa') }} class="btn rounded btn-outline-danger"><i
                                class='bx bx-chevron-left'></i></a> Laporan Absensi
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <form action="">
                            <button type="submit" class="btn btn-light border border-black"><i
                                    class='bx bx-export'></i>Export</button>
                        </form>
                    </div>
                </div>
            </h4>

            <div class="row mb-2">
                <div class="col">

                    <div class="card">

                        <div class="card-header">

                            <form action={{ route('sLaporan') }}>
                                <div class="row">
                                    <div class="col-9">
                                        <input type="text" name="daterange" class="form-control" />
                                    </div>
                                    <div class="col-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-absen">search</button>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">

                            {{-- PERSENTASE --}}
                            <div class="progress mb-3" style="height: 35px; font-size:13px;">

                                {{-- HADIR --}}
                                @if ($persentase['hadir'] != 0)
                                    <div class="progress-bar border-end shadow-none" role="progressbar"
                                        style="width: {{ $persentase['hadir'] }}%; background-color: hsl(174, 63%, 40%)"
                                        aria-valuemin="0">
                                        <div>{{ round($persentase['hadir']) }}%</div>
                                    </div>
                                @endif

                                {{-- SAKIT --}}
                                @if ($persentase['sakit'] != 0)
                                    <div class="progress-bar bg-info border-end shadow-none text-center"
                                        role="progressbar" style="width: {{ $persentase['sakit'] }}%"
                                        aria-valuemin="0">
                                        <div>{{ round($persentase['sakit']) }}%</div>
                                    </div>
                                @endif

                                {{-- IZIN --}}
                                @if ($persentase['izin'] != 0)
                                    <div class="progress-bar bg-warning border-end shadow-none text-center"
                                        role="progressbar" style="width: {{ $persentase['izin'] }}%"
                                        aria-valuemin="0">
                                        <div>{{ round($persentase['izin']) }}%</div>
                                    </div>
                                @endif

                                {{-- ALFA --}}
                                @if ($persentase['alfa'] != 0)
                                    <div class="progress-bar bg-danger border-end shadow-none" role="progressbar"
                                        style="width: {{ $persentase['alfa'] }}%" aria-valuemin="0">
                                        <div>{{ round($persentase['alfa']) }}%</div>
                                    </div>
                                @endif

                                {{-- TERLAMBAT --}}
                                @if ($persentase['terlambat'] != 0)
                                    <div class="progress-bar bg-secondary border-end shadow-none" role="progressbar"
                                        style="width: {{ $persentase['terlambat'] }}%" aria-valuemin="0">
                                        <div>{{ round($persentase['terlambat']) }}%</div>
                                    </div>
                                @endif

                                {{-- TAP --}}
                                @if ($persentase['tap'] != 0)
                                    <div class="progress-bar bg-black border-end shadow-none" role="progressbar"
                                        style="width: {{ $persentase['tap'] }}%" aria-valuemin="0">
                                        <div>{{ round($persentase['tap']) }}%</div>
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
                                                {{ $jumlah['hadir'] }} Hari
                                            </div>
                                        </div>
                                    </div>

                                    {{-- sakit --}}
                                    <div class="col">
                                        <div class="card bg-info text-white mb-3">
                                            <div class="card-header">
                                                <h6 class="card-title text-white">sakit:</h6>
                                                {{ $jumlah['sakit'] }} Hari
                                            </div>
                                        </div>
                                    </div>

                                    {{-- izin --}}
                                    <div class="col">
                                        <div class="card bg-warning text-white mb-3">
                                            <div class="card-header">
                                                <h6 class="card-title text-white">Izin:</h6>
                                                {{ $jumlah['izin'] }} Hari
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- ALFA --}}
                                    <div class="col">
                                        <div class="card bg-danger text-white mb-3">
                                            <div class="card-header">
                                                <h6 class="card-title text-white">Alfa:</h6>
                                                {{ $jumlah['alfa'] }} Hari
                                            </div>
                                        </div>
                                    </div>

                                    {{-- TERLAMBAT --}}
                                    <div class="col">
                                        <div class="card bg-secondary text-white mb-3">
                                            <div class="card-header">
                                                <h6 class="card-title text-white">Terlambat:</h6>
                                                {{ $jumlah['terlambat'] }} Hari
                                            </div>
                                        </div>
                                    </div>

                                    {{-- TAP --}}
                                    <div class="col">
                                        <div class="card bg-black text-white mb-3" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                            data-bs-original-title="<span>Tanpa Absen Pulang</span>">
                                            <div class="card-header">
                                                <div class="row">
                                                    <h6 class="col card-title text-white">TAP:</h6>
                                                </div>

                                                {{ $jumlah['tap'] }} Hari
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- HR --}}
                            <div class="row mt-2">
                                <div class="d-flex bd-highlight">
                                    <div class="p-2 w-100 bd-highlight">
                                        <h5>Tabel Kehadiran</h5>
                                    </div>
                                    <div class="p-2 flex-shrink-1 bd-highlight">
                                        <button class="btn btn-outline-secondary" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasScroll" aria-controls="offcanvasScroll">
                                            <i class='bx bxs-filter-alt'></i>
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- MODAL FILTER CHECKBOX --}}
                            <div class="col-lg-4 col-md-6">
                                <div class="offcanvas offcanvas-bottom border border-black" data-bs-scroll="true"
                                    data-bs-backdrop="false" tabindex="-1" id="offcanvasScroll"
                                    aria-labelledby="offcanvasScrollLabel">
                                    <div class="offcanvas-header">
                                        <h5 id="offcanvasScrollLabel" class="offcanvas-title">Filter Status Kehadiran
                                        </h5>
                                        <button type="button" class="btn-close text-reset"
                                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                        <div class="position">
                                            <div class="row mb-0">
                                                <div class="col form-check">
                                                    <input class="form-check-input filter-checkbox" type="checkbox"
                                                        value="hadir" id="hadir" name="category[0]" checked>
                                                    <label class="form-check-label" for="hadir">Hadir</label>
                                                </div>

                                                <div class="col form-check">
                                                    <input class="form-check-input filter-checkbox" type="checkbox"
                                                        value="sakit" id="sakit" name="category[1]" checked>
                                                    <label for="sakit" class="form-check-label">Sakit</label>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col form-check">
                                                    <input class="form-check-input filter-checkbox" type="checkbox"
                                                        value="izin" id="izin" name="category[2]" checked>
                                                    <label class="form-check-label" for="izin">Izin</label>
                                                </div>
                                                <div class="col form-check">
                                                    <input class="form-check-input filter-checkbox" type="checkbox"
                                                        value="alfa" id="alfa" name="category[3]" checked>
                                                    <label for="alfa" class="form-check-label">Alfa</label>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col form-check">
                                                    <input class="form-check-input filter-checkbox" type="checkbox"
                                                        value="terlambat" id="terlambat" name="category[4]" checked>
                                                    <label for="terlambat" class="form-check-label">Terlambat</label>
                                                </div>
                                                <div class="col form-check">
                                                    <input class="form-check-input filter-checkbox" type="checkbox"
                                                        value="TAP" id="tap" name="category[5]" checked>
                                                    <label for="tap" class="form-check-label">TAP</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col modal-footer">
                                                    <button class="btn btn-primary" type="submit">Apply</button>
                                                </div>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TABEL --}}
                            <table class="table mb-3 datatable" id="datarange">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th class="pl-5">Status</th>
                                        <th class="text-center">detil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensi as $a)
                                        @include('siswa.modalLaporan')
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
                                                <button class="btn btn-absen" data-bs-toggle="modal"
                                                    data-bs-target="#modal{{ $a->id_absensi }}"><i
                                                        class='bx bx-show-alt'></i>Lihat</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            {{-- PAGINATION --}}
                            <div class="d-flex justify-content-center">
                                {{ $absensi->links('pagination::bootstrap-4') }}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , Absensi Sebelas
            </div>
        </div>
    </footer>
    </div>



    <!--=============== MAIN JS ===============-->

    <script src={{ asset('assets/t2/js/main.js') }}></script>
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/core.css') }} class="template-customizer-core-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/vendor/css/theme-default.css') }}
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href={{ asset('assets/t1/css/demo.css') }} />




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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <script>
        $(function() {

            $('input[name="daterange"]').daterangepicker({
                startDate: "{{ $s }}",
                endDate: "{{ $e }}"
            });
        });
    </script>

</body>

</html>
