@push('titles')
<title>Detail {{$getFundR->nama_kegiatan}}</title>
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css')}}"
    crossorigin="anonymous" />
@endpush
@extends('user.component.header')
@section('navbar-user')
<br>
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <a href="{{route('detailFundRaising', $getFundR->nama_kegiatan)}}"><img
                        src="{{asset('storage/'.$getFundR->thumbnail_donasi)}}"
                        class="bd-placeholder-img card-img-top rounded img-fluid" width="100%" height="300"></a>
            </div>
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Penjelasan</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                Donasikan</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#profile-settings">Penggalangan Lainya</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Tentang Event</h5>
                            {!!$getFundR->detail_donasi!!}
                            {!!$getFundR->rincian_dana!!}
                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form action="{{route('prosesBookingFundRaising')}}" method="POST">
                                @csrf
                                <!-- Ticket 1 -->
                                <input type="hidden" name="id_fund_raising" value="{{$getFundR->id}}">
                                <div class="container">
                                    @foreach ($tiketFR as $item)
                                    <div class="card-ticket">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->nama_tiket}} (Sisa Tiket :
                                                <b>{{$item->kuota_tiket ?? 'Tanpa Batas'}}</b>)</h5>
                                            <div class="max-text">
                                                {!!$item->deskripsi_tiket!!}
                                                <b>@harga($item->harga_tiket)</b>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="quantity-container">
                                                <button type="button" class="btn btn-primary"
                                                    onclick="showInputField(this, {{$item->kuota_tiket ?? 'null'}}, {{$item->id}}, {{$item->harga_tiket ?? 'null'}}, '{{$item->nama_tiket}}')">Masukan Jumlah</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <button class="float-end btn btn-primary">Pesan Sekarang</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-settings">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                @foreach ($dataFR as $fr)
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <a href="{{route('detailFundRaising', $fr->nama_kegiatan)}}">
                                            <img src="{{asset('storage/'.$fr->thumbnail_donasi)}}"
                                                class="bd-placeholder-img card-img-top" width="100%" height="225">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script>
    function showInputField(button, maxQuantity, idTiket, hargaTiket, namaTiket) {
        var parent = button.parentNode;
        if (hargaTiket) {
            parent.innerHTML = `
                <a onclick="decrementQuantity(this)" class="minus"><i class="fas fa-minus"></i></a>
                <input class="quantity" max="${maxQuantity}" name="quantity[]" value="1" type="number" oninput="checkZero(this)">
                <input name="id_tiket[]" value="${idTiket}" type="hidden">
                <input name="harga_tiket[]" value="${hargaTiket}" type="hidden">
                <input name="nama_tiket[]" value="${namaTiket}" type="hidden">
                <a onclick="incrementQuantity(this)" class="plus"><i class="fas fa-plus"></i></a>
            `;
        } else {
            parent.innerHTML = `
                <input type="text" class="form-control rupiah" name="harga_tiket[]" placeholder="Masukan Seikhlasnya" oninput="formatRupiah(this)">
                <input name="id_tiket[]" value="${idTiket}" type="hidden">
                <input max="${maxQuantity}" name="quantity[]" value="1" type="hidden">
                <input name="nama_tiket[]" value="${namaTiket}" type="hidden">
            `;
        }
    }

    function formatRupiah(input) {
        var value = input.value.replace(/[^,\d]/g, '').toString();
        var split = value.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = rupiah ? rupiah : '';
    }

    function checkZero(input) {
        if (input.value == 0) {
            var maxQuantity = input.max;
            var idTiket = input.nextElementSibling.value;
            var hargaTiket = input.nextElementSibling.nextElementSibling.value;
            var namaTiket = input.nextElementSibling.nextElementSibling.nextElementSibling.value;
            var parent = input.parentNode;
            parent.innerHTML =
                `<button type="button" class="btn btn-primary" onclick="showInputField(this, ${maxQuantity}, ${idTiket}, ${hargaTiket}, '${namaTiket}')">Masukan Jumlah</button>`;
        }
    }

    function decrementQuantity(element) {
        var input = element.parentNode.querySelector('input[type=number]');
        if (input) {
            input.stepDown();
            checkZero(input);
        }
    }

    function incrementQuantity(element) {
        var input = element.parentNode.querySelector('input[type=number]');
        if (input) {
            input.stepUp();
            checkZero(input);
        }
    }

</script>
<style>
    .quantity-container {
        display: flex;
        align-items: center;
    }

    .quantity-container a {
        text-decoration: none;
        padding: 0 10px;
        cursor: pointer;
    }

    .quantity-container .minus,
    .quantity-container .plus {
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        padding: 5px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-container .quantity {
        width: 50px;
        text-align: center;
    }

    input.rupiah {
        display: inline-block;
        width: calc(100% - 10px);
    }

</style>
@endpush
