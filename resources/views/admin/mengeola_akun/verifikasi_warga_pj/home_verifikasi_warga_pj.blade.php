@push('titles')
<meta http-equiv="X-UA-Compatible" content="ie=edge">
</meta>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Verifikasi Warga Asli PJ</title>
@endpush

@push('css-biasa')
<style>
    .invoice {
        margin: 20px;
    }

    .invoice-header {
        background-color: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .invoice-body {
        padding: 20px;
    }

    .company-logo {
        max-width: 150px;
    }

</style>
@endpush

@extends('admin.component.header')

@section('header-admin')


<div class="row">
    <!-- Order Statistics -->
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                            class="rounded" />
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Jumlah User / Jamaah</span>
                <h3 class="card-title mb-2">$12,628</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 200</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                            class="rounded" />
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Jumlah Petugas Masjid</span>
                <h3 class="card-title mb-2">$12,628</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 10</small>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                            class="rounded" />
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1">Jumlah Infaq Masjid</span>
                <h3 class="card-title mb-2">$12,628</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Rp.
                    450.000.000</small>
            </div>
        </div>
    </div>
    <!--/ Order Statistics -->
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan Donasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @isset($dWargaPJ)
            <table class="table table-bordered table-responsive" id="dataTable2" class="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email Pengguna</th>
                        <th>No Telephone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dWargaPJ as $item)
                    <tr>
                        <td>{{$item->nama_lengkap}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->nomor_telp}}</td>
                        <td>
                            <input type="hidden" name="" id="showId" value="{{$item->id}}">
                            <button class="btn btn-primary btnShow" data-bs-toggle="modal"
                                data-bs-target="#basicModal">Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <center>
                <h1>KOSONG</h1>
            </center>
            @endisset

        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200"
                                    class="img-fluid rounded-circle" alt="Foto User">
                            </div>
                            <div class="col-md-8">
                                <p>Nama Lengkap: <b id="getNamaWarga"></b></p>
                                <p>Email: <b id="getEmail"></b></p>
                                <p>Nomor Telphone: <b id="getNomorTelephone"></b></p>
                                <p>Jenis Kelamin: <b id="getJenisKelamin"></b></p>
                                <p>Status Warga: <b id="getStatusWarga"></b></p>
                                <p>Bukti File Pendukung:</p>
                                <img src="" class="img-fluid col-md-6" id="getFilePendukung">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" id="getId">
                        <button type="button" class="btn btn-primary" id="btnSubmit">Setuju</button>
                        <button type="button" class="btn btn-warning" id="btnGagal">Gagal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#dataTable2').DataTable();

        $(document).on('click', '.btnShow', function () {
            var idUser = $(this).siblings('#showId').val();
            console.log(idUser);
            var selectedUser = <?php echo json_encode($dAkun); ?> ;
            var selectedUserData = selectedUser.find(function (item) {
                return item.id == idUser;
            });
            $('#getNamaWarga').text(selectedUserData.nama_lengkap);
            $('#getEmail').text(selectedUserData.email);
            $('#getNomorTelephone').text(selectedUserData.nomor_telp);
            $('#getJenisKelamin').text(selectedUserData.jenis_kelamin);
            $('#getStatusWarga').text(selectedUserData.status_warga);
            $('#getId').attr('value', idUser);
            $('#getFilePendukung').attr('src', '{{asset("storage/")}}/' + selectedUserData.bukti_status_warga);
        });

        $('#btnSubmit').click(function () {
            var idUpdate = $('#getId').val();
            // console.log(idUpdate, 'test');
            $.ajax({
                url: `/admin/manage-acount/warga-pj/verifikasi/update/${idUpdate}`,
                type: "PUT",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    window.location.href =
                        "{{route('successVerifikasiWargaPJ')}}";
                },
                error: function (error) {
                    if (error.responseJSON && error.responseJSON
                        .errors) {
                        console.log(error);
                    } else {
                        console.log('tidak ada error');
                    }
                },
            });
        });

    });

</script>
@endpush
