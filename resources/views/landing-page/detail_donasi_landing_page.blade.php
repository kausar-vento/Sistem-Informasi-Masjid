@push('titles')
<title>Detail</title>
@endpush

@extends('landing-page.components.header')

@section('main')
<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Detail Kegiatan</h2>
                <ol>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Detail Event</li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider">
                        <div class="align-items-center">

                            <div class="swiper-slide">
                                <img src="{{asset('storage/'.$getDonasi->thumbnail_donasi)}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Detail Kegiatan</h3>
                        {!!$getDonasi->detail_donasi!!}
                    </div>
                    <br>
                    <div class="portfolio-info">
                        <h2>Rincian Dana</h2>
                        {!!$getDonasi->rincian_dana!!}
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
@endsection
