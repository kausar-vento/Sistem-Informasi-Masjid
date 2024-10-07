@push('titles')
<title>Create Fund Raising</title>
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
                <h6 class="m-0 font-weight-bold text-secondary">FORM PEMBUATAN PENGGALANGAN DANA</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('petugas.storeFundRaising')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Nama Penggalangan</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_kegiatan" class="form-control" id="" value="{{old('nama_kegiatan')}}">
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
                    <input id="detail_donasi" type="hidden" name="detail_donasi" value="{{old('detail_donasi')}}">
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
                    <input id="rincian_dana" type="hidden" name="rincian_dana" value="{{old('rincian_dana')}}">
                    <trix-editor input="rincian_dana"></trix-editor>
                    @error('rincian_dana')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail Penggalangan</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" name="thumbnail_donasi" class="custom-file-input" id="thumbnail"
                            onchange="previewImage()">
                        <label class="custom-file-label" for="thumbnail">Choose file...</label>
                    </div>
                    @error('thumbnail_donasi')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    <img class="img-preview img-fluid mt-3 mb-3 col-sm-5">
                </div>
            </div>

            <div class="row mb-3">
                <label for="thumbnail" class="col-sm-2 col-form-label">Jenis Donasi 1</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_tiket[]" class="form-control" value="{{ old('nama_tiket.*') }}"
                        placeholder="Masukan Nama Tiket">
                    <small>Nama Tiket</small>
                    @error('nama_tiket.*')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    <div class="mt-3 mb-3 lanjutkan">
                        <input type="number" name="kuota_tiket[]" class="form-control mt-3"
                            value="{{ old('kuota_tiket.*') }}" placeholder="Masukan Jumlah Kuota Tiket">
                        <small>Kuota Tiket</small>
                        @error('kuota_tiket.*')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                        @enderror
                        <input type="text" name="harga_tiket[]" class="form-control mt-3"
                            value="{{ old('harga_tiket.*') }}" placeholder="Masukan Harga Tiket" id="customHarga">
                        <small>Harga Tiket</small>
                        @error('harga_tiket.*')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                        @enderror
                    </div>
                    <p class="mt-3"></p>
                    <input id="deskripsi_tiket_1" type="hidden" name="deskripsi_tiket[]"
                        value="{{ old('deskripsi_tiket.*') }}">
                    <trix-editor input="deskripsi_tiket_1"></trix-editor>
                    <small>Deskripsi Tiket</small>
                    @error('deskripsi_tiket.*')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    <input type="date" name="waktu_tanggal_mulai[]" class="form-control mt-3"
                        value="{{ old('waktu_tanggal_mulai.*') }}" placeholder="adsasda">
                    <small>Waktu Tanggal Mulai Tiket</small>
                    @error('waktu_tanggal_mulai.*')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    <input type="date" name="waktu_tanggal_selesai[]" class="form-control mt-3"
                        value="{{ old('waktu_tanggal_selesai.*') }}">
                    <small>Waktu Tanggal Selesai Tiket</small>
                    @error('waktu_tanggal_selesai.*')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                    <br>
                    <a class="btn btn-outline-info float-right addTicket">Tambah Tiket</a>
                </div>
            </div>
            <div class="tiketEvent">
                @if(old('nama_tiket'))
                @foreach(old('nama_tiket') as $index => $value)
                @if($index > 0)
                <div class="row mb-3">
                    <label for="thumbnail" class="col-sm-2 col-form-label">Tiket Event {{ $index + 1 }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_tiket[]" class="form-control" value="{{ $value }}"
                            placeholder="Masukan Nama Tiket">
                        <small>Nama Tiket</small>
                        @error('nama_tiket.*')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                        @enderror
                        <div class="mt-3 mb-3">
                            <input type="number" name="kuota_tiket[]" class="form-control mt-3"
                                value="{{ old('kuota_tiket.' . $index) }}" placeholder="Masukan Jumlah Kuota Tiket">
                            <small>Kuota Tiket</small>
                            <input type="text" name="harga_tiket[]" class="form-control mt-3"
                                value="{{ old('harga_tiket.' . $index) }}" placeholder="Masukan Harga Tiket">
                            <small>Harga Tiket</small>
                        </div>
                        <p class="mt-3"></p>
                        <input id="deskripsi_tiket_{{ $index + 1 }}" type="hidden" name="deskripsi_tiket[]"
                            value="{{ old('deskripsi_tiket.' . $index) }}">
                        <trix-editor input="deskripsi_tiket_{{ $index + 1 }}"></trix-editor>
                        <small>Deskripsi Tiket</small>
                        @error('deskripsi_tiket.*')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                        @enderror
                        <input type="date" name="waktu_tanggal_mulai[]" class="form-control mt-3"
                            value="{{ old('waktu_tanggal_mulai.' . $index) }}" placeholder="adsasda">
                        <small>Waktu Tanggal Mulai Tiket</small>
                        @error('waktu_tanggal_mulai.*')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                        @enderror
                        <input type="date" name="waktu_tanggal_selesai[]" class="form-control mt-3"
                            value="{{ old('waktu_tanggal_selesai.' . $index) }}">
                        <small>Waktu Tanggal Selesai Tiket</small>
                        @error('waktu_tanggal_selesai.*')
                        <small class="text-danger">
                            {{$message}}
                        </small>
                        @enderror
                        <br>
                        <a class="btn btn-outline-danger float-right removeTicket">Hapus Tiket</a>
                    </div>
                </div>
                @endif
                @endforeach
                @endif
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

    $(document).ready(function () {
        let countTicket = {{ old('nama_tiket') ? count(old('nama_tiket')) : 1 }};
        $('.addTicket').on('click', function () {
            createTicket();
        });

        function createTicket() {
            countTicket++;
            var tkt = `<div class="row mb-3">
                <label for="thumbnail" class="col-sm-2 col-form-label">Jenis Donasi ${countTicket}</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_tiket[]" class="form-control " id="" value="{{ old('nama_tiket.${countTicket}') }}"
                        placeholder="Masukan Nama Tiket">
                    <small>Nama Tiket</small>
                    <div class="mt-3 mb-3">
                        <input type="number" name="kuota_tiket[]" class="form-control mt-3" id=""
                            value="{{ old('kuota_tiket.${countTicket}') }}" placeholder="Masukan Jumlah Kuota Tiket">
                        <small>Kuota Tiket</small>
                        <input type="text" name="harga_tiket[]" class="form-control mt-3" id="customHarga"
                            value="{{ old('harga_tiket.${countTicket}') }}" placeholder="Masukan Harga Tiket">
                        <small>Harga Tiket</small>
                    </div>
                    <p class="mt-3"></p>
                    <input id="deskripsi_tiket_${countTicket}" type="hidden" name="deskripsi_tiket[]" value="{{ old('deskripsi_tiket.${countTicket}') }}">
                    <trix-editor input="deskripsi_tiket_${countTicket}"></trix-editor>
                    <small>Deskripsi Tiket</small>
                    <input type="date" name="waktu_tanggal_mulai[]" class="form-control mt-3" value="{{ old('waktu_tanggal_mulai.${countTicket}') }}" placeholder="adsasda">
                    <small>Waktu Tanggal Mulai Tiket</small>
                    <input type="date" name="waktu_tanggal_selesai[]" class="form-control mt-3" value="{{ old('waktu_tanggal_selesai.${countTicket}') }}">
                    <small>Waktu Tanggal Selesai Tiket</small>
                    <br>
                    <a class="btn btn-outline-danger float-right removeTicket">Hapus Tiket</a>
                </div>
            </div>`;
            $('.tiketEvent').append(tkt);
        }

        $(document).on('click', '.removeTicket', function () {
            $(this).closest('.row').remove();
            updateTicketLabels();
        });

        function updateTicketLabels() {
            $('.tiketEvent .row').each(function (index) {
                $(this).find('.col-form-label').text(`Tiket Event ${index + 2}`);
            });
        }
    });

    $(document).on('keyup', '#customHarga', function (e) {
        $(this).val(formatRupiah($(this).val()));
    });

    // Memodifikasi fungsi formatRupiah untuk menangani input pada elemen-elemen dengan ID customHarga
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>

@endsection
