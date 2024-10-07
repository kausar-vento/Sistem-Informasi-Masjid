@extends('petugas.component.header')

@section('header-petugas')

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <br>
                <thead>
                    <tr>
                        <th>No Petugas</th>
                        <th>Nama Jamaah</th>
                        <th>Tanggal Upgrade Jamaah</th>
                        <th>Status Warga</th>
                        <th>Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++) <tr>
                        <td>Tiger Nixon{{$i}}</td>
                        <td>System Architect{{$i}}</td>
                        <td>Edinburgh{{$i}}</td>
                        <td>
                            <button class="btn btn-primary">Warga PJ</button>    
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{route('detailJamaah')}}">Cek Selengkapnya</a>
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
