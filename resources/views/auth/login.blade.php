<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login | Aplikasi Absensi Sebelas</title>

    <meta name="description" content="" />

    <!-- icon -->
    <link rel="icon" type="image/x-icon" href= {{ asset('assets/t2/img/6.png')}} />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href= {{ asset('assets/t1/vendor/fonts/boxicons.css') }}  />

    <!-- Core CSS -->
    <link rel="stylesheet" href= {{ asset('assets/t1/vendor/css/core.css') }} class="template-customizer-core-css" />
    <link rel="stylesheet" href= {{ asset('assets/t1/vendor/css/theme-default.css') }} class="template-customizer-theme-css" />
    <link rel="stylesheet" href= {{ asset('assets/t1/css/demo.css')}} />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href= {{ asset('assets/t1/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }} />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href= {{ asset('assets/t1/vendor/css/pages/page-auth.css') }} />

    <!-- Helpers -->
    <script src= {{ asset('assets/t1/vendor/js/helpers.js') }}></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src= {{ asset('assets/t1/js/config.js') }}></script>
  </head>

  <body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
              <div class="card-body">
                 <!-- Logo -->
                 <div style=" display: flex ;justify-content: center;">
                  <img src= {{ asset('assets/t2/img/7.png')}} style="height: 100px; width: auto;">
                </div>

                <!-- /Logo -->
                <h4 class="mb-2">Halo, Selamat Datang 👋</h4>
                <p class="mb-4">Di Aplikasi Absensi Sebelas</hp>


                <form id="formAuthentication" class="mb-3" action="{{route('postlogin')}}" method="POST">
                    @csrf
                  <div class="mb-3">
                        @error('error')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="email" class="form-label">Email atau Username</label>
                    <input
                      type="text"
                      class="form-control @error('email') is-invalid @enderror"
                      id="email"
                      name="email"
                      placeholder="Enter your email or username"
                      autofocus
                      required autocomplete="email"/>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        required autocomplete="password"
                        />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  <div class="mb-3">
                    <button type="submit" class="btn btn-primary d-grid w-100">
                        Login
                    </button>
                  </div>

                </form>
              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
      </div>


    <script src= {{ asset('assets/t1/vendor/libs/jquery/jquery.js')}}></script>
    <script src= {{ asset('assets/t1/vendor/libs/popper/popper.js')}}></script>
    <script src= {{ asset('assets/t1/vendor/js/bootstrap.js')}}></script>
    <script src= {{ asset('assets/t1/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}></script>
    <script src= {{ asset('assets/t1/vendor/js/menu.js')}}></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src= {{ asset('assets/t1/js/main.js')}}></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
