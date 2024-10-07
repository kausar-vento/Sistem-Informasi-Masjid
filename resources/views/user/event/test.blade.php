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
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Doa dan Dukungan</h5>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Address" id="floatingTextarea"
                            style="height: 100px;"></textarea>
                        <label for="floatingTextarea">Opsional</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="card-title">Infaq Untuk Masjid</h6>
                    <div class="col-md-10">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Address" id="floatingTextarea"
                                style="height: 100px;"></textarea>
                            <label for="floatingTextarea">Opsional</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Bayar Sekarang</button>
        </div>
    </div><!-- End Default Card -->

</section>


@endsection
