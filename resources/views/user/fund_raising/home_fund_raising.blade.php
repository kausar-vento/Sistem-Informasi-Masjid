@push('titles')
<title>List All Penggalangan Dana</title>
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
                    <h5 class="card-title">List Penggalangan Dana</h5>
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
                    @foreach ($dataFR as $item)
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href="{{route('detailFundRaising', $item->nama_kegiatan)}}">
                                <img src="{{asset('storage/'.$item->thumbnail_donasi)}}"
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
                            <small class="text-muted">{{$item->nama_kegiatan}}</small>
                            <br>
                            {{-- <div class="row">
                                <div class="col-md-8">
                                    <small class="text-muted">{{$item->nama_kegiatan}}</small>
                                </div>
                                <div class="col-md-4">
                                    <badge class="badge bg-primary">test</badge>
                                </div>
                            </div> --}}
                            <small>Dana Terkumpul: </small>
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
