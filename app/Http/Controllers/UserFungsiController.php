<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FundRaising;
use App\Models\PesanRuangan;
use App\Models\Ruangan;
use App\Models\TiketEvent;
use App\Models\TiketFundRaising;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Twilio\Rest\Client;

class UserFungsiController extends Controller
{
    public function homeUser() {
        return view('user.home_user', [
            'dataE' => Event::latest()->where('status_event', 'like', 'Publish')->
            whereDate('tanggal_event', '>', now())->limit(4)->get(),
            'dataF' => FundRaising::latest()->where('status_donasi', 'like', 'Publish')->limit(4)->get()
        ]);
    }

    public function homeListEvent() {
        return view('user.event.home_event_user', [
            'dataEvent' => Event::latest()->where('status_event', 'like', 'Publish')->
            whereDate('tanggal_event', '>', now())->limit(4)->get()
        ]);
    }

    public function detailEvent($nama) {
        $allEvent = Event::where('nama_event', 'not like', $nama)->inRandomOrder()->limit(3)->get();
        $getEvent = Event::where('nama_event', 'like', $nama)->first();
        $allTiketEvent = TiketEvent::where('id_event', $getEvent->id)->get();
        return view('user.event.detail_event', compact('getEvent'), [
            'allEvent' => $allEvent,
            'allTiketEvent' => $allTiketEvent
        ]);
    }

    public function prosesBokingEvent(Request $req) {
        $data = $req->all();
        $nextId = new FunctionPublicController();
        $item_details = null;
        $harga = null;
        $total_harga = null;
        for ($i=0; $i < count($data['nama_tiket']); $i++) { 
           $item_details[] = [
                'id' => $data['id_tiket'][$i],
                'price' => $data['harga_tiket'][$i],
                'quantity' => $data['quantity'][$i],
                'name' => $data['nama_tiket'][$i]
           ];
           $harga[] = ($data['harga_tiket'][$i] * $data['quantity'][$i]);
           $total_harga = array_sum($harga);
        }
        // dd($item_details);
        $getIdEvent = $req->input('id_event');
        Transaksi::create([
            'id_user' => Auth::user()->id,
            'id_boking_event' => $getIdEvent,
            // 'kode_transaksi' => 'PBE' . str_pad((string) $nextId->getNextId('Event'), 5, '0', STR_PAD_LEFT),
            'kode_transaksi' => rand(),
            'item_details' => json_encode($item_details),
            'total_harga' => $total_harga
        ]);
        return redirect()->route('keranjang')->with('success', 'Transaksi Event Berhasil Dilakukan');
    }

    public function keranjang() {
        return view('user.transaksi.keranjang_user', [
            'dataT' => Transaksi::where('id_user', auth()->user()->id)->
            whereNot('status_pembayaran', 'like', 'Sudah Bayar')->
            whereNot('status_pembayaran', 'like', 'Gagal')->latest()->get()
        ]);
    }

    public function historyTransaksi() {
        return view('user.transaksi.history_transaksi', [
            'dataT' => Transaksi::where('id_user', auth()->user()->id)->
            where('status_pembayaran', 'like', 'Sudah Bayar')->latest()->get()
        ]);
    }

    public function cekDetailTransaksi($kode) {
        $getTransaksi = Transaksi::where('kode_transaksi', 'like', $kode)->first();
        return view('user.transaksi.detail_transaksi', compact('getTransaksi'));
    }

    public function pembayaranEvent(Request $req, $id) {
        $getTransaksi = Transaksi::where('id', $id)->first();
        if ($getTransaksi->status_pembayaran === 'Proses') {
            return redirect()->route('konfirmasiPembayaranManual', $getTransaksi->id);
        } else {
            return view('user.transaksi.pembayaran.pembayaran_event', compact('getTransaksi'));
        }
    }

