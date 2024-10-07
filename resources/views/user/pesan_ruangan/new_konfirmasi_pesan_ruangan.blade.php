@push('titles')
<title>Konfirmasi Pesanan Ruangan</title>
@endpush
@extends('user.component.header')
@section('navbar-user')
<div class="pagetitle">
    <h1>Konfirmasi Pesanan Ruangan</h1>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<section class="section">
    <!-- Default Card -->
    <div class="card">
        <div class="card-body">
            <center>
                <h5 class="card-title">DETAIL PEMESANAN</h5>
            </center>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tanggal Sewa</th>
                        <th scope="col">Waktu Sewa</th>
                        <th scope="col">Jumlah Peserta</th>
                        <th scope="col">Tipe Acara</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$data->tanggal_mulai}}</td>
                        <td>{{$data->jam_mulai}} - {{$data->jam_selesai}}</td>
                        <td>{{$data->jumlah_peserta}}</td>
                        <td>
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                {{$data->tipe_acara}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Ruangan</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $dataR = json_decode($data->data_ruangan);
                    $totalKeseluruhan = 0;
                    @endphp
                    @foreach ($dataR as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            <ul>
                                @php
                                // Decode the JSON string into an array
                                $fasilitasArray = json_decode($item->fasilitas, true);
                                $totalKeseluruhan += (int)$item->total_harga;
                                @endphp
                                @if (is_array($fasilitasArray))
                                @foreach ($fasilitasArray as $fasilitas)
                                <li>
                                    {{$fasilitas}}
                                </li>
                                @endforeach
                                @else
                                <li>No Fasilitas</li>
                                @endif
                            </ul>
                        </td>
                        <td>@harga($item->total_harga)</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h4>Total Keseluruhan Adalah: <strong>@harga($totalKeseluruhan)</strong></h4>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Tata Cara Pemesanan</h5>
                    <div class="form-floating">
                        <ul>
                            <li>Setelah Melakukan Pemesanan, maka anda akan mengirimkan pesan otomatis kepada admin</li>
                            <li>lalu admin akan melakukan verifikasi pesanan</li>
                            <li>jika pesanan berhasil diverifikasi oleh admin, maka anda bisa lansung melakukan proses
                                pembayaran</li>
                        </ul>
                    </div>
                </div>
            </div>
            <form action="#" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-warning" type="submit"
                    onclick="return confirm('Apakah anda yakin ingin membatalkan pesanan ini?')">
                    <i class="bi bi-trash-fill"></i>
                    Delete</button>
            </form>
            <form action="{{route('prosesKonfirmasiPesananRuanganNew', $data->id)}}" method="POST" class="d-inline">
                @method('PUT')
                @csrf
                <button class="btn btn-success" type="submit"
                    onclick="return confirm('Apakah anda yakin ingin melanjutkan pesanan ini?')">
                    <i class="bi bi-bookmark-heart"></i>
                    Pesan Sekarang</button>
            </form>
            {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showInput">
                <i class="bi bi-book-half"></i> Edit Pesanan
            </button> --}}
            <br>
        </div>
    </div><!-- End Default Card -->
</section>
@endsection
@push('scripts')
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
@endpush
