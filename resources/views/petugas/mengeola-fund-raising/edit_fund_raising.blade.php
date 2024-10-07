@push('titles')
<title>Edit Fund Raising</title>
@endpush

@extends('petugas.component.header')

@section('header-petugas')

<div class="card shadow mb-4">
    <div class="card py-3">
        <div class="row">
            <div class="col-md-4">
                <div class="float-left">
                    <a class="dropdown-item" href="{{route('petugas.homeFundR')}}">
                        <i class="fas fa-arrow-alt-circle-left fa-sm fa-fw mr-2 text-gray-400"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-secondary">FORM EDIT FUND RAISING</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('petugas.updateFundRaising', $getFR->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Nama Penggalangan</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_kegiatan" class="form-control" id=""
                        value="{{old('nama_kegiatan', $getFR->nama_kegiatan)}}">
                    @error('nama_kegiatan')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Detail Penggalangan</label>
                <div class="col-sm-10">
                    <input id="detail_donasi" type="hidden" name="detail_donasi"
                        value="{{old('detail_donasi', $getFR->detail_donasi)}}">
                    <trix-editor input="detail_donasi"></trix-editor>
                    @error('detail_donasi')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Rincian Dana Digunakan</label>
                <div class="col-sm-10">
                    <input id="rincian_dana" type="hidden" name="rincian_dana"
                        value="{{old('rincian_dana', $getFR->rincian_dana)}}">
                    <trix-editor input="rincian_dana"></trix-editor>
                    @error('rincian_dana')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail Event</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" name="thumbnail_donasi" class="custom-file-input" id="thumbnail"
                            onchange="previewImage()">
                        <input type="hidden" name="oldImage" value="{{$getFR->thumbnail_donasi}}">
                        <label class="custom-file-label" for="thumbnail">Choose file...</label>
                    </div>
                    @error('thumbnail_donasi')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    @if ($getFR->thumbnail_donasi)
                    <img src="{{asset('storage/'.$getFR->thumbnail_donasi)}}"
                        class="img-preview img-fluid mt-3 mb-3 col-sm-5">
                    @else
                    <img class="img-preview img-fluid mt-3 mb-3 col-sm-5">
                    @endif
                    <img class="img-preview img-fluid mt-3 mb-3 col-sm-5">
                </div>
            </div>
            <button class="btn btn-primary float-right" type="submit">Simpan</button>
        </form>
    </div>
</div>

<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js')}}"></script>
<script>
    function previewImage() {
        const image = document.querySelector('#thumbnail');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>

@endsection
