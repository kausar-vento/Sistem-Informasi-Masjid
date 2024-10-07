@push('titles')
<title>Keranjang Anda</title>
@endpush

@push('meta')
<script type="text/javascript" src="{{asset('https://app.sandbox.midtrans.com/snap/snap.js')}}"
    {{-- Untuk Sandbox pakai Ini --}}
    {{-- <script type="text/javascript" src="{{asset('https://app.sandbox.midtrans.com/snap/snap.js')}}" --}}
    {{-- Untuk Production pakai ini --}}
    {{-- <script type="text/javascript" src="{{asset('https://app.midtrans.com/snap/snap.js')}}" --}}
    data-client-key="{{config('midtrans.client_key_sandbox')}}"></script>
@endpush

@extends('user.component.header')

@section('navbar-user')

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">List Transaksi Anda</h5>

            <!-- Default Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Nama Item / Tanggal Pemesanan</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataT as $item)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            @if ($item->id_pesan_ruangan != null)
                            Pesan Ruangan
                            @elseif($item->id_boking_event != null)
                            Event Masjid
                            @elseif($item->id_fund_raising != null)
                            Donasi
                            @endif
                        </td>
                        <td>
                            @if ($item->id_pesan_ruangan != null)
                            @tanggal($item->pesanruangan->tanggal_mulai)
                            @elseif($item->id_boking_event != null)
                            {{$item->event->nama_event}}
                            @elseif($item->id_fund_raising != null)
                            {{$item->fundraising->nama_kegiatan}}
                            @endif
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-primary">{{$item->status_pembayaran}}</span>
                        </td>
                        <td>
                            @if ($item->status_pembayaran === 'Proses')
                                <a href="{{route('pembayaranEvent', $item->id)}}" class="btn btn-success">Bayar Sekarang</a>
                            @elseif($item->status_pembayaran === 'Menunggu')
                                <a href="{{route('pembayaranEvent', $item->id)}}" class="btn btn-success">Lanjutkan Pembayaran</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Default Table Example -->
        </div>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</section>

@endsection
