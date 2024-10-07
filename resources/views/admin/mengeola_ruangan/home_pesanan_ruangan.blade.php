@push('titles')
<meta http-equiv="X-UA-Compatible" content="ie=edge">
</meta>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Home Verifikasi Pesanan</title>
@endpush

@push('css-biasa')
<style>
    .invoice {
        margin: 20px;
    }

    .invoice-header {
        background-color: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .invoice-body {
        padding: 20px;
    }

    .company-logo {
        max-width: 150px;
    }

</style>
@endpush

@extends('admin.component.header')

@section('header-admin')
@if (session()->has('success'))
<div class="alert alert-info alert-dismissible" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pesanan Ruangan User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" class="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Booking</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPR as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user->nama_lengkap}}</td>
                        <td>{{$item->tanggal_mulai}} - {{$item->tanggal_selesai}}</td>
                        <td>{{$item->status_pemesanan}}</td>
                        <td>
                            <a href="{{route('detailPemesananRuangan', $item->id)}}" class="btn rounded-pill btn-primary">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="invoice">
                                <div class="invoice-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h2>Detail:</h2>
                                            <p>Tanggal Sewa: <span id="getTanggalMulai"></span></p>
                                            <p>Ruangan Sewa: <span id="getRuangan"></span></p>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <img src="https://via.placeholder.com/120" alt="Company Logo"
                                                class="company-logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-body">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Jumlah Peserta</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Tipe Acara</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span id="getJumlahPeserta"></span></td>
                                                <td><span id="getJamMulai"></span></td>
                                                <td><span id="getJamSelesai"></span></td>
                                                <td>
                                                    <button class="btn btn-primary" id="btnK">Kecil</button>
                                                    <button class="btn btn-success" id="btnB">Besar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-right text-justify " id="getKebutuhanPenyewa">

                                    </div>
                                    <div class="text-right row">
                                        <div class="col-sm-10">
                                            <p><strong>Total: Rp. <span id="getHargaRuangan"></span></strong></p>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="" id="getDownloadImage" download>Bukti Gambar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p clasFs="idNamaPemesan"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <input type="hidden" id="testUpdate">
                        <button type="button" class="btn btn-success" id="setujuPesanan">Setuju Pesanan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
