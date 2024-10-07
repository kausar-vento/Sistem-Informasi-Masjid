@push('titles')
<title>Tiket Event Masjid</title>
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
                <h6 class="m-0 font-weight-bold text-secondary">LIST TIKET EVENT MASJID</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <a href="{{route('petugas.createTiketFundRaising', $getFR->nama_kegiatan)}}"
                    class="btn btn-primary float-end mb-3">Tambah Tiket</a>
                <br>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tiket</th>
                        <th>Harga Tiket</th>
                        <th>Kuota Tiket</th>
                        <th>Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getTiketFR as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="max-width: 140px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                            {{$item->nama_tiket}}
                        </td>
                        <td>@harga($item->harga_tiket)</td>
                        <td>{{$item->kuota_tiket == null ? 'Tidak Ada' : $item->kuota_tiket}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#editTicketModal" data-ticket="{{ json_encode($item) }}">Edit</button>
                            <form action="{{route('petugas.hapusTiketFR', $item->id)}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin Ingin Hapus Tiket Ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{-- <i class="bi bi-check-circle me-1"></i> --}}
    {{session('success')}}
    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="editTicketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateTicketForm" method="POST" action="{{ route('petugas.updateTiketFR') }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tampilkan pesan error -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="fund_raising_id" id="fund_raising_id">
                    <div class="form-group">
                        <label for="nama_tiket">Nama Tiket</label>
                        <input type="text" class="form-control @error('nama_tiket') is-invalid @enderror"
                            id="nama_tiket" name="nama_tiket" value="{{ old('nama_tiket') }}">
                        @error('nama_tiket')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kuota_tiket">Kuota Tiket</label>
                        <input type="number" class="form-control @error('kuota_tiket') is-invalid @enderror"
                            id="kuota_tiket" name="kuota_tiket" value="{{ old('kuota_tiket') }}">
                        @error('kuota_tiket')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_tiket">Harga Tiket</label>
                        <input type="text" class="form-control @error('harga_tiket') is-invalid @enderror"
                            id="harga_tiket" name="harga_tiket" value="{{ old('harga_tiket') }}">
                        @error('harga_tiket')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_tiket">Deskripsi Tiket</label>
                        <input id="deskripsi_tiket" type="hidden" name="deskripsi_tiket">
                        <trix-editor input="deskripsi_tiket"></trix-editor>
                        @error('deskripsi_tiket')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="waktu_tanggal_mulai">Waktu Tanggal Mulai</label>
                        <input type="date" class="form-control @error('waktu_tanggal_mulai') is-invalid @enderror"
                            id="waktu_tanggal_mulai" name="waktu_tanggal_mulai"
                            value="{{ old('waktu_tanggal_mulai') }}">
                        @error('waktu_tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="waktu_tanggal_selesai">Waktu Tanggal Selesai</label>
                        <input type="date" class="form-control @error('waktu_tanggal_selesai') is-invalid @enderror"
                            id="waktu_tanggal_selesai" name="waktu_tanggal_selesai"
                            value="{{ old('waktu_tanggal_selesai') }}">
                        @error('waktu_tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('keyup', '#harga_tiket', function (e) {
            $(this).val(formatRupiah($(this).val()));
        });

        // Function to format currency to Rupiah
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

        $('#editTicketModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var ticket = button.data('ticket'); // Menggunakan 'data-ticket'
            console.log(ticket);

            var modal = $(this);
            modal.find('.modal-body #id').val(ticket.id);
            modal.find('.modal-body #fund_raising_id').val(ticket.id_fund_raising);
            modal.find('.modal-body #nama_tiket').val(ticket.nama_tiket);
            modal.find('.modal-body #kuota_tiket').val(ticket.kuota_tiket);
            modal.find('.modal-body #harga_tiket').val(ticket.harga_tiket);
            // Set value of the hidden input for Trix Editor
            modal.find('.modal-body #deskripsi_tiket').val(ticket.deskripsi_tiket);
            // Update the Trix Editor content
            document.querySelector("trix-editor[input='deskripsi_tiket']").editor.loadHTML(ticket
                .deskripsi_tiket);
            modal.find('.modal-body #waktu_tanggal_mulai').val(ticket.waktu_tanggal_mulai);
            modal.find('.modal-body #waktu_tanggal_selesai').val(ticket.waktu_tanggal_selesai);
            var harga_tiket = modal.find('.modal-body #harga_tiket').val();
            if (harga_tiket) {
                modal.find('.modal-body #harga_tiket').val(formatRupiah(harga_tiket));
            }
        });
    });

</script>
@endpush
