<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FundRaising;
use App\Models\Ruangan;
use App\Models\TiketEvent;
use App\Models\TiketFundRaising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Colors\Rgb\Channels\Red;

class PetugasFungsiController extends Controller
{
    public function homeEventPetugas() {
        return view('petugas.mengeola-event.home_event', [
            'dataEvent' => Event::latest()->get()
        ]);
    }

    public function homeCreateEventPetugas() {
        return view('petugas.mengeola-event.create_event', [
            'dataRuangan' => Ruangan::all(),
        ]);
    }

    public function storeEvent(Request $request) {
        $data = $request->all();
        // dd($data);
        $getEvent = Event::all();
        $getJumlahEvent = $getEvent->count() + 1;
        $validasi = $request->validate([
            'nama_event' => 'required',
            'detail_event' => 'required',
            'tanggal_event' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => '',
            'peserta_event' => 'required|in:Umum,Pria,Wanita',
            'lokasi_event' => 'required|in:Masjid,Luar Masjid',
            'id_ruangan' => '',
            'lokasi_luar_masjid' => '',
            'tamu_acara.*' => '',
            'thumbnail' => 'required|max:5080|mimes:jpg,png',
            'nama_tiket.*' => 'required|string|max:255',
            'jenis_tiket.*' => 'required|string|in:Gratis,Berbayar',
            'kuota_tiket.*' => 'nullable|integer',
            'harga_tiket.*' => 'nullable',
            'deskripsi_tiket.*' => 'required|string',
            'waktu_tanggal_mulai.*' => 'required|date',
            'waktu_tanggal_selesai.*' => 'required|date|after_or_equal:waktu_tanggal_mulai.*',
        ], [
            'nama_event.required' => 'Nama event harus diisi.',
            'detail_event.required' => 'Detail event harus diisi.',
            'tanggal_event.required' => 'Tanggal event harus diisi.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'peserta_event.in' => 'Peserta event harus dipilih.',
            'lokasi_event.in' => 'Lokasi event harus dipilih.',
            'thumbnail.required' => 'Thumbnail harus diupload.',
            'thumbnail.mimes' => 'Thumbnail harus berupa file dengan format: jpg, png.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal adalah 5080 KB.',
            'nama_tiket.*.required' => 'Nama tiket harus diisi.',
            'jenis_tiket.*.in' => 'Jenis tiket harus dipilih.',
            'deskripsi_tiket.*.required' => 'Deskripsi tiket harus diisi.',
            'waktu_tanggal_mulai.*.required' => 'Waktu tanggal mulai tiket harus diisi.',
            'waktu_tanggal_selesai.*.required' => 'Waktu tanggal selesai tiket harus diisi.',
        ]);

        $event = new Event;
        $event->nama_event = $data['nama_event'];
        $event->detail_event = $data['detail_event'];
        $event->tanggal_event = $data['tanggal_event'];
        $event->jam_mulai = $data['jam_mulai'];
        $event->jam_selesai = $data['jam_selesai'] ?? null;
        $event->peserta_event = $data['peserta_event'];
        $event->lokasi_event = $data['lokasi_event'];
        $event->id_ruangan = $request->id_ruangan === 'Open this select menu' ? null : $data['id_ruangan'];
        $event->lokasi_luar_masjid = $data['lokasi_luar_masjid'];
        $event->tamu_acara = json_encode($request->tamu_acara) ?? null;
        $event->thumbnail = $request->file('thumbnail')->store('file-event-masjid');
        $event->save();

        for ($i = 0; $i < count($data['nama_tiket']); $i++) {
            $userInput = $data['harga_tiket'][$i];
            $userInputWithoutDecimal = str_replace('.', '', $userInput);
            $intValue = (int) $userInputWithoutDecimal;
            TiketEvent::create([
                'id_event' => $getJumlahEvent,
                'nama_tiket' => $data['nama_tiket'][$i],
                'jenis_tiket' => $data['jenis_tiket'][$i],
                'kuota_tiket' => $data['kuota_tiket'][$i] ?? null,
                'harga_tiket' => $intValue ?? null,
                'deskripsi_tiket' => $data['deskripsi_tiket'][$i],
                'waktu_tanggal_mulai' => $data['waktu_tanggal_mulai'][$i],
                'waktu_tanggal_selesai' => $data['waktu_tanggal_selesai'][$i],
            ]);
        }
        return redirect()->route('petugas.homeEventPetugas');
    }

