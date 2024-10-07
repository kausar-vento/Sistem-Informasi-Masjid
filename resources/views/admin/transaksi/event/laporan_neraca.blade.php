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
                    <th>Rekening Tujuan</th>
                    <th>Saldo Sebelumnya</th>
                    <th>Nominal</th>
                    <th>Saldo Sesudahnya</th>
                    <th>Jenis Aktivitas</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($getNeraca as $item)
                <tr>
                    <td>{{$item->rekening_tujuan}}</td>
                    <td>@harga($item->saldo_sebelumnya)</td>
                    <td>@harga($item->nominal)</td>
                    <td>@harga($item->saldo_sesudahnya)</td>
                    <td>
                        <span class="badge rounded-pill bg-primary">{{$item->jenis_aktivitas_admin}}</span>
                    </td>
                    <td>@tanggal($item->created_at)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
