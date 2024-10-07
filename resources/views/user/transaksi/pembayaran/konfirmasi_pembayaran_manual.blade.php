@push('titles')
<title>Konfirmasi Transaksi Pesanan Ruangan</title>
@endpush
@extends('user.component.header')
@section('navbar-user')
<div class="col-md-6 mx-auto">
    <div class="card">
        @if ($getId->id_boking_event != null)
        <img src="{{asset('storage/'.$getId->event->thumbnail)}}" alt="" class="card-img-top">
        @elseif($getId->id_pesan_ruangan != null)
        <img src="{{asset('https://freevector-images.s3.amazonaws.com/uploads/vector/preview/148717/vecteezyboxing-day-character-focused-illustrationas1022_generated.jpg')}}"
            alt="" class="card-img-top">
        @elseif($getId->id_fund_raising != null)
        <img src="{{asset('storage/'.$getId->fundraising->thumbnail_donasi)}}" alt="" class="card-img-top">
        @endif
        <div class="card-body">
            <h5 class="card-title text-center">Detail Pesanan</h5>
            <p id="countdown" class="text-center text-danger"></p>
            <div class="card-text">
                <div class="col-md-8">
                    <p>Nama Pemesan: <strong>{{$getId->user->nama_lengkap}}</strong></p>
                    <p>Email Pemesan: <strong>{{$getId->user->email}}</strong></p>
                    @if ($getId->id_pesan_ruangan != null)
                    <p>Jenis Item: <strong>Pesan Ruangan</strong></p>
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
                    @if ($getId->id_pesan_ruangan != null)
                    @include('user.transaksi.pembayaran.component.layout_konfirmasi_pesan_ruangan')
                    @else
                    @include('user.transaksi.pembayaran.component.layout_konfirmasi_event_dan_fr')
                    @endif
                    @endforeach
                </div>
            </div>
            <p></p>
            <form action="{{route('prosesPembayaranManual', $getId->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-10">
                    <label for="rekening">Rekening BSI: <strong>3766111119 an. Masjid Abdullah PJ</strong></label>
                    <input type="file" accept=".png, .jpg, .jpeg"
                        class="form-control @error('bukti_transaksi') is-invalid @enderror" name="bukti_transaksi"
                        id="bukti_transaksi" onchange="previewImage()">
                    <img class="img-preview img-fluid mt-3 mb-3 col-sm-5" style="display: none;">
                    @error('bukti_transaksi')
                    <span id="filePendukungError" class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button class="btn btn-success mt-3">Bayar Sekarang</button>
                <a class="btn btn-primary mt-3" href="{{route('keranjang')}}">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
<script>
    $(document).ready(function () {
        function startCountdown(expirationTime) {
            const countDownDate = new Date(expirationTime).getTime();

            const countdownFunction = setInterval(function () {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " +
                    seconds + "s ";

                if (distance < 0) {
                    clearInterval(countdownFunction);
                    document.getElementById("countdown").innerHTML = "EXPIRED";
                    $('#pay-button').prop('disabled', true);
                }
            }, 1000);
        }

        // Set expiration time to 7 AM today
        const now = new Date();
        const expirationTime = "{{ \Carbon\Carbon::parse($getId->expired_at)}}";

        startCountdown(expirationTime);
    });

    function previewImage() {
        const image = document.querySelector('#bukti_transaksi');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);
        ofReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>
@endpush