    public function homeTiketEvent(Event $event) {
        $getIdEvent = $event->id;
        $getTicketEvent = TiketEvent::where('id_event', $event->id)->get();
        return view('petugas.mengeola-event.mengeola-tiket-event.tiket_event', [
            'dataTiket' => $getTicketEvent,
            'getIdEvent' => $getIdEvent
        ]);
    }

    public function editEventPetugas(Event $event) {
        $getEvent = Event::where('id', $event->id)->first();
        $dataRuangan = Ruangan::all();
        // dd($getEvent);
        return view('petugas.mengeola-event.edit_event', compact('getEvent', 'dataRuangan'));
    }

    public function updateStatusEvent(Request $request) {
        Event::where('id', $request->id_event)->update([
            'status_event' => 'Unpublish'
        ]);
        return redirect()->route('petugas.homeEventPetugas')->with('success', 'Event Berhasil Diupdate');
    }

    public function updateEventPetugas(Request $request, Event $event) {
        $validasi = $request->validate([
            'nama_event' => 'required',
            'detail_event' => 'required',
            'tanggal_event' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'peserta_event' => 'required|in:Umum,Pria,Wanita',
            'lokasi_event' => 'required|in:Masjid,Luar Masjid',
            'id_ruangan' => '',
            'lokasi_luar_masjid' => '',
            'tamu_acara.*' => '',
            'thumbnail' => 'max:5080|mimes:jpg,png',
        ], [
            'nama_event.required' => 'Nama event harus diisi.',
            'detail_event.required' => 'Detail event harus diisi.',
            'tanggal_event.required' => 'Tanggal event harus diisi.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'peserta_event.in' => 'Peserta event harus dipilih.',
            'lokasi_event.in' => 'Lokasi event harus dipilih.',
            'thumbnail.mimes' => 'Thumbnail harus berupa file dengan format: jpg, png.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal adalah 5080 KB.',
        ]);

        if ($request->file('thumbnail')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validasi['thumbnail'] = $request->file('thumbnail')->store('file-event-masjid');
        }
        $validasi['tamu_acara'] = json_encode($request->tamu_acara) ?? null;
        $validasi['id_ruangan'] = $request->id_ruangan === 'Open this select menu' ? null : $request->id_ruangan;
        Event::where('id', $event->id)->update($validasi);
        return redirect()->route('petugas.homeEventPetugas');
    }

    public function createTiketEvent(Event $event) {
        $idTiket = $event->id;
        return view('petugas.mengeola-event.mengeola-tiket-event.create_tiket_event', compact('idTiket'));
    }

