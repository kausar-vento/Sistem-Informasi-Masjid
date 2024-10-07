@push('titles')
<title>List Pesanan Ruangan Anda</title>
@endpush

@push('meta')
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@extends('user.component.header')

@section('navbar-user')

<div class="pagetitle">
    <h1>List Pesanan Ruangan Anda</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pemesanan</th>
                            <th scope="col">Status Pesanan</th>
                            <th scope="col">ِAksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPesanan as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>@tanggal($item->tanggal_mulai)</td>
                            <td>{{$item->status_pemesanan}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('detailPesananRuangan', $item->id)}}">Detail Pesanan</a>
                                <a class="btn btn-primary" href="{{route('detailPesananRuangan', $item->id)}}">Detail Pesanan</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection