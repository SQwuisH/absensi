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
                        <a href="{{ route('siswa') }}" class="nav__link">
                            <i class='bx bx-home-alt nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="{{ route('sLaporan') }}" class="nav__link">
                            <i class='bx bx-book nav__icon'></i>
                            <span class="nav__name">Laporan Absensi</span>
                        </a>
                    </li>

                    <li class="nav__item" style="color: #222b2a;">
                        <div class="btn-group" id="dropdown-icon-demo">
                            <a class="dropdown nav__link" data-bs-toggle="dropdown" aria-expanded="false"
                                style="color: hsl(174, 63%, 40%)">
                                <i class="bx bx-user me-1 nav__icon"></i>
                                <span class="nav__name"> Profil <i class="bx bx-chevron-down me-1"></i> </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i
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
            <div class="d-block d-sm-none" style="min-height: 25px"></div>
            <div class="d-none d-sm-block d-md-none" style="min-height: 30px"></div>
            <div class="d-none d-md-block d-lg-none" style="min-height: 50px"></div>
            <div class="d-none d-lg-block d-xl-none" style="min-height: 60px"></div>
            <div class="d-none d-xl-block" style="min-height: 60px"></div>



            <form action={{ route('editprofil') }} method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value={{ $siswa->id }}>
                <h4 class="card-title mb-2">
                    <a href={{ route('siswa') }} class="btn rounded btn-outline-danger"><i
                            class='bx bx-chevron-left'></i></a>
                    Profil
                </h4>
                @if (Session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ Session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(Session('failed'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        {{ Session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-item-start gap-4">
                                    <img src="{{ asset('/storage/user_avatar/' . $siswa->foto) }}" alt=""
                                        class="d-block rounded" height="100" width="100">
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-absen me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input"
                                                hidden="" name="foto"
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
                                            value="{{ $siswa->name }}" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="NIS" class="form-label">NIS</label>
                                        <input class="form-control" type="text" id="NIS"
                                            value="00{{ $siswa->siswa->nis }}" disabled>
                                        <input type="hidden" name="nis" value="00{{ $siswa->siswa->nis }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="Email" class="form-label">Email</label>
                                        <input class="form-control" type="Email" id="Email" name="email"
                                            value="{{ $siswa->email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">ganti password</label>
                                        <input class="form-control" type="password" id="password" name="password"
                                            placeholder="masukkan password baru">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="kpassword" class="form-label">konfirmasi password</label>
                                        <input class="form-control" type="password" id="kpassword" name="kPassword"
                                            placeholder="masukkan password baru">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-absen me-2">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            <div>
                <i class='bx bx-copyright'></i> Aplikasi Absensi Sebelas, 2024
                <div class="d-md-none" style="height:60px;"></div>
            </div>

        </div>


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
