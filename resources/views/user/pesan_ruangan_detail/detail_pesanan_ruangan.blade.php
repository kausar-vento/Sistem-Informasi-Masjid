@push('titles')
<title>Detail Pesanan Ruangan</title>
@endpush
@extends('user.component.header')

@section('navbar-user')
<style>
    .carousel-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .selected {
        border: 2px solid green;
        border-radius: 5px;
        padding: 10px;
        background-color: #eaf4e7;
    }

</style>

<div class="pagetitle">
    <h1>Detail Pemesanan Untuk: <b>@tanggal($dataPesanan->tanggal_mulai)</b>
    </h1>
</div>
<section class="section">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card mb-3">
            <div class="card-body">
                <br>
                <div class="row g-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                name="jam_mulai" id="jam_mulai" value="{{$dataPesanan->jam_mulai}}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                name="jam_selesai" id="jam_selesai" value="{{$dataPesanan->jam_selesai}}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                            <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                name="jumlah_peserta" id="jumlah_peserta" value="{{$dataPesanan->jumlah_peserta}}"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="file_pendukung" class="form-label">Bukti File Pendukung</label>
                        <input type="file" accept=".png, .jpg, .jpeg"
                            class="form-control @error('file_pendukung') is-invalid @enderror" name="file_pendukung"
                            id="file_pendukung" onchange="previewImage()" disabled>
                        <img class="img-preview img-fluid mt-3 mb-3 col-sm-5"
                            src="{{asset('storage/'.$dataPesanan->file_pendukung)}}" alt="">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Kebutuhan Penyewa</label>
                        <input id="kebutuhan_penyewa" class="@error('kebutuhan_penyewa') is-invalid @enderror"
                            type="hidden" name="kebutuhan_penyewa" value="{{$dataPesanan->kebutuhan_penyewa}}">
                        <trix-editor input="kebutuhan_penyewa"></trix-editor>
                    </div>
                </div>
            </div>
        </div>

        <center>
            <h1 class="card-title">Ruangan Masjid Yang Dipilih</h1>
        </center>
        @php
        $getRuangan = json_decode($dataPesanan->data_ruangan);
        @endphp
        <div id="ruangan-container">
            @foreach ($getRuangan as $key => $valueDR)
            @foreach ($dataRuangan as $key2 => $item)
            @if ($valueDR->id == $item->id)
            <div class="row mb-3 ruangan-item" id="ruangan{{$key2}}" data-dipilih="false">
                <div class="col-lg-6">
                    <div id="carouselExampleControls{{$key2}}" class="carousel slide">
                        <div class="carousel-inner">
                            @php
                            $gambar = json_decode($item->gambar_ruangan);
                            @endphp
                            @foreach ($gambar as $key22 => $item2)
                            <div class="carousel-item @if($key22 == 0) active @endif profile-card pt-4">
                                <img src="{{asset('storage/'.$item2)}}" class="d-block w-100 carousel-image" alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleControls{{$key2}}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleControls{{$key2}}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->nama_ruangan}}</h5>
                            <div>
                                {!!$item->deskripsi_ruangan!!}
                            </div>
                            <hr>
                            <div>
                                <strong>Fasilitas: </strong>{{$valueDR->fasilitas}} <br>
                                <strong>Total Harga: </strong>@harga($valueDR->total_harga)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endforeach
        </div>
        <a href="{{route('listPesananRuangan')}}" class="btn btn-primary mt-3">Kembali</a>
    </form>
</section>
<script>
    function previewImage() {
        const image = document.querySelector('#file_pendukung');
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
