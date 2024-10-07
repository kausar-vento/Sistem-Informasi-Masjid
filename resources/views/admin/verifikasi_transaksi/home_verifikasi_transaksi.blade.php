@push('titles')
<meta http-equiv="X-UA-Compatible" content="ie=edge">
</meta>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Home Verifikasi Transaksi User</title>
@endpush
@extends('admin.component.header')

@section('header-admin')
@if (session()->has('success'))
<div class="alert alert-info alert-dismissible" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pesanan Ruangan User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" class="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Transaksi</th>
                        <th>Nama Pemesan</th>
                        <th>Total Harga Transaksi</th>
                        <th>Infaq</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataTRAll as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @if ($item->id_pesan_ruangan != null)
                                Pesan Ruangan
                            @elseif($item->id_fund_raising != null)
                                Fund Raising
                            @else
                                Event Masjid
                            @endif
                        </td>
                        <td>{{$item->user->nama_lengkap}}</td>
                        <td>@harga($item->total_harga - $item->infaq_masjid)</td>
                        <td>@harga($item->infaq_masjid)</td>
                        <td>{{$item->status_pembayaran}}</td>
                        <td>
                            <form action="{{route('prosesAprovelTransaksi', $item->id)}}" method="post" class="d-inline">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-primary" type="submit">Aprovel</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
