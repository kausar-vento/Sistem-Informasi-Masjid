@push('titles')
<title>Sistem Informasi Masjid Abdullah</title>
@endpush

@extends('landing-page.components.header')

@section('main')
@include('landing-page.components.hero')
<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
        <div class="container" data-aos="fade-up">
            <div class="row about-container">

                <div class="col-lg-6 content order-lg-1 order-2">
                    <h2 class="title">Tentang Masjid Abdullah</h2>
                    <p class="text-justify">
                        Masjid Abdullah Permata Jingga bukan sekadar rumah ibadah, namun juga sentra kegiatan umat
                        muslim. Kami berkomitmen untuk mempertahankan identitas keislaman, membangun dan mendukung
                        ukhuwah, memajukan kehidupan islami sesuai tuntunan Al-Quran dan Sunnah Rasulullah.
                    </p>

                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon"><i class="bi bi-briefcase"></i></div>
                        <h4 class="title"><a href="#">Taqwa</a></h4>
                        <p class="description">Masjid Abdullah senantiasa mendorong jamaahnya untuk selalu berakhlak
                            mulia dan mencerminkan nilai-nilai ketaqwaan dalam kehidupan bermasyarakat.</p>
                    </div>

                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon"><i class="bi bi-card-checklist"></i></div>
                        <h4 class="title"><a href="#">Beriman</a></h4>
                        <p class="description">Masjid Abdullah senantiasa ramai dengan aktivitas para jamaah beriman
                            yang ingin melaksanakan ibadah, belajar ilmu agama, dan saling berbagi kebaikan</p>
                    </div>

                    <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon"><i class="bi bi-binoculars"></i></div>
                        <h4 class="title"><a href="#">Gotong Royong</a></h4>
                        <p class="description">Gotong royong di Masjid Abdullah merupakan wujud nyata dari semangat
                            kebersamaan dan kepedulian umat dalam menjaga dan memakmurkan masjid. Budaya ini
                            memiliki banyak manfaat bagi jamaah Masjid Abdullah dan masyarakat sekitar.</p>
                    </div>

                </div>

                <div class="col-lg-6 background order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100"></div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Event Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h3 class="section-title">EVENT</h3>
                <p class="section-description">Berikut adalah event yang akan diselenggarakan oleh Masjid Abdullah</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-card">Online</li>
                        <li data-filter=".filter-web">Offline</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                @foreach ($dataEvent as $item)
                <div class="col-lg-4 col-md-6 portfolio-item filter-as">
                    <a href="{{route('detailLandingPage', $item->nama_event)}}"><img
                            src="{{asset('storage/'.$item->thumbnail)}}" class="bd-placeholder-img card-img-top" alt=""
                            height="400px"></a>
                    <div class="portfolio-info">
                        <h4>{{$item->nama_event}}</h4>
                        <p><b>{{$item->peserta_event}}</b></p>

                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Services Section ======= -->
    <section id="services">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h3 class="section-title">PENGGALANGAN DANA</h3>
                <p class="section-description">Berikut adalah Penggalangan Dana Yang hadir di Masjid
                    Abdullah</p>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($dataDonasi as $donasi)
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm">
                        <img src="{{asset('storage/'.$donasi->thumbnail_donasi)}}"
                            class="bd-placeholder-img card-img-top" width="100%" height="300px">

                        <div class="card-body">
                            <p class="card-text">{{$donasi->nama_kegiatan}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a type="button" href="{{route('detailDonasiLandingPage', $donasi->nama_kegiatan)}}"
                                        class="btn btn-sm btn-outline-secondary">Detail</a>
                                </div>
                                <small class="text-muted">{{ Carbon\Carbon::parse($donasi->created_at)->locale('id')->translatedFormat('d M Y')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- <div class="col-lg-4 col-md-6" data-aos="zoom-in">
                    <div class="box">
                        <div class="icon"><a href="#"><i
                                    class="bi bi-calendar4-week"></i></a></div>
                        <h4 class="title"><a href="#">Eiusmod Tempor</a></h4>
                        <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                            tempore, cum soluta nobis est eligendi</p>
                    </div>
                </div> --}}
            </div>

        </div>
    </section>
    <!-- End Services Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact">
        <div class="container">
            <div class="section-header">
                <h3 class="section-title">Kontak</h3>
                <p class="section-description">Informasi Mengenai Masjid Bisa Menghubungi Nomor atau Mengunjungin
                    Lansung Ke Tempat</p>
            </div>
        </div>

        <!-- Uncomment below if you wan to use dynamic maps -->
        <iframe
            src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Masjid Abdullah Permata Jingga Malang&amp;t=h&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
            width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

        <!-- <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Masjid Abdullah Permata Jingga Malang&amp;t=h&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://strandsgame.net/">Strands NYT</a></div><style>.mapouter{position:relative;text-align:right;width:600px;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:600px;height:400px;}.gmap_iframe {width:600px!important;height:400px!important;}</style></div> -->

        <div class="container mt-5">
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-4">

                    <div class="info">
                        <div>
                            <i class="bi bi-geo-alt"></i>
                            <p>Permata Jingga, Jalan Permata Jingga III, Tunggulwulung, Kota Malang, Jawa Timur</p>
                        </div>

                        <div>
                            <i class="bi bi-envelope"></i>
                            <p>masjidabdullahpj@gmail.com</p>
                        </div>

                        <div>
                            <i class="bi bi-phone"></i>
                            <p>+62 855-7107-548</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="https://twitter.com/Masjidabdullah2" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="https://www.facebook.com/masjid.jingga?locale=id_ID" class="facebook"><i
                                class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/masjidabdullahpj/" class="instagram"><i
                                class="bi bi-instagram"></i></a>
                    </div>

                </div>

                <div class="col-lg-5 col-md-8">
                    <div class="form">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda"
                                    required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Jumlah Donasi" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Dukungan atau Doa"
                                    required></textarea>
                            </div>
                            <br>
                            <div class="text-center"><button type="submit">Donasikan Sekarang</button></div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
@endsection
@push('scripts')
<!-- Full Calender -->
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                right: 'prev, next'
            },
            selectable: true,
            selectHelper: true,
            events: [{
                    title: 'Tasfir Al - Quran',
                    start: '2024-03-06 20:00:00',
                    end: '2024-03-06 21:00:00',
                    color: 'green'
                },
                {
                    title: 'Tasfir Al - Quran',
                    start: '2024-03-20 20:00:00',
                    end: '2024-03-20 21:00:00',
                    color: 'green'
                },

                {
                    title: 'Tasfir Ibnu Katsir',
                    start: '2024-03-13 20:00:00',
                    end: '2024-03-13 21:00:00',
                    color: 'blue'
                },
                {
                    title: 'Tasfir Ibnu Katsir',
                    start: '2024-03-27 20:00:00',
                    end: '2024-03-27 21:00:00',
                    color: 'blue',
                },
            ],
            longPressDelay: 10,
            eventLongPressDelay: 10,
            selectLongPressDelay: 10,
        });
    });

</script>

@endpush
