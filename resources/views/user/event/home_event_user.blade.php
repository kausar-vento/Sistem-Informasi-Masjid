@push('titles')
<title>List All Event Masjid</title>
@endpush

@push('meta')
    <style>
        .card-text {
            display: block;
            width: 300px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            font-family: sans-serif;
        }
    </style>
@endpush
@extends('user.component.header')

@section('navbar-user')


<section class="section">
    <div class="row align-items-top">
        <!-- Default Card -->
        <div class="card">
            <div class="card-body">
                <center>
                    <h5 class="card-title">List Event Masjid</h5>
                </center>
                {{-- <div class="row mb-4">
                    <div class="col-2">
                        <a href="" class="test">Semua</a>
                    </div>
                    <div class="col-2">
                        <a href="" class="test">Online</a>
                    </div>
                    <div class="col-2">
                        <a href="" class="test">Offline</a>
                    </div>
                    <div class="col-2">
                        <a href="" class="test">Populer</a>
                    </div>
                    <div class="col-4">
                        <form class="row g-3">
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Masukan..">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Cari</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($dataEvent as $item)
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href="{{route('detailEvent', $item->nama_event)}}">
                                <img src="{{asset('storage/'.$item->thumbnail)}}"
                                class="bd-placeholder-img card-img-top" width="100%" height="225">
                            </a>
                            <div class="card-body">
                                <div class="mb-3 mt-2">
                                    <div class="">
                                        <p class="card-text">{{$item->nama_event}}</p>
                                    </div>
                                    {{-- <div class="col">
                                        <p class="card-text">{{$item->jenis_event}}</p>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <small class="text-muted">{{$item->tanggal_event}}</small>
                                    </div>
                                    <div class="col-md-4">
                                        @if ($item->jenis_event === 'Terbuka')
                                            <badge class="badge bg-primary">{{$item->jenis_event}}</badge>
                                        @else
                                            <badge class="badge bg-warning text-dark">{{$item->jenis_event}}</badge>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div><!-- End Default Card -->

    </div>
</section>

<style>
    .test {
        justify-content: center;
        border-radius: 20px;
        box-shadow: 0px 4px 4px 0px rgba(2, 2, 2, 0.25);
        background-color: #fff;
        text-align: center;
        padding: 10px;
    }

    @media (max-width: 991px) {
        .test {
            white-space: initial;
        }
    }

</style>

@endsection
