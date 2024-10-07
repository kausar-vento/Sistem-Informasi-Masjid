<table class="table">
    <thead>
        <tr>
            <th scope="col">Nama Event</th>
            <th scope="col">Tanggal Event</th>
            <th scope="col">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$getTransaksi->event->nama_event ?? 'lel'}}</td>
            <td>{{$getTransaksi->event->tanggal_event ?? 'lal'}}</td>
            <td>@harga($getTransaksi->total_harga)</td>
        </tr>
    </tbody>
</table>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Nama Tiket</th>
            <th scope="col">Harga Tiket</th>
            <th scope="col">Qty</th>
        </tr>
    </thead>
    <tbody>
        @php
        $getTicket = json_decode($getTransaksi->item_details, true);
        @endphp
        @foreach ($getTicket as $key => $ticket)
        <tr>
            <td>{{$ticket['name']}}</td>
            <td>@harga($ticket['price'])</td>
            <td>{{$ticket['quantity']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{route('prosesPembayaranEvent')}}" method="POST">
    @csrf
    <div class="row">
        <input type="hidden" name="id_transaksi" value="{{$getTransaksi->id}}">
        <input type="hidden" name="infaq_masjid" value=null>
        <div class="col-md-6">
            <h5 class="card-title">Infaq Masjid</h5>
            <div class="form-floating">
                <div class="row">
                    <div class="col-md-4 listHarga">
                        <input type="checkbox" class="btn-check" name="infaq_masjid" id="success-outlined"
                            autocomplete="off" value="10000">
                        <label style="border: 2px solid" class="btn btn-outline-secondary" for="success-outlined">Rp.
                            10.000</label>
                    </div>
                    <div class="col-md-4 listHarga">
                        <input type="checkbox" class="btn-check" name="infaq_masjid" id="danger-outlined"
                            autocomplete="off" value="20000">
                        <label style="border: 2px solid" class="btn btn-outline-secondary" for="danger-outlined">Rp.
                            20.000</label>
                    </div>
                    <div class="col-md-4 listHarga">
                        <input type="checkbox" class="btn-check" name="infaq_masjid" id="nein" autocomplete="off"
                            value="50000">
                        <label style="border: 2px solid" class="btn btn-outline-secondary" for="nein">Rp.
                            50.000</label>
                    </div>
                    <div class="col-md-4 listHarga mt-3">
                        <input type="checkbox" class="btn-check" name="infaq_masjid" id="nope" autocomplete="off"
                            value="100000">
                        <label style="border: 2px solid" class="btn btn-outline-secondary" for="nope">Rp.
                            100.000</label>
                    </div>
                    <div class="col-md-4 listHarga mt-3">
                        <input type="checkbox" class="btn-check" name="infaq_masjid" id="nah" autocomplete="off"
                            value="200000">
                        <label style="border: 2px solid" class="btn btn-outline-secondary" for="nah">Rp.
                            200.000</label>
                    </div>
                    <div class="col-md-4 listHarga mt-3">
                        <input type="checkbox" class="btn-check" name="infaq_masjid" id="wok" autocomplete="off"
                            value="500000">
                        <label style="border: 2px solid" class="btn btn-outline-secondary" for="wok">Rp.
                            500.000</label>
                    </div>
                    <div class="col-md-4 listHarga mt-3">
                        <input type="checkbox" class="btn-check" id="sui" autocomplete="off">
                        <label style="border: 2px solid" class="btn btn-outline-secondary" for="sui">Nominal
                            Lainya</label>
                    </div>
                </div>
                <div class="mt-3" style="display: none;" id="customHarga">
                    <input type="number" style="border: 1px solid;" name="custom_infaq_masjid"
                        class=" form-control shadow bg-body rounded" id="inputHarga" placeholder="Minimal Rp. 10.000">
                </div>
                <small>Infaq masjid opsional, anda bisa kosongkan</small>
                @error('custom_infaq_masjid')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
            </div>
        </div>
        <div class="col-md-6">
            <h6 class="card-title">Keterangan</h6>
            <div class="col-md-10">
                <div class="form-floating">
                    <input id="keterangan" type="hidden" name="keterangan" value="{{old('keterangan')}}">
                    <trix-editor input="keterangan" placeholder="Opsional, anda bisa kosongkan">
                    </trix-editor>
                    {{-- <textarea class="form-control" placeholder="Address" name="keterangan"
                        id="floatingTextarea" style="height: 100px;"></textarea> --}}
                    {{-- <label for="floatingTextarea">Opsional, anda bisa kosongkan</label> --}}
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="btn btn-primary" type="submit">Konfirmasi
        Pembayaran</button>
    <a class="btn btn-danger" href="{{route('keranjang')}}">Kembali</a>
</form>
