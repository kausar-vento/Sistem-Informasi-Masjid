@push('titles')
<title>Pembayaran Sukses</title>
@endpush
@extends('user.component.header')
@section('navbar-user')
<div class="col-md-6 mx-auto">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">Pembayaran Sukses</h4>
        </div>
        <div class="card-body text-center">
            <img src="{{asset('https://static-00.iconduck.com/assets.00/transaction-illustration-850x1024-qhp8boe7.png')}}"
                alt="Payment Success" class="img-fluid mb-4 mt-3" style="max-width: 200px;">
            <h5 class="card-title">Terima kasih atas pembayaran Anda!</h5>
            <p class="card-text">
                Pembayaran Anda telah berhasil diproses. Berikut adalah rincian pembayaran Anda:
            </p>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item">ID Transaksi: <b>{{$getTransaksi->kode_transaksi}}</b></li>
                <li class="list-group-item">Nama: <b>{{$getTransaksi->user->nama_lengkap}}</b></li>
                <li class="list-group-item">Email: <b>{{$getTransaksi->user->email}}</b></li>
                <li class="list-group-item">Total Bayar: <b>@harga($getTransaksi->total_harga)</b></li>
                <li class="list-group-item"><b>Detail Item:</b></li>
            </ul>
            @php
            $getDetail = json_decode($getTransaksi->item_details, true)
            @endphp
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach ($getDetail as $key => $value)
                    <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-pills-btn-{{$key}}"
                        data-bs-toggle="pill" data-bs-target="#v-pills-show-{{$key}}" type="button" role="tab"
                        aria-controls="v-pills-show-{{$key}}"
                        aria-selected="{{$key == 0 ? 'true' : 'false'}}">{{$value['name']}}</button>
                    @endforeach
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    @foreach ($getDetail as $key => $value)
                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="v-pills-show-{{$key}}"
                        role="tabpanel" aria-labelledby="v-pills-btn-{{$key}}">
                        <ul>
                            <li>Jumlah: <b>{{$value['quantity']}}</b></li>
                            <li>Harga: @harga($value['price'])</li>
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('homeUser') }}" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
