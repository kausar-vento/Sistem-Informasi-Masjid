@push('titles')
<title>Home Pesanan Ruangan New</title>
@endpush
@push('meta')
<meta http-equiv="X-UA-Compatible" content="ie=edge">
</meta>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@extends('user.component.header')

@section('navbar-user')
<style>
    .show-img-container img {
        width: 200px;
        /* Atur lebar sesuai kebutuhan Anda */
        height: auto;
        /* Menjaga rasio aspek */
        margin: 10px;
        /* Jarak antar gambar */
    }

</style>
<div class="pagetitle">
    <h1>Pesan Ruangan</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>
    {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<section class="section">
    <div class="card mb-3">
        <div class="card-body">
            <div id="calendar" class="mt-3"></div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js') }}">
</script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#calendar').fullCalendar({
            header: {
                right: 'prev, next'
            },
            selectable: true,
            selectHelper: true,
            longPressDelay: 10,
            eventLongPressDelay: 10,
            selectLongPressDelay: 10,
            validRange: {
                start: moment().startOf('day')
            },
            events: [{
                title: 'Testing-Testing',
                start: '2024-03-02 20:00:00',
                end: '2024-03-02 21:00:00',
                color: 'green'
            }],
            select: function (start, end, allDays) {
                // Format tanggal untuk dikirim ke server
                var tanggalMulai = moment(start).format('YYYY-MM-DD');
                var tanggalSelesai = moment(end).format('YYYY-MM-DD');
                // Arahkan ke halaman detail pemesanan dengan tanggal sebagai parameter query
                window.location.href = "{{ route('detailPesanRuangan') }}?tanggal_mulai=" +
                    tanggalMulai + "&tanggal_selesai=" + tanggalSelesai;
            },
        });
    });

</script>
@endpush
