@push('titles')
<title>Detail {{$getEvent->nama_event}}</title>
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css')}}"
    crossorigin="anonymous" />
@endpush
@extends('user.component.header')
@section('navbar-user')
<br>
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <a href="{{route('detailEvent', $getEvent->nama_event)}}"><img
                        src="{{asset('storage/'.$getEvent->thumbnail)}}"
                        class="bd-placeholder-img card-img-top rounded img-fluid" width="100%" height="300"></a>
            </div>
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Penjelasan</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                Booking Event</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Event
                                Lainya</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Tentang Event</h5>
                            {!!$getEvent->detail_event!!}

                            <h5 class="card-title">Informasi Event</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Tanggal</div>
                                <div class="col-lg-9 col-md-8">
                                    {{ Carbon\Carbon::parse($getEvent->tanggal_event)->locale('id')->translatedFormat('l, d F Y') }}
                                </div>
                            </div>
                            @if ($getEvent->jam_selesai == null)
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jam</div>
                                <div class="col-lg-9 col-md-8">{{$getEvent->jam_mulai}} - Selesai</div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jam</div>
                                <div class="col-lg-9 col-md-8">{{$getEvent->jam_mulai}} - {{$getEvent->jam_selesai}}
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Lokasi</div>
                                <div class="col-lg-9 col-md-8">{!!$getEvent->ruangan->nama_ruangan ??
                                    $getEvent->lokasi_luar_masjid!!}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Peserta</div>
                                <div class="col-lg-9 col-md-8">{{$getEvent->peserta_event}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tamu Acara</div>
                                <div class="col-lg-9 col-md-8 mr-2">
                                    @php
                                    $tamuAcara = json_encode($getEvent->tamu_acara);
                                    $tamuAcara2 = json_decode($getEvent->tamu_acara, true);
                                    @endphp
                                    @foreach ($tamuAcara2 as $item)
                                    {{$item}}{{$loop->last ? '' : ''}}
                                    @endforeach
                                    </ol>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form action="{{route('prosesBokingEvent')}}" method="POST">
                                @csrf
                                <!-- Ticket 1 -->
                                <input type="hidden" name="id_event" value="{{$getEvent->id}}">
                                <div class="container">
                                    @foreach ($allTiketEvent as $item)
                                    <div class="card-ticket">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->nama_tiket}} (Sisa Tiket : <b>{{$item->kuota_tiket ?? ''}}</b>)</h5>
                                            <div class="max-text">
                                                {!!$item->deskripsi_tiket!!}
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            @if ($item->jenis_tiket === 'Berbayar')
                                            @harga($item->harga_tiket)
                                            @else
                                            {{$item->jenis_tiket}}
                                            @endif
                                            <div class="number-input float-end">
                                                <a onclick="decrementQuantity(this)" class="minus"></a>
                                                <input class="quantity" max="{{$item->kuota_tiket ?? ''}}" name="quantity[]" value="1"
                                                    type="number" oninput="checkZero(this)">
                                                <input name="id_tiket[]" value="{{$item->id}}" type="hidden">
                                                <input name="harga_tiket[]" value="{{$item->harga_tiket}}" type="hidden">
                                                <input name="nama_tiket[]" value="{{$item->nama_tiket}}" type="hidden">
                                                <a onclick="incrementQuantity(this)" class="plus"></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <button class="float-end btn btn-primary">Pesan Sekarang</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-settings">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                @foreach ($allEvent as $aE)
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <a href="{{route('detailEvent', $aE->nama_event)}}">
                                            <img src="{{asset('storage/'.$aE->thumbnail)}}"
                                                class="bd-placeholder-img card-img-top" width="100%" height="225">
                                        </a>
                                        <div class="card-body">
                                            <div class="mb-3 mt-2">
                                                <div class="">
                                                    <p class="card-text max-text2">{{$aE->nama_event}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    {{-- <small class="text-muted">{{$aE->tanggal_event}}</small> --}}
                                                    <small
                                                        class="text-muted">{{ Carbon\Carbon::parse($aE->tanggal_event)->locale('id')->translatedFormat('l, d F Y') }}</small>
                                                </div>
                                                <div class="col-sm-5">
                                                    @if ($aE->jenis_event === 'Terbuka')
                                                    <badge class="badge bg-primary">{{$aE->jenis_event}}</badge>
                                                    @else
                                                    <badge class="badge bg-warning text-dark">{{$aE->jenis_event}}
                                                    </badge>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script>
    function checkZero(input) {
        if (input.value == 0) {
            // Simpan nilai inputan dan element input
            var quantity = input.value;
            var idTiket = input.nextElementSibling.value;
            var hargaTiket = input.nextElementSibling.nextElementSibling.value;
            var namaTiket = input.nextElementSibling.nextElementSibling.nextElementSibling.value;

            // Buat elemen button
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'btn btn-primary';
            button.innerText = 'Pesan';

            // Set onclick untuk button
            button.onclick = function () {
                // Ubah kembali menjadi input number
                var parent = this.parentNode;
                parent.innerHTML = `
            <a onclick="decrementQuantity(this)" class="minus"></a>
            <input class="quantity" max="{{$item->kuota_tiket}}" name="quantity[]" value="1" type="number" oninput="checkZero(this)">
            <input name="id_tiket[]" value="${idTiket}" type="hidden">
            <input name="harga_tiket[]" value="${hargaTiket}" type="hidden">
            <input name="nama_tiket[]" value="${namaTiket}" type="hidden">
            <a onclick="incrementQuantity(this)" class="plus"></a>
          `;
            };

            // Ganti input dengan button
            var parentNode = input.parentNode;
            if (parentNode) {
                parentNode.innerHTML = '';
                parentNode.appendChild(button);
            }
        }
    }

    function decrementQuantity(element) {
        var input = element.parentNode.querySelector('input[type=number]');
        if (input) {
            input.stepDown();
            checkZero(input);
        }
    }

    function incrementQuantity(element) {
        var input = element.parentNode.querySelector('input[type=number]');
        if (input) {
            input.stepUp();
            checkZero(input);
        }
    }

</script>

@endpush
