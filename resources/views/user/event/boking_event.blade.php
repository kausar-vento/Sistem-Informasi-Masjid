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

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Event</th>
                        <th scope="col">Tanggal Event</th>
                        <th scope="col">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$getEvent->nama_event}}</td>
                        <td>{{$getEvent->tanggal_event}}</td>
                        <td>{{$getQty}}</td>
                    </tr>
                </tbody>
            </table>

            <form action="{{route('prosesPembayaranEvent')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Infaq Masjid</h5>
                        <div class="form-floating">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="radio" class="btn-check" name="infaq_masjid" id="success-outlined"
                                        autocomplete="off" value="10000">
                                    <label style="border: 2px solid" class="btn btn-outline-secondary"
                                        for="success-outlined">Rp. 10.000</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="btn-check" name="infaq_masjid" id="danger-outlined"
                                        autocomplete="off" value="20000">
                                    <label style="border: 2px solid" class="btn btn-outline-secondary"
                                        for="danger-outlined">Rp. 20.000</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="btn-check" name="infaq_masjid" id="nein"
                                        autocomplete="off" value="50000">
                                    <label style="border: 2px solid" class="btn btn-outline-secondary" for="nein">Rp.
                                        50.000</label>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <input type="radio" class="btn-check" name="infaq_masjid" id="nope"
                                        autocomplete="off" value="100000">
                                    <label style="border: 2px solid" class="btn btn-outline-secondary" for="nope">Rp.
                                        100.000</label>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <input type="radio" class="btn-check" name="infaq_masjid" id="nah"
                                        autocomplete="off" value="200000">
                                    <label style="border: 2px solid" class="btn btn-outline-secondary" for="nah">Rp.
                                        200.000</label>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <input type="radio" class="btn-check" name="infaq_masjid" id="wok"
                                        autocomplete="off" value="500000">
                                    <label style="border: 2px solid" class="btn btn-outline-secondary" for="wok">Rp.
                                        500.000</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="text" style="border: 1px solid;" name="custom_infaq_masjid"
                                    class=" form-control shadow bg-body rounded" id="customHarga" placeholder="Custom">
                            </div>
                            <small>Infaq masjid opsional, anda bisa kosongkan</small>
                            <br>
                            <div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="card-title">Keterangan</h6>
                        <div class="col-md-10">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Address" name="keterangan" id="floatingTextarea"
                                    style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Opsional, anda bisa kosongkan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-primary" name="tipe" type="submit" value="bayar_now">Bayar Sekarang</button>
                <button class="btn btn-secondary" name="tipe" type="submit" value="keranjang">Masukan Keranjang</button>
                <a class="btn btn-danger" href="{{route('detailEvent', $getEvent->nama_event)}}">Kembali</a>
            </form>
        </div>
    </div><!-- End Default Card -->

</section>


@endsection

@push('scripts')
<script>
    var tanpa_rupiah = document.getElementById('customHarga');
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
