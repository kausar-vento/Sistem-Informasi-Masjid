<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" href="{{asset('assets/landing-page/assets/img/favicon.png')}}" type="image/png">

    @stack('titles')
    <meta content="" name="description">
    <meta content="" name="keywords">
    @stack('meta')

    <link href="{{asset('https://fonts.gstatic.com')}}" rel="preconnect">
    <link
        href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    {{-- Full calender --}}
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css')}}" />
    
    {{-- <script src="{{asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script> --}}

    {{-- End Full Calender --}}

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet">

    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="{{asset('https://unpkg.com/trix@2.0.0/dist/trix.css')}}">
    <script type="text/javascript" src="{{asset('https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js')}}"></script>
    @stack('styles')

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

@if (request()->is('user/pesan-ruangan/konfirmasi-pesanan-ruangan'))
    <body onload="onloadFunction()">
@else
    <body>
@endif
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{route('homeUser')}}" class="logo d-flex align-items-center">
                <img src="{{asset('assets/landing-page/favicon.png')}}" alt="">
                <span class="d-none d-lg-block">Welcome {{Auth::user()->nama_lengkap}}</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{asset('assets/user/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->nama_lengkap}}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{Auth::user()->nama_lengkap}}</h6>
                            <span>Selamat Datang</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        {{-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li> --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('prosesLogout')}}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    @include('user.component.sidebar')

    <main id="main" class="main">

        @yield('navbar-user')

    </main><!-- End #main -->


    <!-- Vendor JS Files -->
    <script src="{{asset('assets/user/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/user/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/user/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/user/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('assets/user/js/main.js')}}"></script>
    @stack('scripts')

</body>

</html>
