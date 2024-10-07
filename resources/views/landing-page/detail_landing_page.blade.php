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
                                <img src="{{asset('storage/'.$getEvent->thumbnail)}}">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Detail Kegiatan</h3>
                        <ul>
                            <li><strong><i class="bx bx-calendar"></i></strong>: {{Carbon\Carbon::parse($getEvent->tanggal_event)->locale('id')->translatedFormat('l, d M Y')}}</li>
                            @if ($getEvent->lokasi_event === 'Luar Masjid')
                                <li><strong><i class="bx bx-location-plus"></i></strong>:</li>
                                {!!$getEvent->lokasi_luar_masjid!!}
                            @else
                                <li><strong><i class="bx bx-location-plus"></i></strong>: {{$getEvent->ruangan->nama_ruangan}}</li>
                            @endif
                            @if ($getEvent->jam_selesai == null)
                                <li><strong><i class="bx bx-alarm"></i></strong>: {{$getEvent->jam_mulai}} - Selesai</li>
                            @else
                                <li><strong><i class="bx bx-alarm"></i></strong>: {{$getEvent->jam_mulai}} - {{$getEvent->jam_selesai}}</li>
                            @endif
                            
                        </ul>
                    </div>
                    <br>
                    <div class="portfolio-info">
                        <h2>Penjelasan</h2>
                        {!!$getEvent->detail_event!!}
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
@endsection
