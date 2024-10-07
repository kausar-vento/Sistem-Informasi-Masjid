@push('titles')
    <title>Fund Raising</title>
@endpush
@extends('petugas.component.header')

@section('header-petugas')

<div class="card shadow mb-4">
    <div class="card py-3">
        <center>
            <h6 class="m-0 font-weight-bold text-secondary">LIST FUND RAISING</h6>
        </center>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <a href="{{route('petugas.createFundR')}}" class="btn btn-primary mb-3">Tambah Donasi</a>
                <br>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Kegiatan</th>
                        <th>Status Donasi</th>
                        <th>Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataFR as $item) <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->status_donasi}}</td>
                        <td>
                            <a href="{{route('petugas.tiketFundRaising', $item->nama_kegiatan)}}" class="btn btn-primary">Cek Tiket</a>
                            <a href="{{route('petugas.editFundRaising', $item->id)}}" class="btn btn-warning">Edit</a>
                            @if ($item->status_donasi === 'Publish')
                            <form action="{{route('petugas.updtaeStatusFR')}}" method="POST" class="d-inline">
                                @method('POST')
                                @csrf
                                <input type="hidden" name="id_fund_raising" value="{{$item->id}}">
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin Ingin Menonaktifkan Donasi Ini?')">Unpublish</button>
                            </form>
                            @endif
                        </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
</div>
@endif
@endsection
