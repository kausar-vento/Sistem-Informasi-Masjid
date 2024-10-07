@push('titles')
<title>Daftar Transaksi Pesan Ruangan</title>
@endpush
@extends('admin.component.header')
@section('header-admin')
<div class="card">
    <h5 class="card-header">Transaksi Terakhir</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Nama Ruangan</th>
                    <th>Tanggal Sewa</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($dataTransaksiPR as $item)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>{{$item->user->nama_lengkap}}</td>
                    <td>{{$item->pesanruangan->ruangan->nama_ruangan}}</td>
                    <td>{{$item->pesanruangan->tanggal_mulai}}</td>
                    <td>@harga($item->pesanruangan->ruangan->harga_ruangan)</td>
                    <td>
                        <span class="badge rounded-pill bg-primary">{{$item->status_pembayaran}}</span>
                        {{-- <badge class="bg bg-primary"></badge> --}}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($item->pesanruangan->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
