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
    <h1>Detail Pemesanan Untuk: <b>{{ Carbon\Carbon::parse($tanggalM)->locale('id')->translatedFormat('l, d F Y') }}</b>
    </h1>
</div>

<section class="section">
    <form action="{{ route('savePesananNew') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3">
            <div class="card-body">
                <center>
                    <h1 class="card-title">Isi Data Keperluan</h1>
                </center>
                <input type="hidden" name="tanggal_mulai" value="{{$tanggalM}}">
                <div class="row g-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                name="jam_mulai" id="jam_mulai">
                            @error('jam_mulai')
                            <span id="jamMulaiError" class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                name="jam_selesai" id="jam_selesai">
                            @error('jam_selesai')
                            <span id="jamSelesaiError" class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                            <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                name="jumlah_peserta" id="jumlah_peserta">
                            @error('jumlah_peserta')
                            <span id="jumlahPesertaError" class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="file_pendukung" class="form-label">Bukti File Pendukung</label>
                        <input type="file" accept=".png, .jpg, .jpeg"
                            class="form-control @error('file_pendukung') is-invalid @enderror" name="file_pendukung"
                            id="file_pendukung" onchange="previewImage()">
                        <img class="img-preview img-fluid mt-3 mb-3 col-sm-5" style="display: none;">
                        @error('file_pendukung')
                        <span id="filePendukungError" class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Kebutuhan Penyewa</label>
                        <input id="kebutuhan_penyewa" class="@error('kebutuhan_penyewa') is-invalid @enderror"
                            type="hidden" name="kebutuhan_penyewa">
                        <trix-editor input="kebutuhan_penyewa"></trix-editor>
                        @error('kebutuhan_penyewa')
                        <span id="kebutuhanPenyewaError" class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <center>
            <h1 class="card-title">Pilih Ruangan Masjid</h1>
        </center>
        <div id="ruangan-container">
            @foreach ($dataRuangan as $key => $item)
            <div class="row mb-3 ruangan-item" id="ruangan{{$key}}" data-dipilih="false">
                <div class="col-lg-6">
                    <div id="carouselExampleControls{{$key}}" class="carousel slide">
                        <div class="carousel-inner">
                            @php
                            $gambar = json_decode($item->gambar_ruangan);
                            @endphp
                            @foreach ($gambar as $key2 => $item2)
                            <div class="carousel-item @if($key2 == 0) active @endif profile-card pt-4">
                                <img src="{{asset('storage/'.$item2)}}" class="d-block w-100 carousel-image" alt="...">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleControls{{$key}}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleControls{{$key}}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->nama_ruangan}}: <b>@harga($item->harga_ruangan)</b></h5>
                            <div>
                                {!!$item->deskripsi_ruangan!!}
                            </div>
                            <div id="deskripsiRuangan{{$key}}">
                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="buttonFasilitas{{$key}}" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#modalTambahFasilitas{{$key}}">
                                Pesan Ruangan
                            </button>
                            <input type="hidden" name="ruangan[{{$key}}][id]" value="{{ $item->id }}">
                            <input type="hidden" name="ruangan[{{$key}}][name]" value="{{ $item->nama_ruangan }}">
                            <input type="hidden" name="ruangan[{{$key}}][harga]" value="{{ $item->harga_ruangan }}">
                            <input type="hidden" name="ruangan[{{$key}}][fasilitas]" id="fasilitas{{$key}}" value="[]">
                            <input type="hidden" name="ruangan[{{$key}}][total_harga]" id="total_harga{{$key}}"
                                value="{{ $item->harga_ruangan }}">
                            <input type="hidden" name="ruangan[{{$key}}][dipilih]" id="dipilih{{$key}}" value="false">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk memilih fasilitas -->
            <div class="modal fade" id="modalTambahFasilitas{{$key}}" tabindex="-1"
                aria-labelledby="modalTambahFasilitasLabel{{$key}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahFasilitasLabel{{$key}}">Pilih Fasilitas Tambahan untuk
                                {{$item->nama_ruangan}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Proyektor" data-harga="50000"
                                    id="proyektor{{$key}}" name="fasilitas[{{$key}}][]">
                                <label class="form-check-label" for="proyektor{{$key}}">
                                    Proyektor (Rp 50.000)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Sound System" data-harga="75000"
                                    id="soundSystem{{$key}}" name="fasilitas[{{$key}}][]">
                                <label class="form-check-label" for="soundSystem{{$key}}">
                                    Sound System (Rp 75.000)
                                </label>
                            </div>
                            <!-- Tambahkan fasilitas lain sesuai kebutuhan -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                onclick="tambahkanFasilitas({{$key}})">Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Pesanan</button>
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

    function tambahkanFasilitas(key) {
        var fasilitas = [];
        var totalHargaFasilitas = 0;
        var checkboxes = document.querySelectorAll('#modalTambahFasilitas' + key + ' input[type="checkbox"]:checked');
        checkboxes.forEach(function (checkbox) {
            fasilitas.push(checkbox.value);
            totalHargaFasilitas += parseInt(checkbox.getAttribute('data-harga'));
        });

        var fasilitasInput = document.getElementById('fasilitas' + key);
        fasilitasInput.value = JSON.stringify(fasilitas);

        var totalHargaRuangan = parseInt(document.querySelector('#ruangan' + key + ' input[name="ruangan[' + key +
            '][harga]"]').value);
        var totalHarga = totalHargaRuangan + totalHargaFasilitas;

        var totalHargaInput = document.getElementById('total_harga' + key);
        totalHargaInput.value = totalHarga;

        var deskripsiElement = document.getElementById('deskripsiRuangan' + key);
        deskripsiElement.innerHTML = "<p>Ruangan ditambahkan:</p>";
        deskripsiElement.innerHTML += "<ul>";
        deskripsiElement.innerHTML += "<li><strong>Nama Ruangan:</strong> " + document.querySelector('#ruangan' + key +
            ' .card-title').innerText + "</li>";
        deskripsiElement.innerHTML += "<li><strong>Fasilitas:</strong> " + fasilitas.join(', ') + "</li>";
        deskripsiElement.innerHTML += "<li><strong>Total Harga:</strong> Rp " + totalHarga.toLocaleString('id-ID') +
            "</li>";
        deskripsiElement.innerHTML += "</ul>";

        // Ubah status ruangan menjadi dipilih
        var ruanganItem = document.getElementById('ruangan' + key);
        ruanganItem.setAttribute('data-dipilih', 'true');
        ruanganItem.classList.add('selected');

        var dipilihInput = document.getElementById('dipilih' + key);
        dipilihInput.value = 'true';

        // Ubah tombol untuk fasilitas
        var buttonFasilitas = document.getElementById('buttonFasilitas' + key);
        buttonFasilitas.textContent = 'Edit Fasilitas';
        buttonFasilitas.onclick = function () {
            document.getElementById('modalTambahFasilitas' + key).querySelectorAll('input[type="checkbox"]')
                .forEach(checkbox => {
                    checkbox.checked = fasilitas.includes(checkbox.value);
                });
            document.getElementById('modalTambahFasilitas' + key).style.display = 'block';
        };

        console.log("Ruangan " + key + " ditambahkan dengan fasilitas: " + fasilitas.join(', '));
    }

    function checkFasilitas(key) {
        // Reset tombol jika belum ada fasilitas
        var buttonFasilitas = document.getElementById('buttonFasilitas' + key);
        buttonFasilitas.textContent = 'Tambah Fasilitas';
        buttonFasilitas.onclick = function () {
            document.getElementById('modalTambahFasilitas' + key).style.display = 'block';
        };
    }

</script>
@endsection
