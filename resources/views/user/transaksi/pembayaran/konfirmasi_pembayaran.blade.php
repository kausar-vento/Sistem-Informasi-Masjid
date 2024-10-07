@push('titles')
<title>Konfirmasi Transaksi Pesanan Ruangan</title>
@endpush

@push('meta')
{{-- Untuk Sandbox pakai Ini --}}
<script type="text/javascript" src="{{asset('https://app.sandbox.midtrans.com/snap/snap.js')}}"
    {{-- Untuk Production pakai ini --}}
    {{-- <script type="text/javascript" src="{{asset('https://app.midtrans.com/snap/snap.js')}}" --}}
    data-client-key="{{config('midtrans.client_key_sandbox')}}"></script>
@endpush

@extends('user.component.header')
@section('navbar-user')

<h1></h1>
<div class="col-md-6 mx-auto">
    <div class="card">
        @if ($getId->id_boking_event != null)
            <img src="{{asset('storage/'.$getId->event->thumbnail)}}" alt=""
            class="card-img-top">
        @elseif($getId->id_pesan_ruangan != null)
        @php
            $get = json_decode($getId->pesanruangan->ruangan->gambar_ruangan, true);
            $getImage = $get[0];
        @endphp
            <img src="{{asset('storage/'.$getImage)}}" alt=""
            class="card-img-top">
        @elseif($getId->id_fund_raising != null)
            <img src="{{asset('storage/'.$getId->fundraising->thumbnail_donasi)}}" alt=""
            class="card-img-top">
        @endif
        <div class="card-body">
            <h5 class="card-title text-center">Detail Pesanan</h5>
            <div class="card-text">
                <div class="col-md-8">
                    <p>Nama Pemesan: <strong>{{$getId->user->nama_lengkap}}</strong></p>
                    <p>Email Pemesan: <strong>{{$getId->user->email}}</strong></p>
                    @if ($getId->id_pesan_ruangan != null)
                    <p>Jenis Item: <strong>Pesan Ruangan</strong></p>
                    <p>Nama Item: <strong>{{$getId->pesanruangan->ruangan->nama_ruangan}}</strong></p>
                    @elseif ($getId->id_boking_event != null)
                    <p>Jenis Item: <strong>Event Masjid</strong></p>
                    <p>Nama Item: <strong>{{$getId->event->nama_event}}</strong></p>
                    @elseif ($getId->id_fund_raising != null)
                    <p>Jenis Item: <strong>Donasi</strong></p>
                    <p>Nama Item: <strong>{{$getId->fundraising->nama_kegiatan}}</strong></p>
                    @endif
                    <p>Total Harga: <strong>@harga($getId->total_harga)</strong></p>
                    <p>Detail Pemesanan:</p>
                    @php
                    $itemDetail = json_decode($getId->item_details, true);
                    @endphp
                    @foreach ($itemDetail as $key => $ticket)
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="item-{{$key}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{$key}}" aria-expanded="false"
                                    aria-controls="flush-collapse{{$key}}">
                                    <strong>{{$ticket['name']}}</strong>
                                </button>
                            </h2>
                            <div id="flush-collapse{{$key}}" class="accordion-collapse collapse"
                                aria-labelledby="item-{{$key}}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Harga Tiket: <strong>@harga($ticket['price'])</strong></li>
                                        <li>Jumlah Tiket: <strong>{{$ticket['quantity']}}</strong></li>
                                        <li>Total: <strong>@harga($ticket['price'] * $ticket['quantity'])</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Accordion without outline borders -->
                    @endforeach
                </div>
            </div>
            <input type="hidden" id="snapToken" value="{{$snapToken}}">
            <input type="hidden" id="idTrans" value="{{$getId->id}}">
            <button class="btn btn-success float-end" id="pay-button">Bayar Sekarang</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');

    payButton.addEventListener('click', function () {
        var getSnapToken = $('#snapToken').val();
        var getIdTrans = $('#idTrans').val();
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay(getSnapToken, {
            onSuccess: function (result) {
                /* You may add your own implementation here */
                $.ajax({
                    url: '{{ route("updateStatusPembayaran", ":id_transaksi") }}'.replace(':id_transaksi', getIdTrans),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_transaksi: getIdTrans
                    },
                    success: function (response) {
                        window.location.href = '{{ route("suksesPembayaran", ":idTrans") }}'.replace(':idTrans', getIdTrans);
                    },
                    error: function (xhr, status, error) {
                        alert("Update status pembayaran gagal!");
                    }
                });
            },
            onPending: function (result) {
                alert("wating your payment!");
                console.log(result);
            },
            onError: function (result) {
                alert("payment failed!");
                console.log(result);
            },
            onClose: function () {
                alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>
@endpush
