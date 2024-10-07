@extends('petugas.component.header')

@section('header-petugas')

<div class="card shadow mb-4">
    <div class="card py-3">
        <center>
            <h6 class="m-0 font-weight-bold text-secondary">LIST EVENT YANG SEGERA HADIR</h6>
        </center>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <br>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++) <tr>
                        <td>Tiger Nixon{{$i}}</td>
                        <td>System Architect{{$i}}</td>
                        <td>Edinburgh{{$i}}</td>
                        <td>61{{$i}}</td>
                        <td>
                            <a class="btn btn-secondary" href="{{route('homeDetailUserEvent')}}">Detail</a>
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
