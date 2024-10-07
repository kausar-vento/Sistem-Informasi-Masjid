@push('titles')
<title>Home User</title>
@endpush

@extends('user.component.header')

@section('navbar-user')

{{-- Event --}}
<div class="pagetitle">
    <h1>Event</h1>
    <div class="row">
        <div class="col-md-10">
            <h6 class="mt-2">Iktui dan Raih Ilmu Untuk Akhirat dan Dunia</h6>
        </div>
        <div class="col-md-2"><a class="btn btn-primary" href="{{route('homeListEvent')}}">Selengkapnya</a></div>
    </div>


</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        @foreach ($dataE as $item)
        <div class="col-md-3">
            <div class="card">
                <a href="{{route('detailEvent', $item->nama_event)}}"><img src="{{asset('storage/'.$item->thumbnail)}}"
                        class="bd-placeholder-img card-img-top rounded" width="100%" height="225"></a>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- Donasi --}}
<div class="pagetitle">
    <h1>Fund Raising</h1>
    <div class="row">
        <div class="col-md-10">
            <h6 class="mt-2">Sisikanlah beberapa hartamu, niscaya akan digantikan dengan lebih baik</h6>
        </div>
        <div class="col-md-2"><button class="btn btn-primary">Selengkapnya</button></div>
    </div>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        @foreach ($dataF as $item)
        <div class="col-md-3">
            <div class="card">
                <a href="{{route('detailFundRaising', $item->nama_kegiatan)}}">
                    <img src="{{asset('storage/'.$item->thumbnail_donasi)}}"
                        class="bd-placeholder-img card-img-top rounded" width="100%" height="200"></a>
            </div>
        </div>
        @endforeach
    </div>
</section>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@endsection
