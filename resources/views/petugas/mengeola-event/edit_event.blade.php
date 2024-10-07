@push('titles')
<title>Edit Event</title>
@endpush

@extends('petugas.component.header')

@section('header-petugas')

<div class="card shadow mb-4">
    <div class="card py-3">
        <div class="row">
            <div class="col-md-4">
                <div class="float-left">
                    <a class="dropdown-item" href="{{route('petugas.homeEventPetugas')}}">
                        <i class="fas fa-arrow-alt-circle-left fa-sm fa-fw mr-2 text-gray-400"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <h6 class="m-0 font-weight-bold text-secondary">FORM EDIT EVENT MASJID</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('petugas.updateEventPetugas', $getEvent->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Nama Event</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_event" class="form-control" id="" value="{{old('nama_event', $getEvent->nama_event)}}">
                    @error('nama_event')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Detail Event</label>
                <div class="col-sm-10">
                    <input id="detail_event" type="hidden" name="detail_event" value="{{old('detail_event', $getEvent->detail_event)}}">
                    <trix-editor input="detail_event"></trix-editor>
                    @error('detail_event')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Pilih Peserta Event</label>
                <div class="col-sm-10">
                    <select class="form-control" id="exampleFormControlSelect1" name="peserta_event">
                        <option>Chose</option>
                        <option value="Umum" {{old('peserta_event', $getEvent->peserta_event) == 'Umum' ? 'selected' : ''}}>Umum</option>
                        <option value="Pria" {{old('peserta_event', $getEvent->peserta_event) == 'Pria' ? 'selected' : ''}}>Pria</option>
                        <option value="Wanita" {{old('peserta_event', $getEvent->peserta_event) == 'Wanita' ? 'selected' : ''}}>Wanita</option>
                    </select>
                    @error('peserta_event')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="location" class="col-sm-2 col-form-label">Pilih Lokasi Event</label>
                <div class="col-sm-10">
                    <select class="form-control" id="location" name="lokasi_event" onchange="pilihLokasi()">
                        <option>Chose</option>
                        <option value="Masjid" {{old('lokasi_event', $getEvent->lokasi_event) == 'Masjid' ? 'selected' : ''}}>Dalam Masjid
                        </option>
                        <option value="Luar Masjid" {{old('lokasi_event', $getEvent->lokasi_event) == 'Luar Masjid' ? 'selected' : ''}}>Luar
                            Masjid</option>
                    </select>
                    @error('lokasi_event')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
            <div id="selectRuangan" class="mb-3 row" style="display: none;">
                <label for="ruangMasjid" class="col-sm-2 col-form-label">Ruangan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="ruangMasjid" aria-label="Default select example" name="id_ruangan">
                        <option selected>Open this select menu</option>
                        @foreach ($dataRuangan as $item)
                        <option value="{{$item->id}}" {{ old('id_ruangan', $getEvent->id_ruangan) == '$item->id' ? 'selected' : '' }}>{{$item->nama_ruangan}}</option>
                        @endforeach
                    </select>
                    @error('id_ruangan')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row" style="display: none" id="lokasiLuar">
                <label for="" class="col-sm-2 col-form-label">Lokasi Luar Masjid</label>
                <div class="col-sm-10">
                    <input id="lokasi_luar_masjid" type="hidden" name="lokasi_luar_masjid"
                        value="{{old('lokasi_luar_masjid', $getEvent->lokasi_luar_masjid)}}">
                    <trix-editor input="lokasi_luar_masjid"></trix-editor>
                    @error('lokasi_luar_masjid')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Tanggal Event</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_event" class="form-control" id="" value="{{old('tanggal_event', $getEvent->tanggal_event)}}">
                    @error('tanggal_event')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label for="" class="col-sm-4 col-form-label">Jam Mulai</label>
                        <div class="col-sm-8">
                            <input type="time" name="jam_mulai" class="form-control" id="" value="{{old('jam_mulai', $getEvent->jam_mulai)}}">
                            @error('jam_mulai')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label for="" class="col-sm-4 col-form-label">Jam Selesai</label>
                        <div class="col-sm-8">
                            <input type="time" name="jam_selesai" class="form-control" id=""
                                value="{{old('jam_selesai', $getEvent->jam_selesai)}}">
                            @error('jam_selesai')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Tamu Acara</label>
                <div class="col-sm-10">
                    @php
                        $tamuAcara = old('tamu_acara', json_decode($getEvent->tamu_acara, true));
                    @endphp
                    
                    @if(is_array($tamuAcara))
                        @foreach($tamuAcara as $index => $value)
                            <div class="uTada">
                                <input type="text" name="tamu_acara[]" class="form-control mt-2" value="{{ $value }}">
                                @error('tamu_acara.' . $index)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                    @else
                        <input type="text" name="tamu_acara[]" class="form-control" value="">
                        @error('tamu_acara.*')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    @endif
                    <div class="uTada-container"></div>
                    <button class="btn btn-outline-success addPengisi mt-2" type="button">Add</button>
                </div>
            </div>
            
            <div class="row">
                <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail Event</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail"
                            onchange="previewImage()">
                        <input type="hidden" name="oldImage" value="{{$getEvent->thumbnail}}">
                        <label class="custom-file-label" for="thumbnail">Choose file...</label>
                    </div>
                    @error('thumbnail')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    @if ($getEvent->thumbnail)
                        <img src="{{asset('storage/'.$getEvent->thumbnail)}}" class="img-preview img-fluid mt-3 mb-3 col-sm-5">
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

    function pilihLokasi() {
        var selectLokasi = document.getElementById('location');
        var showRuangMasjid = document.getElementById('selectRuangan');
        var showLuarMasjid = document.getElementById('lokasiLuar');

        if (selectLokasi.value === 'Masjid') {
            showRuangMasjid.style.display = 'flex';
            showLuarMasjid.style.display = 'none';
        } else if (selectLokasi.value === 'Luar Masjid') {
            showRuangMasjid.style.display = 'none';
            showLuarMasjid.style.display = 'flex';
        }
    }

    $('.addPengisi').on('click', function () {
        pengisiAcara();
    });

    function pengisiAcara() {
        var ustad = `
            <div class="uTada">
                <input type="text" name="tamu_acara[]" class="form-control mt-2" value="{{old('tamu_acara.*')}}">
                @error('tamu_acara.*')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>`;
        $('.uTada-container').append(ustad);
    }
</script>

@endsection
