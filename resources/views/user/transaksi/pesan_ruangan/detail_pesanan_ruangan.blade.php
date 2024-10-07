@push('titles')
<title>Konfirmasi Transaksi Pesanan Ruangan</title>
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

<h1></h1>
<div class="col-md-6 mx-auto">
    <div class="card">
        <img src="{{asset('https://www.greenscene.co.id/wp-content/uploads/2018/11/venom-1-696x497.jpg')}}" alt=""
            class="card-img-top">
        <div class="card-body">
            <h5 class="card-title text-center">Detail Pesanan</h5>
            <div class="card-text">
                <div class="col-md-8">
                    <p>Nama Pemesan: <strong>{{Auth::user()->nama_lengkap}}</strong></p>
                    <p>Ruangan Yang Dipesan: <strong>{{$getId->ruangan->nama_ruangan}}</strong></p>
                    <p>Tanggal Sewa: <strong>{{$getId->tanggal_mulai}}</strong></p>
                    <p>Jam Sewa: <strong>{{$getId->jam_mulai}} - {{$getId->jam_selesai}}</strong></p>
                    <p>Jumlah Peserta: <strong>{{$getId->jumlah_peserta}}</strong></p>
                    <p>Tipe Acara: <strong>{{$getId->tipe_acara}}</strong></p>
                    <p>Harga Ruangan: <strong>{{$getId->ruangan->harga_ruangan}}</strong></p>
                </div>
            </div>
            <input type="hidden" id="snapToken" value="{{$snapToken}}">
            <button class="btn btn-success float-end" id="pay-button">Bayar Sekarang</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');

    payButton.addEventListener('click', function () {
        var getSnapToken = $('#snapToken').val();
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          window.location.href = '{{ route("homeUser") }}';
          // window.location.href = '{{ route("afterPayment") }}' + '?result=success&data=' + JSON.stringify(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });
</script>
@endpush