    public function storeTiketEvent(Request $request) {
        $data = $request->all();
        $validasi = $request->validate([
            'nama_tiket.*' => 'required|string|max:255',
            'jenis_tiket.*' => 'required|string|in:Gratis,Berbayar',
            'kuota_tiket.*' => 'nullable|integer',
            'harga_tiket.*' => 'nullable',
            'deskripsi_tiket.*' => 'required|string',
            'waktu_tanggal_mulai.*' => 'required|date',
            'waktu_tanggal_selesai.*' => 'required|date',
        ], [
            'nama_tiket.*.required' => 'Nama tiket harus diisi.',
            'jenis_tiket.*.in' => 'Jenis tiket harus dipilih.',
            'kuota_tiket.*.integer' => 'Harga tiket harus berupa angka, dan tidak ada spesial karakter',
            'deskripsi_tiket.*.required' => 'Deskripsi tiket harus diisi.',
            'waktu_tanggal_mulai.*.date' => 'Waktu tanggal mulai tiket harus berupa tanggal.',
            'waktu_tanggal_selesai.*.date' => 'Waktu tanggal selesai tiket harus berupa tanggal.',
        ]);

        for ($i = 0; $i < count($data['nama_tiket']); $i++) {
            $userInput = $data['harga_tiket'][$i];
            $userInputWithoutDecimal = str_replace('.', '', $userInput);
            $intValue = (int) $userInputWithoutDecimal;
            TiketEvent::create([
                'id_event' => $data['id_event'],
                'nama_tiket' => $data['nama_tiket'][$i],
                'jenis_tiket' => $data['jenis_tiket'][$i],
                'kuota_tiket' => $data['kuota_tiket'][$i] ?? null,
                'harga_tiket' => $intValue ?? null,
                'deskripsi_tiket' => $data['deskripsi_tiket'][$i],
                'waktu_tanggal_mulai' => $data['waktu_tanggal_mulai'][$i],
                'waktu_tanggal_selesai' => $data['waktu_tanggal_selesai'][$i],
            ]);
        }
        return redirect()->route('petugas.homeTiketEvent', $data['id_event']);
    }

    public function updateTiketEvent(Request $request) {
        // dd($request->all());
        $request->validate([
            'nama_tiket' => 'required|string|max:255',
            'jenis_tiket' => 'required|string|in:Gratis,Berbayar',
            'kuota_tiket' => 'nullable|integer',
            'harga_tiket' => 'nullable',
            'deskripsi_tiket' => 'required|string',
            'waktu_tanggal_mulai' => 'required|date',
            'waktu_tanggal_selesai' => 'required|date',
        ]);

        $userInput = $request->harga_tiket;
        $userInputWithoutDecimal = str_replace('.', '', $userInput);
        $intValue = (int) $userInputWithoutDecimal;

        $ticket = TiketEvent::where('id', $request->id)->update([
            'nama_tiket' => $request->nama_tiket,
            'jenis_tiket' => $request->jenis_tiket,
            'kuota_tiket' => $request->jenis_tiket === 'Gratis' ? null : $request->kuota_tiket,
            'harga_tiket' => $request->jenis_tiket === 'Gratis' ? null : $intValue,
            'deskripsi_tiket' => $request->deskripsi_tiket,
            'waktu_tanggal_mulai' => $request->waktu_tanggal_mulai,
            'waktu_tanggal_selesai' => $request->waktu_tanggal_selesai,
        ]);
        return redirect()->route('petugas.homeTiketEvent', $request->tiket_id)->with('success', 'Tiket berhasil diupdate');
    }

    public function hapusTiketEvent($id) {
        $getTE = TiketEvent::find($id);
        $getTE->delete();
        return redirect()->route('petugas.homeTiketEvent', $getTE->id_event)->
        with('success', 'Tiket berhasil dihapus');
    }

    public function homeListEventHadir() {
        return view('petugas.mengeola-event.mengirimkan-notifikasi.home_list_event_hadir');
    }

    public function homeDetailUserEvent() {
        return view('petugas.mengeola-event.mengirimkan-notifikasi.home_list_event_detail');
    }

    public function homeFundRaisingPetugas() {
        return view('petugas.mengeola-fund-raising.home_fund_raising', [
            'dataFR' => FundRaising::latest()->get()
        ]);
    }

    public function createFundRaisingPetugas() {
        return view('petugas.mengeola-fund-raising.create_fund_raising');
    }

