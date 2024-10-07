@extends('admin.component.header')

@push('titles')
<title>Pesan Ruangan</title>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

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
                            <a class="dropdown-item test-detail" href="javascript:void(0);">View More</a>
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
<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">List Ruangan Yang Disewakan</h5>
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalCenter">
            <i class="bx bx-book-add me-1"></i>
        </button>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi Petugas</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($dataRuangan as $item)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$loop->iteration}}</strong></td>
                    <td>{{$item->nama_ruangan}}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('detailRuanganSewa', $item->id)}}"><i
                                        class="bx bx-edit-alt me-1"></i>
                                    Detail</a>
                                <form action="{{route('deleteRuanganSewa', $item->id)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                        Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="gambar_ruangan" class="form-label">Gambar Ruangan</label>
                        <div id="image-inputs">
                            <div class="input-group">
                                <input type="file" class="form-control" name="gambar_ruangan[]" onchange="previewImages()" />
                                <button class="btn btn-danger" type="button" onclick="removeImageInput(this)">Hapus</button>
                            </div>
                            <small>File Yang Bisa Diupload: JPG, JPEG, PNG Max Size: 5Mb</small>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="addImageInput()">Tambah Gambar</button>
                        <div id="image-previews" class="img-preview img-fluid mt-3 mb-3 col-sm-5"></div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                        <input type="text" id="nama_ruangan" class="form-control" placeholder="Nama Ruangan" />
                    </div>
                    <div class="col mb-0">
                        <label for="harga_ruangan" class="form-label">Harga Ruangan</label>
                        <input type="number" id="harga_ruangan" class="form-control" placeholder="Harga Ruangan" />
                    </div>
                    <div class="col mb-0">
                        <label for="deskripsi_ruangan" class="form-label">Deskripsi Ruangan</label>
                        <input type="hidden" id="deskripsi_ruangan" class="form-control" />
                        <trix-editor input="deskripsi_ruangan"></trix-editor>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="saveBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function addImageInput() {
        const imageInputs = document.querySelector('#image-inputs');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-3';
        
        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'gambar_ruangan[]';
        input.className = 'form-control';
        input.setAttribute('onchange', 'previewImages()');

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-danger';
        button.textContent = 'Hapus';
        button.setAttribute('onclick', 'removeImageInput(this)');

        inputGroup.appendChild(input);
        inputGroup.appendChild(button);

        imageInputs.appendChild(inputGroup);
    }

    function removeImageInput(button) {
        button.parentNode.remove();
        previewImages(); // Refresh previews
    }

    function previewImages() {
        const imagePreviews = document.querySelector('#image-previews');
        imagePreviews.innerHTML = ''; // Clear existing previews

        const inputs = document.querySelectorAll('input[name="gambar_ruangan[]"]');
        inputs.forEach(input => {
            if (input.files) {
                [].forEach.call(input.files, function(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-fluid mt-3 mb-3 col-sm-5';
                        imagePreviews.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#saveBtn').click(function () {
            var formData = new FormData();

            // Menambahkan file gambar ke FormData
            $.each($('input[name="gambar_ruangan[]"]'), function(i, input) {
                $.each(input.files, function(j, file) {
                    formData.append('gambar_ruangan[]', file);
                });
            });

            // Mendapatkan nilai dari input lainnya
            var nama_ruangan = $('#nama_ruangan').val();
            var harga_ruangan = $('#harga_ruangan').val();
            var deskripsi_ruangan = $('#deskripsi_ruangan').val();

            // Menambahkan nilai dari input lainnya ke FormData
            formData.append('nama_ruangan', nama_ruangan);
            formData.append('harga_ruangan', harga_ruangan);
            formData.append('deskripsi_ruangan', deskripsi_ruangan);

            $.ajax({
                url: "{{route('simpanRuanganSewa')}}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    window.location.href = "{{route('homeRuanganSewa')}}";
                },
                error: function (error) {
                    if (error.responseJSON && error.responseJSON.errors) {
                        $('#namaRuanganError').html(error.responseJSON.errors.nama_ruangan);
                        $('#hargaRuanganError').html(error.responseJSON.errors.harga_ruangan);
                        $('#deskripsiRuanganError').html(error.responseJSON.errors.deskripsi_ruangan);
                        $('#gambarRuanganError').html(error.responseJSON.errors['gambar_ruangan.*']);
                    } else {
                        console.log('tidak ada error');
                    }
                },
            });
        });

        $('#modalCenter').on("hidden.bs.modal", function () {
            $('#saveBtn').unbind();
        });
    });
</script>
@endpush