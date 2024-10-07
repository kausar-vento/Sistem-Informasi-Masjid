@push('titles')
<title>Home Event</title>
@endpush

@extends('petugas.component.header')

@section('header-petugas')

<div class="card shadow mb-4">
    <div class="card py-3">
        <center>
            <h6 class="m-0 font-weight-bold text-secondary">LIST EVENT MASJID</h6>
        </center>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <a href="{{route('petugas.homeCreateEventPetugas')}}" class="btn btn-primary float-end mb-3">Tambah
                    Event</a>
                <br>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Staus Event</th>
                        <th>Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataEvent as $item) <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="
                        max-width: 140px; 
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;">{{$item->nama_event}}</td>
                        <td>{{ Carbon\Carbon::parse($item->tanggal_event)->locale('id')->translatedFormat('l, d F Y') }}
                        </td>
                        <td>{{$item->lokasi_event}}</td>
                        <td>{{$item->status_event}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('petugas.homeTiketEvent', $item->id)}}">Cek
                                Tiket</a>
                            <a class="btn btn-secondary"
                                href="{{route('petugas.editEventPetugas', $item->id)}}">Edit</a>
                            @if ($item->status_event === 'Publish')
                            <form action="{{route('petugas.updateStatusEvent')}}" method="POST" class="d-inline">
                                @method('POST')
                                @csrf
                                <input type="hidden" name="id_event" value="{{$item->id}}">
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin Ingin Menonaktifkan Event Ini?')">Unpublish</button>
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
