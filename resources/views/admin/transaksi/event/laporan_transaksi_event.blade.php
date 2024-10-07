@push('titles')
<title>Daftar Transaksi Event</title>
@endpush
@extends('admin.component.header')
@section('header-admin')

<div class="card">
    <h5 class="card-header">Daftar Transaksi</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Transaksi Event</th>
                    <th>Donasi</th>
                    <th>Total Keseluruhan</th>
                    <th>Tangal Pembelian</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($getTransaksiEvent as $item)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->user->nama_lengkap}}</strong></td>
                    @php
                        $nominalAsli = $item->total_harga - $item->infaq_masjid
                    @endphp
                    <td>@harga($nominalAsli)</td>
                    <td>@harga($item->infaq_masjid)</td>
                    <td>@harga($item->total_harga)</td>
                    <td><span class="badge bg-label-primary me-1">{{Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d M Y')}}  </span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
