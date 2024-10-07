@push('titles')
<title>Proses Pembayaran</title>
@endpush
@extends('user.component.header')

@section('navbar-user')

<section class="section">
    <!-- Default Card -->
    <div class="card">
        <div class="card-body">
            <center>
                <h5 class="card-title">DETAIL PEMBAYARAN</h5>
            </center>
            @if ($getTransaksi->id_boking_event != null)
                @include('user.transaksi.pembayaran.component.layout_event')
            @elseif($getTransaksi->id_pesan_ruangan != null)
                @include('user.transaksi.pembayaran.component.layout_pesan_ruangan')
            @elseif($getTransaksi->id_fund_raising != null)
                @include('user.transaksi.pembayaran.component.layout_fund_raising')
            @endif
        </div>
    </div><!-- End Default Card -->
    @if (session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-trash-fill me-1"></i>
        {{session('failed')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</section>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#sui').click(function () {
            var inputValue = $(this).attr("value");
            $('#customHarga').toggle();
        });
    });
    var tanpa_rupiah = document.getElementById('inputHarga');
    tanpa_rupiah.addEventListener('keyup', function (e) {
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>
@endpush
