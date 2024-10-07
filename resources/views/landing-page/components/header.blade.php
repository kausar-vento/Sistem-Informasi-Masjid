<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @stack('titles')
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="icon" href="{{asset('assets/landing-page/assets/img/new_logo.png')}}" type="image/png">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link
        href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700')}}"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/landing-page/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css')}}" />

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/landing-page/assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Regna
  * Template URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center {{(request()->is('/')) ? 'header-transparent' : ''}}">
        <div class="container d-flex justify-content-between align-items-center">

            <div id="logo">
                <a href="index.html"><img src="{{asset('assets/landing-page/assets/img/new_logo.png')}}" alt=""
                        style="width: 25%;"></a>
                <!-- Uncomment below if you prefer to use a text logo -->
                <!--<h1><a href="index.html">Regna</a></h1>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
                    <li><a class="nav-link scrollto" href="#portfolio">Event</a></li>
                    <li><a class="nav-link scrollto" href="#services">Donasi</a></li>
                    <li><a class="nav-link scrollto " href="#contact">Kontak</a></li>
                    @auth
                        <li><a class="nav-link" href="{{route('loginUser')}}">Home User</a></li>
                    @else
                        <li><a class="nav-link" href="{{route('loginUser')}}">Masuk</a></li>
                    @endauth
                    
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    @yield('main')
    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Masjid Abdullah Permata Jingga</strong>. 
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/landing-page/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('assets/landing-page/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('assets/landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/landing-page/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/landing-page/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/landing-page/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/landing-page/assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/landing-page/assets/js/main.js')}}"></script>
    @stack('scripts')
</body>

</html>
