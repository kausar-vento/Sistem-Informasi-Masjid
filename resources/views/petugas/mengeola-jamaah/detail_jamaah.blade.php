@extends('petugas.component.header')

@section('header-petugas')

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="{{asset('assets/petugas/img/undraw_profile.svg')}}" alt="Profile" class="rounded-circle">
                    <h2>Kevin Anderson</h2>
                    <h3>Permata Jingga</h3>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <div class="row">
                        <div class="col-10">
                            <ul class="nav nav-tabs nav-tabs-bordered nav-pills" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                    <button class="nav-link active" id="overview-tab" data-toggle="pill" data-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
                                </li>
        
                                <li class="nav-item">
                                    <button class="nav-link" id="bukti-gambar-tab" data-toggle="pill" data-target="#bukti-gambar" type="button" role="tab" aria-controls="bukti-gambar" aria-selected="false">Bukti Gambar KTP</button>
                                </li>
        
                            </ul>
                        </div>
                        <div class="col-2">
                            <div class="float-right">
                                <a class="dropdown-item" href="{{route('homeListJamaah')}}">
                                    <i class="fas fa-arrow-alt-circle-left fa-sm fa-fw mr-2 text-gray-400"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-content pt-2" id="pills-tabContent">

                        <div class="tab-pane fade show active profile-overview" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque
                                temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae
                                quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">Kevin Anderson</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Company</div>
                                <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Job</div>
                                <div class="col-lg-9 col-md-8">Web Designer</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Country</div>
                                <div class="col-lg-9 col-md-8">USA</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="bukti-gambar" role="tabpanel" aria-labelledby="bukti-gambar-tab">
                            <img src="{{asset('assets/petugas/img/tester.jpg')}}" class="img-fluid" alt="...">
                        </div>
                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
            <div class="float-right mt-3 mb-3">
                <a href="{{route('homeListJamaah')}}" class="btn btn-warning">Kembali</a>
                <a href="" class="btn btn-danger">Tidak Sesuai</a>
                <a href="" class="btn btn-success">Sesuai</a>
            </div>

        </div>
    </div>
</section>

@endsection
