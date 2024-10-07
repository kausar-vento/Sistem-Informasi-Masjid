@push('titles')
    <title>Detail Transaksi Event</title>
@endpush
@extends('admin.component.header')
@section('header-admin')
<div class="card">
    <h5 class="card-header">Detail Transaksi <b>{{$getEvent->nama_event}}</b></h5>
</div>
<div class="card mt-3 col-md-8 mx-auto">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <img src="{{asset('storage/'.$getEvent->thumbnail)}}" alt="" class="card-img-top rounded mx-auto d-block">
            </div>
            <div class="col-md-7">
                <ul class="list-group list-group-flush mt-4">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-7">
                                Saldo Saat Ini:
                            </div>
                            <div class="col-md-5">
                                @harga($getTotal)
                                <i class="bx bx-chevron-right bx-sm align-middle float-end"></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-7">
                                Saldo Ditarik:
                            </div>
                            <div class="col-md-5">
                                @harga($totalDitarik)
                                <i class="bx bx-chevron-right bx-sm align-middle float-end"></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-7">
                                Total Transaksi Event Ini:
                            </div>
                            <div class="col-md-5">
                                @harga($totalHarga)
                                <i class="bx bx-chevron-right bx-sm align-middle float-end"></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-12">
                                Rincian Transaksi
                                <a class="float-end" href="{{route('laporanTransaksiEvent', $getEvent->nama_event)}}">
                                    <i class="bx bx-chevron-right bx-sm align-middle"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item"></li>
                </ul>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLong">
                    Kelola Aktifitas
                </button>
                <a href="{{route('admin.detailNeraca', $getEvent->nama_event)}}" class="btn btn-info">Laporan</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLong" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLongTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAktivitas" action="{{ route('prosesNeraca') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_event" value="{{$getEvent->id}}">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="nama_ruangan" class="form-label">Tujuan Rekening</label>
                            <input type="number" id="nama_ruangan" name="rekening_tujuan" class="form-control @error('rekening_tujuan') is-invalid @enderror" placeholder="Nomor Rekening" />
                            @error('rekening_tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <label for="nominal" class="form-label">Saldo Ditarik</label>
                            <input type="text" id="nominal" name="nominal" class="form-control @error('nominal') is-invalid @enderror" placeholder="Saldo Saat ini @harga($getTotal)" />
                            @error('nominal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <label for="deskripsi_ruangan" class="form-label">Keterangan Penarikan</label>
                            <input type="hidden" id="deskripsi_ruangan" name="keterangan_aktivitas" class="form-control @error('keterangan_aktivitas') is-invalid @enderror" />
                            <trix-editor input="deskripsi_ruangan"></trix-editor>
                            @error('keterangan_aktivitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <label for="jenis_aktivitas_admin" class="form-label">Jenis Aktifitas</label>
                            <select name="jenis_aktivitas_admin" class="form-select @error('jenis_aktivitas_admin') is-invalid @enderror">
                                <option value="Pengeluaran">Pengeluaran</option>
                                <option value="Pemasukan">Pemasukan</option>
                            </select>
                            @error('jenis_aktivitas_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="gambar_bukti" class="form-label">Bukti Transaksi</label>
                        <input type="file" accept=".png,.jpg,.jpeg" name="gambar_bukti" id="gambar_bukti" class="form-control @error('gambar_bukti') is-invalid @enderror" onchange="previewImage()" />
                        @error('gambar_bukti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img class="img-preview img-fluid mt-3 mb-3 col-sm-5">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" name="jenis_transaksi" value="event" class="btn btn-primary" id="saveChangesButton">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js')}}"></script>
<script>
    $(document).ready(function () {
        // Mask the input to format as Rupiah
        $('#nominal').mask('000.000.000.000', {
            reverse: true
        });

        // Validate input to ensure it does not exceed totalHarga
        $('#nominal').on('input', function () {
            let totalHarga = {{$getTotal}};
            let inputVal = $(this).cleanVal();
            if (parseInt(inputVal) > totalHarga) {
                alert('Saldo yang ditarik tidak boleh lebih dari ' + totalHarga);
                $(this).val('');
            }
        });

        $('#saveChangesButton').on('click', function () {
            let totalHarga = {{$getTotal}};
            let inputVal = $('#nominal').cleanVal();
            if (parseInt(inputVal) > totalHarga) {
                alert('Saldo yang ditarik tidak boleh lebih dari ' + totalHarga);
                return false;
            }
            $('#formAktivitas').submit();
        });
    });

    function previewImage() {
        const image = document.querySelector('#gambar_bukti');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endpush
