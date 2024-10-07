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
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Donasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <svg class="bd-placeholder-img card-img-top" width="40" height="40"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em"></text>
                            </svg>
                        </td>
                        <td>Suranto</td>
                        <td>2024-02-18</td>
                        <td>Rp. 4.000.000</td>
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
