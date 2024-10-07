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
            <img src="{{asset('https://img.freepik.com/premium-vector/success-online-payment-icon-illustration-design_8499-6184.jpg')}}" alt="Payment Success" class="img-fluid mb-4"
                style="max-width: 200px;">
            <h5 class="card-title">Terima kasih atas pembayaran Anda!</h5>
            <p class="card-text">
                Pembayaran Anda telah berhasil diproses. Berikut adalah rincian pembayaran Anda:
            </p>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item"><strong>ID Transaksi:</strong> {{ $transaksi->kode_transaksi }}</li>
                <li class="list-group-item"><strong>Nama:</strong> {{ $transaksi->user->nama_lengkap }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $transaksi->user->email }}</li>
                <li class="list-group-item"><strong>Total Bayar:</strong>@harga($transaksi->total_harga)</li>
            </ul>
            <div class="mt-4">
                <a href="{{ route('homeUser') }}" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection
