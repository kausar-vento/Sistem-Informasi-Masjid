@extends('petugas.component.header')

@section('header-petugas')

<div class="card shadow mb-4">
    <div class="card py-3">
        <center>
            <h6 class="m-0 font-weight-bold text-secondary">LIST JAMAAH YANG AKAN MENGIKUTI EVENT</h6>
        </center>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTableCheck" width="100%" cellspacing="0">
                <br>
                <thead>
                    <tr>
                        <th>
                            
                        </th>
                        <th>Nama Jamaah</th>
                        <th>Nomor HP</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++) <tr>
                        <td>
                            <input type="checkbox" name="id_karyawan[]"
                                    class="form-check-input ml-5" id="exampleCheck1">
                        </td>
                        <td>System Architect{{$i}}</td>
                        <td>Edinburgh{{$i}}</td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
