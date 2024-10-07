@push('titles')
<title>Laporan Peserta Event</title>
@endpush
@extends('admin.component.header')
@section('header-admin')

<div class="card">
    <h5 class="card-header">Transaksi Terakhir</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Email User</th>
                    <th>Kelamin User</th>
                    <th>Total Sumbangan</th>
                    <th>Infaq Masjid</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($getTransaksiFR as $item)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->user->nama_lengkap}}</strong></td>
                    <td>{{$item->user->email}}</td>
                    <td><span class="badge bg-label-primary me-1">{{$item->user->jenis_kelamin}}</span></td>
                    <td>@harga(($item->total_harga) - ($item->infaq_masjid))</td>
                    <td>@harga($item->infaq_masjid)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