    public function storeFundRaising(Request $request) {
        $data = $request->all();
        $getFR = FundRaising::all();
        $getJumlahFR = $getFR->count() + 1;
        $validasi = $request->validate([
            'nama_kegiatan' => 'required',
            'detail_donasi' => 'required',
            'rincian_dana' => 'required',
            'thumbnail_donasi' => 'required|max:5080|mimes:jpg,png',
            'nama_tiket.*' => 'required|string|max:255',
            'kuota_tiket.*' => 'nullable|integer',
            'harga_tiket.*' => 'nullable',
            'deskripsi_tiket.*' => 'required|string',
            'waktu_tanggal_mulai.*' => 'nullable',
            'waktu_tanggal_selesai.*' => 'nullable',
        ], [
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi.',
            'detail_donasi.required' => 'Detail Donasi harus diisi.',
            'rincian_dana.required' => 'Rincian Dana harus diisi.',
            'thumbnail_donasi.required' => 'Thumbnail Donasi harus diupload.',
            'thumbnail_donasi.mimes' => 'Thumbnail Donasi harus berupa file dengan format: jpg, png.',
            'thumbnail_donasi.max' => 'Ukuran thumbnail Donasi maksimal adalah 5080 KB.',
            'nama_tiket.*.required' => 'Nama tiket harus diisi.',
            'deskripsi_tiket.*.required' => 'Deskripsi tiket harus diisi.',
        ]);

        $fundR = new FundRaising();
        $fundR->nama_kegiatan = $data['nama_kegiatan'];
        $fundR->detail_donasi = $data['detail_donasi'];
        $fundR->rincian_dana = $data['rincian_dana'];
        $fundR->thumbnail_donasi = $request->file('thumbnail_donasi')->store('file-fund-raising');
        $fundR->save();

        for ($i = 0; $i < count($data['nama_tiket']); $i++) {
            $userInput = $data['harga_tiket'][$i];
            $userInputWithoutDecimal = str_replace('.', '', $userInput);
            $intValue = (int) $userInputWithoutDecimal;
            TiketFundRaising::create([
                'id_fund_raising' => $getJumlahFR,
                'nama_tiket' => $data['nama_tiket'][$i],
                'kuota_tiket' => $data['kuota_tiket'][$i] ?? null,
                'harga_tiket' => $intValue ?? null,
                'deskripsi_tiket' => $data['deskripsi_tiket'][$i],
                'waktu_tanggal_mulai' => $data['waktu_tanggal_mulai'][$i] ?? null,
                'waktu_tanggal_selesai' => $data['waktu_tanggal_selesai'][$i] ?? null,
            ]);
        }
        return redirect()->route('petugas.homeFundR')->with('success', 'Penggalangan Dana Berhasil Terbuat');
    }

    public function editFundRaising($idFR) {
        $getFR = FundRaising::where('id', $idFR)->first();
        return view('petugas.mengeola-fund-raising.edit_fund_raising', compact('getFR'));
    }

    public function updateFundRaising(Request $request, $idFR) {
        // dd($request->all());
        $validasi = $request->validate([
            'nama_kegiatan' => 'required|min:5|max:100',
            'detail_donasi' => 'required|min:6',
            'rincian_dana' => 'required|min:6',
            'thumbnail_donasi' => 'max:5080|mimes:jpg,png',
        ]);

        if ($request->file('thumbnail_donasi')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validasi['thumbnail_donasi'] = $request->file('thumbnail_donasi')->store('file-fund-raising');
        }

        FundRaising::where('id', $idFR)->update($validasi);
        return redirect()->route('petugas.homeFundR')->with('success', 'Penggalangan Dana Berhasil Diupdate');
    }

    public function updtaeStatusFR(Request $request) {
        FundRaising::where('id', $request->id_fund_raising)->update([
            'status_donasi' => 'Unpublish'
        ]);
        return redirect()->route('petugas.homeFundR')->with('success', 'Fund Raising Berhasil Diupdate');
    }

    public function tiketFundRaising($fr) {
        $getFR = FundRaising::where('nama_kegiatan', 'like', $fr)->first();
        $getTiketFR = TiketFundRaising::where('id_fund_raising', $getFR->id)->get();
        return view('petugas.mengeola-fund-raising.mengeola-tiket-fr.home_tiket_fund_raising', [
            'getTiketFR' => $getTiketFR
        ], compact('getFR'));
    }

    public function createTiketFundRaising($fr) {
        $getFR = FundRaising::where('nama_kegiatan', 'like', $fr)->first();
        return view('petugas.mengeola-fund-raising.mengeola-tiket-fr.create_tiket_fund_raising', compact('getFR'));
    }

