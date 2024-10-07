@push('titles')
<title>Daftar Transaksi Fund Raising</title>
@endpush
@extends('admin.component.header')
@section('header-admin')
<div class="card">
    <h5 class="card-header">List Event Tersedia</h5>
</div>
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row row-cols-1 row-cols-md-3 g-4 mb-5 mt-3">
    @foreach ($dataFR as $item)
    <div class="col">
        <div class="card h-100">
            <a href="{{route('detailTransaksiFR', $item->nama_kegiatan)}}">
                <img src="{{asset('storage/'.$item->thumbnail_donasi)}}" alt="" class="card-img-top"
                    style="max-height: 350px;">
            </a>
            <div class="card-body">
                <h5 class="card-title">{{$item->nama_kegiatan}}</h5>
                <strong>{{$item->status_event}}</strong>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
