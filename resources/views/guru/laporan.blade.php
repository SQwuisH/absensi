<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="c:/laragon/www/layout_abas//assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Guru | Aplikasi Absensi Sebelas</title>

    <meta name="description" content="" />

    <!-- icon -->
    <link
      rel="icon"
      type="image/x-icon"
      href="c:/laragon/www/layout_abas/asset/img/6.png"
    />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="c:/laragon/www/layout_abas//assets/vendor/fonts/boxicons.css"
    />

    <!-- Core CSS -->
    <link
      rel="stylesheet"
      href="c:/laragon/www/layout_abas//assets/vendor/css/core.css"
      class="template-customizer-core-css"
    />
    <link
      rel="stylesheet"
      href="c:/laragon/www/layout_abas//assets/vendor/css/theme-default.css"
      class="template-customizer-theme-css"
    />
    <link
      rel="stylesheet"
      href="c:/laragon/www/layout_abas//assets/css/demo.css"
    />

    <!-- Vendors CSS -->
    <link
      rel="stylesheet"
      href="c:/laragon/www/layout_abas//assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"
    />
    <link
      rel="stylesheet"
      href="c:/laragon/www/layout_abas//assets/vendor/libs/apex-charts/apex-charts.css"
    />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="c:/laragon/www/layout_abas//assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="c:/laragon/www/layout_abas//assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside
          id="layout-menu"
          class="layout-menu menu-vertical menu bg-menu-theme"
        >
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img
                  src="c:/laragon/www/layout_abas/asset/img/7.png"
                  style="height: 70px; width: auto"
                />
              </span>
            </a>

            <a
              href="javascript:void(0);"
              class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none"
            >
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Dashboard</span>
            </li>

            <li class="menu-item ">
              <a href="index.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Basic">Dashboard</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Apps &amp; Pages</span>
            </li>

            <!-- Pages -->
            <li class="menu-item">
              <a href="listSiswa.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Account Settings">List Siswa</div>
              </a>
            </li>

            <li class="menu-item active">
              <a href="laporan.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div data-i18n="laporan">Laporan Absensi</div>
              </a>
            </li>

            
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div
              class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none"
            >
              <a
                class="nav-item nav-link px-0 me-xl-4"
                href="javascript:void(0)"
              >
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div
              class="navbar-nav-right d-flex align-items-center"
              id="navbar-collapse"
            >
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Searchc:/laragon/www/layout_abas."
                    aria-label="Searchc:/laragon/www/layout_abas."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                  >
                    <div class="avatar avatar-online">
                      <img
                        src="c:/laragon/www/layout_abas/assets/img/avatars/1.png"
                        alt
                        class="w-px-40 h-auto rounded-circle"
                      />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img
                                src="c:/laragon/www/layout_abas/assets/img/avatars/1.png"
                                alt
                                class="w-px-40 h-auto rounded-circle"
                              />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block">Guru</span>
                            <small class="text-muted">Guru</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../index.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="col-lg-12 mb-4 order-0">
                <div class="card mb-4">
                  <h5 class="card-header">Laporan Absensi</h5>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="row" style="margin-top: -30px;">
                          <div class=" col-lg-8 demo-inline-spacing mt-3">
                            <div class="list-group list-group-horizontal-md text-md-center" role="tablist">
                              <a class="list-group-item list-group-item-action active" id="list-hari" data-bs-toggle="list" href="#horizontal-hari" aria-selected="true" role="tab">Hari</a>
                              <a class="list-group-item list-group-item-action" id="list-minggu" data-bs-toggle="list" href="#horizontal-minggu" aria-selected="false" tabindex="-1" role="tab">Minggu</a>
                              <a class="list-group-item list-group-item-action" id="list-bulan" data-bs-toggle="list" href="#horizontal-bulan" aria-selected="false" tabindex="-1" role="tab">Bulan</a>
                              <a class="list-group-item list-group-item-action" id="list-semester" data-bs-toggle="list" href="#horizontal-semester" aria-selected="false" tabindex="-1" role="tab">Semester</a>
                              <a class="list-group-item list-group-item-action" id="list-tahun" data-bs-toggle="list" href="#horizontal-tahun" aria-selected="false" tabindex="-1" role="tab">Tahun</a>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            
                          </div>
                          <div class="tab-content px-0 mt-0">


                            <div class="tab-pane fade show active" id="horizontal-hari" role="tabpanel" aria-labelledby="list-hari">
                                <div style="margin-top: -60px; margin-left: 750px;">
                                  <ul class="pagination pagination-sm">
                                    <li class="page-item prev">
                                      <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item">
                                      <a class="page-link" href="javascript:void(0);">23, February 2024</a>
                                    </li>
                                    <li class="page-item next">
                                      <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>

                            <div class="tab-pane fade" id="horizontal-minggu" role="tabpanel" aria-labelledby="list-minggu">
                              <div style="margin-top: -83px; margin-left: 735px;">
                                <ul class="pagination pagination-sm">
                                  <li class="page-item prev">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);">18-23, February 2024</a>
                                  </li>
                                  <li class="page-item next">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a>
                                  </li>
                                </ul>
                              </div>
                            </div>

                             <div class="tab-pane fade" id="horizontal-bulan" role="tabpanel" aria-labelledby="list-bulan">
                              <div style="margin-top: -83px; margin-left: 735px;">
                                <ul class="pagination pagination-sm">
                                  <li class="page-item prev">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);">February 2024</a>
                                  </li>
                                  <li class="page-item next">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a>
                                  </li>
                                </ul>
                              </div>
                            </div>

                             <div class="tab-pane fade" id="horizontal-semester" role="tabpanel" aria-labelledby="list-semester">
                              <div style="margin-top: -83px; margin-left: 735px;">
                                <ul class="pagination pagination-sm">
                                  <li class="page-item prev">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);">Semester Ganjil 2024</a>
                                  </li>
                                  <li class="page-item next">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a>
                                  </li>
                                </ul>
                              </div>
                            </div>

                            <div class="tab-pane fade" id="horizontal-tahun" role="tabpanel" aria-labelledby="list-tahun">
                              <div style="margin-top: -83px; margin-left: 735px;">
                                <ul class="pagination pagination-sm">
                                  <li class="page-item prev">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-left"></i></a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);">2023-2024</a>
                                  </li>
                                  <li class="page-item next">
                                    <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevron-right"></i></a>
                                  </li>
                                </ul>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!--/ Custom content with heading -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div
                class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column"
              >
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a
                    href="https://themeselection.com"
                    target="_blank"
                    class="footer-link fw-medium"
                    >ThemeSelection</a
                  >
                </div>
                <div class="d-none d-lg-inline-block">
                  <a
                    href="https://themeselection.com/license/"
                    class="footer-link me-4"
                    target="_blank"
                    >License</a
                  >
                  <a
                    href="https://themeselection.com/"
                    target="_blank"
                    class="footer-link me-4"
                    >More Themes</a
                  >

                  <a
                    href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link"
                    >Support</a
                  >
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

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="c:/laragon/www/layout_abas//assets/vendor/libs/jquery/jquery.js"></script>
    <script src="c:/laragon/www/layout_abas//assets/vendor/libs/popper/popper.js"></script>
    <script src="c:/laragon/www/layout_abas//assets/vendor/js/bootstrap.js"></script>
    <script src="c:/laragon/www/layout_abas//assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="c:/laragon/www/layout_abas//assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="c:/laragon/www/layout_abas//assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="c:/laragon/www/layout_abas//assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="c:/laragon/www/layout_abas//assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>