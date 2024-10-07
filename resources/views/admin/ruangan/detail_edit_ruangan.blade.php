@push('titles')
<title>Edit atau Show Ruangan</title>
@endpush
@extends('admin.component.header')

@section('header-admin')
<div class="row">
    <!-- Basic with Icons -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit atau Detail Ruangan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('updateRuanganSewa', $ruangan->id)}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama Ruangan</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" name="nama_ruangan"
                                    id="basic-icon-default-fullname" value="{{$ruangan->nama_ruangan}}"
                                    aria-describedby="basic-icon-default-fullname2" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Harga Ruangan</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i
                                        class="bx bx-buildings"></i></span>
                                <input type="number" id="basic-icon-default-company" class="form-control"
                                    value="{{$ruangan->harga_ruangan}}" name="harga_ruangan"
                                    aria-describedby="basic-icon-default-company2" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Deskripsi
                            Ruangan</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="deskripsi_ruangan" name="deskripsi_ruangan" class="form-control"
                                value="{{old('deskripsi_ruangan', $ruangan->deskripsi_ruangan)}}" />
                            <trix-editor input="deskripsi_ruangan" id="basic-icon-default-company" class="form-control"
                                aria-describedby="basic-icon-default-company2"></trix-editor>
                        </div>
                    </div>

                    <div id="image-inputs-container">
                        @php
                        $gr = json_decode($ruangan->gambar_ruangan, true);
                        @endphp
                        @foreach ($gr as $item => $key)
                        <div class="row mb-3 image-input-group">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Gambar Ruangan Masjid
                                {{$item + 1}}</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="hidden" name="oldImage[]" value="{{$key}}">
                                    <input type="file" name="gambar_ruangan[]" class="form-control"
                                        aria-describedby="basic-icon-default-email2" onchange="previewImage(this)" />
                                    <button class="btn btn-danger" type="button"
                                        onclick="removeImageInput(this)">Hapus</button>
                                </div>
                                <img src="{{asset('storage/'.$key)}}" class="img-preview img-fluid mt-3 mb-3 col-sm-5">
                                <br>
                                <small>File Yang Bisa Diupload: JPG, JPEG, PNG Max Size: 5Mb</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="btn btn-primary mb-3 float-end" type="button" onclick="addImageInput()">Tambah
                        Gambar</button>
                        <br>
                        <br>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-success" href="{{route('homeRuanganSewa')}}">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function addImageInput() {
        const container = document.querySelector('#image-inputs-container');
        const index = container.children.length + 1;

        const div = document.createElement('div');
        div.classList.add('row', 'mb-3', 'image-input-group');

        div.innerHTML = `
            <label class="col-sm-2 col-form-label">Gambar Ruangan Masjid ${index}</label>
            <div class="col-sm-10">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                    <input type="file" name="gambar_ruangan[]" class="form-control" onchange="previewImage(this)" />
                    <button class="btn btn-danger" type="button" onclick="removeImageInput(this)">Hapus</button>
                </div>
                <small>File Yang Bisa Diupload: JPG, JPEG, PNG Max Size: 5Mb</small>
                <img class="img-preview img-fluid mt-3 mb-3 col-sm-5">
            </div>
        `;

        container.appendChild(div);
    }

    function removeImageInput(button) {
        const container = document.querySelector('#image-inputs-container');
        button.closest('.image-input-group').remove();

        // Refresh preview images
        container.querySelectorAll('.image-input-group').forEach((group, index) => {
            group.querySelector('label').textContent = `Gambar Ruangan Masjid ${index + 1}`;
        });
    }

    function previewImage(input) {
        const imgPreview = input.closest('.image-input-group').querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(input.files[0]);

        ofReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>
@endpush
