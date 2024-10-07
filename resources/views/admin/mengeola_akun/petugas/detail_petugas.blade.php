@push('titles')
<title>Menu Detail dan Edit Petugas Masjid</title>
@endpush
@extends('admin.component.header')

@section('header-admin')

<div class="container-xxl flex-grow-1 container-p-y">
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

    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <center>
                        <h5 class="mb-0">Form Detail Petugas</h5>
                    </center>
                    <small class="text-muted float-end">Default label</small>
                </div>
                <div class="card-body">
                    <form action="{{route('updatePetugasMasjid', $data->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Petugas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama_petugas') is-invalid @enderror"
                                    id="basic-default-name" name="nama_petugas" placeholder="Masukan nama petugas"
                                    value="{{old('nama_petugas', $data->nama_petugas)}}" />
                                @error('nama_petugas')
                                <div class="form-text text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Alamat Petugas</label>
                            <div class="col-sm-10">
                                <input id="alamat_petugas" type="hidden" name="alamat_petugas"
                                    class="@error('alamat_petugas') is-invalid @enderror"
                                    value="{{old('alamat_petugas', $data->alamat_petugas)}}">
                                <trix-editor placeholder="Masukan alamat petugas" input="alamat_petugas"></trix-editor>
                                @error('alamat_petugas')
                                <div class="form-text text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username"
                                    class="form-control phone-mask @error('username') is-invalid @enderror"
                                    placeholder="Masukan username untuk petugas" value="{{old('username', $data->username)}}" />
                                @error('username')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Password</label>
                            <div class="col-sm-10">
                                <input type="text" name="password"
                                    class="form-control phone-mask @error('password') is-invalid @enderror"
                                    placeholder="Masukan password untuk petugas" value="{{old('password', $data->password)}}"/>
                                @error('password')
                                <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Status Petugas</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <select class="form-select" id="exampleFormControlSelect1" name="status_petugas"
                                        aria-label="Default select example">
                                        @if ($data->status_petugas === 'Active')
                                            <option selected value="{{$data->status_petugas}}">{{$data->status_petugas}}</option>
                                            <option value="Non Active">Non Active</option>
                                        @elseif($data->status_petugas === 'Non Active')
                                            <option value="Active">Active</option>
                                            <option selected value="{{$data->status_petugas}}">{{$data->status_petugas}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-text">You can use letters, numbers & periods</div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a class="btn btn-dark" href="{{route('homeManagePetugas')}}">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
