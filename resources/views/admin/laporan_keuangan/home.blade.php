@push('titles')
    <title>Laporan Keuangan Admin</title>
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
                <h3 class="card-title mb-2">{{$getUser}}</h3>
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
                <span class="fw-semibold d-block mb-1">Jumlah Keseluruhan Uang Masjid</span>
                <h3 class="card-title mb-2">@harga($getTotalHarga)</h3>
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
                <h3 class="card-title mb-2">@harga($getInfaq)</h3>
            </div>
        </div>
    </div>
    <!--/ Order Statistics -->
</div>

<div class="card">
    <h5 class="card-header">Transaksi Terakhir</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Transaksi</th>
                    <th>Item</th>
                    <th>Users</th>
                    <th>Total Harga</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($allTransaksi as $item)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>
                            @if ($item->id_pesan_ruangan != null)
                            Pesan Ruangan
                            @elseif ($item->id_boking_event != null)
                            Event Masjid
                            @elseif($item->id_fund_raising != null)
                            Fund Raising
                            @endif
                        </strong></td>
                    <td>
                        @if ($item->id_pesan_ruangan != null)
                        Pesan Ruangan
                        @elseif ($item->id_boking_event != null)
                        {{$item->event->nama_event}}
                        @elseif($item->id_fund_raising != null)
                        Fund Raising
                        @endif
                    </td>
                    <td>
                        {{$item->user->nama_lengkap}}
                    </td>
                    <td><span class="badge bg-label-primary me-1">@harga($item->total_harga)</span></td>
                    <td>
                        {{-- <a href="{{route('detailLaporanKeuangan')}}"> --}}
                        <a href="#">
                            <badge type="button" class="btn btn-primary">
                                <span class="tf-icons bx bx-data"></span>&nbsp; Detail
                            </badge>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