    public function storeTiketFR(Request $request) {
        $data = $request->all();
        $getIdFR = FundRaising::where('id', $data['id_fund_raising'])->first();
        $validasi = $request->validate([
            'nama_tiket.*' => 'required|string|max:255',
            'kuota_tiket.*' => 'nullable|integer',
            'harga_tiket.*' => 'nullable',
            'deskripsi_tiket.*' => 'required|string',
            'waktu_tanggal_mulai.*' => 'nullable|date',
            'waktu_tanggal_selesai.*' => 'nullable|date',
        ], [
            'nama_tiket.*.required' => 'Nama tiket harus diisi.',
            'kuota_tiket.*.integer' => 'Harga tiket harus berupa angka, dan tidak ada spesial karakter',
            'deskripsi_tiket.*.required' => 'Deskripsi tiket harus diisi.',
            'waktu_tanggal_mulai.*.date' => 'Waktu tanggal mulai tiket harus berupa tanggal.',
            'waktu_tanggal_selesai.*.date' => 'Waktu tanggal selesai tiket harus berupa tanggal.',
        ]);

        for ($i = 0; $i < count($data['nama_tiket']); $i++) {
            $userInput = $data['harga_tiket'][$i];
            $userInputWithoutDecimal = str_replace('.', '', $userInput);
            $intValue = (int) $userInputWithoutDecimal;
            TiketFundRaising::create([
                'id_fund_raising' => $data['id_fund_raising'],
                'nama_tiket' => $data['nama_tiket'][$i],
                'kuota_tiket' => $data['kuota_tiket'][$i] ?? null,
                'harga_tiket' => $intValue ?? null,
                'deskripsi_tiket' => $data['deskripsi_tiket'][$i],
                'waktu_tanggal_mulai' => $data['waktu_tanggal_mulai'][$i] ?? null,
                'waktu_tanggal_selesai' => $data['waktu_tanggal_selesai'][$i] ?? null,
            ]);
        }
        return redirect()->route('petugas.tiketFundRaising', $getIdFR->nama_kegiatan);
    }

    public function updateTiketFR(Request $request) {
        // dd($request->all());
        $getFR = FundRaising::where('id', $request->fund_raising_id)->first();
        $request->validate([
            'nama_tiket' => 'required|string|max:255',
            'kuota_tiket' => 'nullable|integer',
            'harga_tiket' => 'nullable',
            'deskripsi_tiket' => 'required|string',
            'waktu_tanggal_mulai' => 'nullable|date',
            'waktu_tanggal_selesai' => 'nullable|date',
        ]);

        $userInput = $request->harga_tiket;
        $userInputWithoutDecimal = str_replace('.', '', $userInput);
        $intValue = (int) $userInputWithoutDecimal;

        $ticket = TiketFundRaising::where('id', $request->id)->update([
            'nama_tiket' => $request->nama_tiket,
            'kuota_tiket' => $request->kuota_tiket ?? null,
            'harga_tiket' => $request->harga_tiket == null ? null : $intValue,
            'deskripsi_tiket' => $request->deskripsi_tiket,
            'waktu_tanggal_mulai' => $request->waktu_tanggal_mulai ?? null,
            'waktu_tanggal_selesai' => $request->waktu_tanggal_selesai ?? null,
        ]);
        return redirect()->route('petugas.tiketFundRaising', $getFR->nama_kegiatan)->
        with('success', 'Tiket berhasil diupdate');
    }

    public function hapusTiketFR($id) {
        $getTFR = TiketFundRaising::find($id);
        $getFR = FundRaising::where('id', $getTFR->id_fund_raising)->first();
        $getTFR->delete();
        return redirect()->route('petugas.tiketFundRaising', $getFR->nama_kegiatan)->
        with('success', 'Tiket berhasil dihapus');
    }

    public function detailJamaah() {
        return view('petugas.mengeola-jamaah.detail_jamaah');
    }

    public function homeListJamaah() {
        return view('petugas.mengeola-jamaah.home_list_jamaah');
    }


}