    public function prosesPembayaranEvent(Request $req) {
        $getDetail = Transaksi::where('id', $req->input('id_transaksi'))->first();
        $intValue = null;
        if ($req->input('custom_infaq_masjid')) {
            $userInput = $req->input('custom_infaq_masjid');
            $userInputWithoutDecimal = str_replace('.', '', $userInput);
            $intValue = (int) $userInputWithoutDecimal;
        }
        $validasi = $req->validate([
            'infaq_masjid' => '',
            'custom_infaq_masjid' => $intValue < 10000 && $intValue != null ? 'min:10000' : '',
            'keterangan' => ''
        ], [
            'custom_infaq_masjid.min' => 'Minimal pengisian adalah Rp. 10.000'
        ]);
        $infaq_masjid = $validasi['infaq_masjid'];
        $custom_infaq = $validasi['custom_infaq_masjid'];
        $getDetailItem = json_decode($getDetail->item_details, true);
        array_push($getDetailItem, [
            'id' => 'IFQ',
            'price' => $custom_infaq == null ? $validasi['infaq_masjid'] : $intValue,
            'quantity' => 1,
            'name' => 'Infaq Masjid'
        ]);
        if ($infaq_masjid === 'null' && $custom_infaq == null) {
            if ($getDetail->total_harga == null) {
                Transaksi::where('id', $req->input('id_transaksi'))->first()->update([
                    'status_pembayaran' => 'Sudah Bayar'
                ]);
                return redirect()->route('suksesPembayaran', $getDetail->id);
            } else {
                Transaksi::where('id', $req->input('id_transaksi'))->first()->update([
                    'keterangan' => $validasi['keterangan'],
                    'expired_at' => Carbon::now()->addHour(),
                    'status_pembayaran' => 'Proses'
                ]);
            }
        } else if ($infaq_masjid === 'other' && $custom_infaq != null) {
            Transaksi::where('id', $req->input('id_transaksi'))->first()->update([
                'item_details' => json_encode($getDetailItem),
                'total_harga' => $getDetail->total_harga + $intValue,
                'infaq_masjid' => $intValue,
                'keterangan' => $validasi['keterangan'],
                'expired_at' => Carbon::now()->addHour(),
                'status_pembayaran' => 'Proses'
            ]);
        } else if ($infaq_masjid !== 'null' && $custom_infaq == null) {
            Transaksi::where('id', $req->input('id_transaksi'))->first()->update([
                'item_details' => json_encode($getDetailItem),
                'total_harga' => $getDetail->total_harga + $infaq_masjid,
                'infaq_masjid' => $infaq_masjid,
                'keterangan' => $validasi['keterangan'],
                'expired_at' => Carbon::now()->addHour(),
                'status_pembayaran' => 'Proses'
            ]);
        } else {
            return redirect()->back()->with('failed', 'Mohon untuk infaq masjid dipilih salah satu');  
        }
        try {
            // Untuk Metode Pembayaran Midtrans
            // $bayar = new FunctionPublicController();
            // list($getId, $snapToken) = $bayar->paymentMidtrans($req->input('id_transaksi'));
            // return redirect()->route('konfirmasiPembayaran', ['id_transaksi' => $getId->id, 'snapToken' => $snapToken])->with('success', 'Pembayaran berhasil diproses');
            // ===============================================================================================================================================================
            return redirect()->route('konfirmasiPembayaranManual', ['id_transaksi' => $req->input('id_transaksi')])->with('success', 'Silahkan Upload Bukti Pembayaran');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
// Untuk Metode Pembayaran Midtrans
    public function konfirmasiPembayaran($idTransaksi, $snapToken) {
        $getId = Transaksi::find($idTransaksi);
        return view('user.transaksi.pembayaran.konfirmasi_pembayaran', compact('getId', 'snapToken'));
    }

    public function konfirmasiPembayaranManual($idTransaksi) {
        // dd(Carbon::now()->addHour());
        $getId = Transaksi::find($idTransaksi);
        if ($getId->id_user == Auth::user()->id && $getId->status_pembayaran === 'Proses')  {
           if (Carbon::now()->greaterThan($getId->expired_at)) {
                return redirect()->route('keranjang')->with('success', 'Mohon maaf anda sudah melewati batas pembayaran');
           } else {
                return view('user.transaksi.pembayaran.konfirmasi_pembayaran_manual', compact('getId'));
           }
        } else {
            return redirect()->route('keranjang')->with('success', 'Mohon maaf proses pembayaran untuk transaksi ini sudah expired');
        }
    }

    public function prosesPembayaranManual(Request $req, Transaksi $tr) {
        $validasi = $req->validate([
            'bukti_transaksi' => 'required|mimes:jpg,jpeg,png|max:5080',
        ], [
            'bukti_transaksi.required' => 'Wajib menyertakan bukti transaksi',
            'bukti_transaksi.mimes' => 'Mohon perhatikan file yang diperbolehkan untuk diupload'
        ]);
        $itemDetails = json_decode($tr->item_details, true);
        if ($tr->id_boking_event != null) {
            $getTiketEvent = TiketEvent::where('id_event', $tr->id_boking_event)->get()->keyBy('id');
            foreach ($itemDetails as $itemDetail) {
                if (isset($getTiketEvent[$itemDetail['id']])) {
                    $tiket = $getTiketEvent[$itemDetail['id']];
                    if ($tiket->kuota_tiket != null) {
                        if ($tiket->kuota_tiket < $itemDetail['quantity']) {
                            return redirect()->back()->with('error', 'Jumlah kuota tiket yang dibeli melebihi batas dari 
                            jumlah tiket yang tersedia atau anda terlambat karena sudah didahulukan oleh user sebelumnya. 
                            mohon menunggu admin akan mentransfer ulang pemabayaran anda');
                        }
                    }
                }
            }
        } else if ($tr->id_fund_raising != null) {
            $getTiketEvent = TiketFundRaising::where('id_fund_raising', $tr->id_fund_raising)->get()->keyBy('id');
            foreach ($itemDetails as $itemDetail) {
                if (isset($getTiketEvent[$itemDetail['id']])) {
                    $tiket = $getTiketEvent[$itemDetail['id']];
                    if ($tiket->kuota_tiket != null) {
                        if ($tiket->kuota_tiket < $itemDetail['quantity']) {
                            return redirect()->back()->with('error', 'Jumlah kuota tiket yang dibeli melebihi batas dari 
                            jumlah tiket yang tersedia atau anda terlambat karena sudah didahulukan oleh user sebelumnya. 
                            mohon menunggu admin akan mentransfer ulang pemabayaran anda');
                        }
                    }
                }
            }
        }
        Transaksi::where('id', $tr->id)->update([
            'bukti_transaksi' => $req->file('bukti_transaksi')->store('bukti_transaksi_user'),
        ]);  
        return redirect()->route('suksesPembayaran', $tr->id);
    }

    public function suksesPembayaran($idTrans) {
        $transaksi = Transaksi::where('id', $idTrans)->first();
        return view('user.transaksi.sukses_pembayaran', compact('transaksi'));
    }
    
    public function homeFundRaising() {
        return view('user.fund_raising.home_fund_raising', [
            'dataFR' => FundRaising::where('status_donasi', 'like', 'Publish')->latest()->get(),
            'dataTR' => Transaksi::all()
        ]);
    }

    public function detailFundRaising($namaFR) {
        $getFundR = FundRaising::where('nama_kegiatan', 'like', $namaFR)->first();
        $getTiketFR = TiketFundRaising::where('id_fund_raising', $getFundR->id)->get();
        $dataFR = FundRaising::where('nama_kegiatan', 'not like', $namaFR)->inRandomOrder()->limit(3)->get();
        return view('user.fund_raising.detail_fund_raising', compact('getFundR'), [
            'tiketFR' => $getTiketFR,
            'dataFR' => $dataFR
        ]);
    }
    public function prosesBookingFundRaising(Request $req) {
        $data = $req->all();
        $nextId = new FunctionPublicController();
        $item_details = null;
        $harga = null;
        $total_harga = null;
        $coba[] = 0;
        for ($i=0; $i < count($data['nama_tiket']); $i++) { 
            $userInput = $data['harga_tiket'][$i];
            $userInputWithoutDecimal = str_replace('.', '', $userInput);
            $intValue = (int) $userInputWithoutDecimal;
           $item_details[] = [
                'id' => $data['id_tiket'][$i],
                'price' => $intValue,
                'quantity' => $data['quantity'][$i],
                'name' => $data['nama_tiket'][$i]
           ];
           $harga[] = ($intValue * $data['quantity'][$i]);
           $total_harga = array_sum($harga);
        }
        $getIdFR = $req->input('id_fund_raising');
        Transaksi::create([
            'id_user' => Auth::user()->id,
            'id_fund_raising' => $getIdFR,
            // 'kode_transaksi' => 'PDN' . str_pad((string) $nextId->getNextId('Donasi'), 5, '0', STR_PAD_LEFT),
            'kode_transaksi' => rand(),
            'item_details' => json_encode($item_details),
            'total_harga' => $total_harga
        ]);
        return redirect()->route('keranjang')->with('success', 'Transaksi Penggalangan Dana Berhasil Dibuat');
    }

    public function testPesanRuanganNew() {
        return view('user.pesan_ruangan.new_home_pesan_ruangan');
    }

    public function detailPesanRuangan(Request $req) {
        $dataRuangan = Ruangan::all();
        $tanggalM = $req->tanggal_mulai;
        $tanggalS = $req->tanggal_selesai;
        return view('user.pesan_ruangan.detail_pesan_ruangan', compact('tanggalM', 'tanggalS', 'dataRuangan'));
    }

    public function savePesananNew(Request $req) {
        $tipe = null;
        $validasi = $req->validate([
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'jumlah_peserta' => 'required|integer',
            'file_pendukung' => 'required|mimes:jpg,jpeg,png|max:5080',
            'kebutuhan_penyewa' => 'required'
        ]);
        if ($req->input('jumlah_peserta') >= 200) {
            $tipe = 'Besar';
        } else {
            $tipe = 'Kecil';
        }
        $ruangan = $req->input('ruangan');
        $ruanganDipilih = array_filter($ruangan, function ($item) {
            return $item['dipilih'] === 'true';
        });
        $save = array_values($ruanganDipilih);
        $save2 = [];
        foreach ($save as $item) {
            $save2[] = $item;
        }
        $valueRuangan = json_encode($save2);
        $saveData = [
            'id_user' => Auth::user()->id,
            'tanggal_mulai' => $req->input('tanggal_mulai'),
            'tanggal_selesai' => $req->input('tanggal_mulai'),
            'jam_mulai' => $req->input('jam_mulai'),
            'jam_selesai' => $req->input('jam_selesai'),
            'jumlah_peserta' => $req->input('jumlah_peserta'),
            'kebutuhan_penyewa' => $req->input('kebutuhan_penyewa'),
            'file_pendukung' => $req->file('file_pendukung')->store('file_pendukung_pesanan'),
            'data_ruangan' => $valueRuangan,
            'tipe_acara' => $tipe
        ];
        PesanRuangan::create($saveData);
        return redirect()->route('konfirmasiPesananRuanganNew')->with('success', 'Silahkan Untuk Melakukan
         Proses Konfirmasi Dari Pesanan Ruangan Yang Sudah Dilakukan');
    }

    public function konfirmasiPesananRuanganNew() {
        $ruangan = Ruangan::all();
        $data = PesanRuangan::where('id_user', auth()->user()->id)->
        where('status_pemesanan', 'like', 'Menunggu')->latest()->first();
        if (!$data) {
           return redirect()->route('testPesanRuanganNew');
        }else {
            $dataR = json_decode($data->data_ruangan);
            return view('user.pesan_ruangan.new_konfirmasi_pesan_ruangan', compact('data', 'ruangan'));
        }
    }

    public function prosesKonfirmasiPesananRuanganNew(PesanRuangan $pr) {
        $tanggalM = Carbon::parse($pr->tanggal_mulai)->locale('id')->translatedFormat('l, d F Y');
        $dataR = json_decode($pr->data_ruangan);
        $jumlahRuangan = count($dataR);
        $total = null;
        foreach ($dataR as $key => $value) {
            $total += $value->total_harga;
        }
        $user = Auth::user()->nama_lengkap;
        $message = <<<HTML
        *Detail Pemesanan:*
        Nama Pemesan: *{$user}*
        Tanggal Pemesanan: *{$tanggalM}*
        Jumlah Ruangan Dipesan: *{$jumlahRuangan}*
        Total Harga: *{$total}*
        Link: http://127.0.0.1:8000/admin/verifikasi-pesanan/home-verifikasi
        HTML;
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN')
            ])->post('https://api.fonnte.com/send', [
                'target' => Auth::user()->nomor_telp,
                'message' => $message
            ]);
    
            // Periksa status response untuk memastikan keberhasilan pengiriman
            if ($response->successful()) {
                $dataP['status_pemesanan'] = 'Menunggu Admin';
                PesanRuangan::where('id', $pr->id)->update($dataP);
            } else {
               dd('ada error');
            }
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route('testPesanRuanganNew')->with('success', 'Pesanan Berhasil Dibuat Dan Sudah Dikirimkan Dengan WhatsApp, Mohon Menunggu Verifikasi Oleh Admin');
    }

    public function prosesPembatalanPesananRuangan(PesanRuangan $ruangan) {
        Storage::delete($ruangan->file_pendukung);
        PesanRuangan::destroy($ruangan->id);
        return redirect()->route('homePesanRuangan')->with('success', 'Pesanan Berhasil Dibatalkan');
    }

    public function listPesananRuangan() {
        return view('user.pesan_ruangan_detail.home_list_pesan_ruangan', [
            'dataPesanan' => PesanRuangan::where('id_user', auth()->user()->id)->where('status_pemesanan', 'like', 'Menunggu Admin')->latest()->get()
        ]);
    }

    public function detailPesananRuangan(PesanRuangan $pr) {
        // dd($pr);
        $dataPesanan = PesanRuangan::where('id_user', auth()->user()->id)->
                        where('id', $pr->id)->latest()->first();
        $dataRuangan = Ruangan::all();
        return view('user.pesan_ruangan_detail.detail_pesanan_ruangan', compact('dataPesanan','dataRuangan'));
    }

    public function handleAfterPayment(Request $request) {
        $serverKey = config('midtrans.server_key_sandbox');
        $hash = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hash == $request->signature_key) {
            if ($request->status_code == 200) {
                $getPesananRuangan = PesanRuangan::find($request->order_id);
                $getPesananRuangan->update(['status_pemesanan' => 'Sudah Bayar']);
            }
        }
    }

    // Fungsi Test Pembayaran Saja. Akan digunakan suatu saat
    public function testPembayaran(Request $req) {
        $getId = PesanRuangan::find($req->idBayar);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key_sandbox');
        // Ganti ke false kalau ingin sandbox
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // Pakai ini kalau production
        // \Midtrans\Config::$overrideNotifUrl = config('midtrans.notif_url');

        $params = array(
            'transaction_details' => array(
                'order_id' => $getId->order_id,
                'gross_amount' => $getId->ruangan->harga_ruangan,
            ),
            'customer_details' => array(
                'first_name' => $getId->nama_pemesan,
                'email' => Auth::user()->email,
                'phone' => '08111222333',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('user.transaksi.pesan_ruangan.konfirmasi_pesanan_ruangan', 
            compact('getId', 'snapToken'));
        // dd($snapToken);
    }

    public function afterPayment(Request $req) {
        $serverKey = config('midtrans.server_key_sandbox');
        $hash = hash("sha512", $req->get('order_id').$req->get('status_code').$req->get('gross_amount').$serverKey);
        if ($hash == $req->get('signature_key')) {
            dd('halo');
        } else {
            dd('ds');
        }
    }

    public function updateStatusPembayaran(Request $req, $idTransaksi) {
        $getTrans = Transaksi::where('id', $idTransaksi)->first();
        if ($getTrans->id_boking_event != null) {
            $getTiketEvent = TiketEvent::where('id_event', $getTrans->id_boking_event)->get()->keyBy('id');
            $itemDetails = json_decode($getTrans->item_details, true);
            foreach ($itemDetails as $itemDetail) {
                if (isset($getTiketEvent[$itemDetail['id']])) {
                    $tiket = $getTiketEvent[$itemDetail['id']];
                    if ($tiket->kuota_tiket != null) {
                        $tiket->kuota_tiket -= $itemDetail['quantity'];
                        $tiket->save();
                    }
                }
            }
        } else if ($getTrans->id_fund_raising != null) {
            $getTiketEvent = TiketFundRaising::where('id_fund_raising', $getTrans->id_fund_raising)->get()->keyBy('id');
            $itemDetails = json_decode($getTrans->item_details, true);
            foreach ($itemDetails as $itemDetail) {
                if (isset($getTiketEvent[$itemDetail['id']])) {
                    $tiket = $getTiketEvent[$itemDetail['id']];
                    if ($tiket->kuota_tiket != null) {
                        $tiket->kuota_tiket -= $itemDetail['quantity'];
                        $tiket->save();
                    }
                }
            }
        } elseif ($getTrans->id_pesan_ruangan != null) {
            $getPR = PesanRuangan::find($getTrans->id_pesan_ruangan);
            $getPR->update([
                'status_pemesanan' => 'Sudah Bayar'
            ]);
        }
        Transaksi::where('id', $idTransaksi)->update([
            'status_pembayaran' => 'Sudah Bayar'
        ]);  
        return redirect()->route('suksesPembayaran', $idTransaksi);
    }
    
}
