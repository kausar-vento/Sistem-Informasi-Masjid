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
                    <a class="dropdown-item" href="{{route('petugas.homeEventPetugas')}}">
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
                <a href="{{route('petugas.createTiketEvent', $getIdEvent)}}"
                    class="btn btn-primary float-end mb-3">Tambah Tiket</a>
                <br>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tiket</th>
                        <th>Jenis Tiket</th>
                        <th>Kuota Tiket</th>
                        <th>Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataTiket as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="max-width: 140px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                            {{$item->nama_tiket}}
                        </td>
                        <td>{{$item->jenis_tiket}}</td>
                        <td>{{$item->kuota_tiket == null ? 'Tidak Ada' : $item->kuota_tiket}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#editTicketModal" data-ticket="{{ json_encode($item) }}">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editTicketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateTicketForm" method="POST" action="{{ route('petugas.updateTiketEvent') }}">
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
                    <input type="hidden" name="tiket_id" id="tiket_id">
                    <div class="form-group">
                        <label for="nama_tiket">Nama Tiket</label>
                        <input type="text" class="form-control @error('nama_tiket') is-invalid @enderror"
                            id="nama_tiket" name="nama_tiket" value="{{ old('nama_tiket') }}">
                        @error('nama_tiket')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_tiket">Jenis Tiket</label>
                        <select class="form-control @error('jenis_tiket') is-invalid @enderror" id="jenis_tiket"
                            name="jenis_tiket" onchange="showHargaTicket()">
                            <option value="Gratis" {{ old('jenis_tiket') == 'Gratis' ? 'selected' : '' }}>Gratis
                            </option>
                            <option value="Berbayar" {{ old('jenis_tiket') == 'Berbayar' ? 'selected' : '' }}>Berbayar
                            </option>
                        </select>
                        @error('jenis_tiket')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="display: none" class="mt-3 mb-3" id="lanjutkan">
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
        // Function to toggle visibility based on ticket type
        function showHargaTicket() {
            var select = document.getElementById('jenis_tiket');
            var menentukan = document.getElementById('lanjutkan');

            if (select.value === 'Gratis') {
                menentukan.style.display = 'none';
            } else if (select.value === 'Berbayar') {
                menentukan.style.display = 'block';
            }
        }

        // Initial check on page load
        showHargaTicket();

        // Event listener for select change
        document.getElementById('jenis_tiket').addEventListener('change', showHargaTicket);

        // Format currency input
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
            modal.find('.modal-body #tiket_id').val(ticket.id_event);
            modal.find('.modal-body #nama_tiket').val(ticket.nama_tiket);
            modal.find('.modal-body #jenis_tiket').val(ticket.jenis_tiket);
            modal.find('.modal-body #kuota_tiket').val(ticket.kuota_tiket);
            modal.find('.modal-body #harga_tiket').val(ticket.harga_tiket);
            // Set value of the hidden input for Trix Editor
            modal.find('.modal-body #deskripsi_tiket').val(ticket.deskripsi_tiket);
            // Update the Trix Editor content
            document.querySelector("trix-editor[input='deskripsi_tiket']").editor.loadHTML(ticket
                .deskripsi_tiket);
            modal.find('.modal-body #waktu_tanggal_mulai').val(ticket.waktu_tanggal_mulai);
            modal.find('.modal-body #waktu_tanggal_selesai').val(ticket.waktu_tanggal_selesai);
            showHargaTicket();
            var harga_tiket = modal.find('.modal-body #harga_tiket').val();
            if (harga_tiket) {
                modal.find('.modal-body #harga_tiket').val(formatRupiah(harga_tiket));
            }
        });
    });

</script>
@endpush
