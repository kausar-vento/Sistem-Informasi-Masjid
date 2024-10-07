<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Event;
use App\Models\FundRaising;
use App\Models\Neraca;
use App\Models\PesanRuangan;
use App\Models\Petugas;
use App\Models\Ruangan;
use App\Models\TiketEvent;
use App\Models\TiketFundRaising;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use function PHPUnit\Framework\returnSelf;

class AdminFungsiController extends Controller
{
    private function getDashboard() {
        $getUser = User::all()->count();
        (int) $getInfaq = Transaksi::where('infaq_masjid', '!=', null)->sum('infaq_masjid');
        $getTotalHarga = Transaksi::where('total_harga', '!=', null)->sum('total_harga')- $getInfaq;
        return [$getUser, $getInfaq, $getTotalHarga];
    }

    public function homeLaporanKeuangan() {
        $getTransaksi = Transaksi::where('status_pembayaran', 'Sudah Bayar')->latest()->get();
        $inpoHeader = new AdminFungsiController();
        list($getUser, $getInfaq, $getTotalHarga) = $inpoHeader->getDashboard();     
        return view('admin.laporan_keuangan.home', compact('getUser', 'getInfaq', 'getTotalHarga'), [
            'allTransaksi' => $getTransaksi
        ]);
    }

    public function homeTransaksiEvent() {
        return view('admin.transaksi.event.home_transaksi_event', [
            'dataEvent' => Event::latest()->get()
        ]);
    }

    public function detailTransaksiEvent($nama) {
        $event = new FunctionPublicController();
        $getTotal = null;
        list($getEvent, $getTransaksiEvent, $totalHarga) = $event->getDataTransactionEvent($nama);
        $neraca = Neraca::where('id_boking_event', $getEvent->id)->latest()->first();
        $totalDitarik = Neraca::where('id_boking_event', $getEvent->id)->
            where('jenis_aktivitas_admin', 'like', 'Pengeluaran')->sum('nominal');
        $getTotal = $neraca == null ? $totalHarga : $neraca->saldo_sesudahnya;
        return view('admin.transaksi.event.detail_transaksi_event', [
            'getEvent' => $getEvent
        ], compact('getTransaksiEvent', 'getTotal', 'totalHarga', 'totalDitarik'));
    }

    public function laporanTransaksiEvent($nama) {
        $event = new FunctionPublicController();
        list($getEvent, $getTransaksiEvent) = $event->getDataTransactionEvent($nama);
        return view('admin.transaksi.event.laporan_transaksi_event', compact('getTransaksiEvent'));
    }

    public function homeTransaksiFR() {
        return view('admin.transaksi.fund_raising.home_transaksi_fr', [
            'dataFR' => FundRaising::latest()->get()
        ]);
    }

    public function detailTransaksiFR($nama) {
        $fr = new FunctionPublicController();
        list($getFR, $getTransaksiFR, $getTotalTransaksiFR) = $fr->getDataTransactionFR($nama);
        return view('admin.transaksi.fund_raising.detail_transaksi_fr', [
            'getFR' => $getFR
        ], compact('getTransaksiFR', 'getTotalTransaksiFR'));
    }

    public function laporanPesertaFR($nama) {
        $fr = new FunctionPublicController();
        list(, $getTransaksiFR) = $fr->getDataTransactionFR($nama);
        // dd($getTransaksiFR);
        return view('admin.transaksi.fund_raising.laporan_peserta_fr', [
            'getTransaksiFR' => $getTransaksiFR
        ]);
    }

    public function laporanTransaksiPesanRuangan() {
        $dataTransaksiPR = Transaksi::whereNotNull('id_pesan_ruangan')->
        where('status_pembayaran', 'like', 'Sudah Bayar')->latest()->get();
        return view('admin.transaksi.pesan_ruangan.home_transaksi_pesan_ruangan',compact('dataTransaksiPR'));
    }

    public function detailLaporanKeuangan() {
        return view('admin.laporan_keuangan.detail_laporan');
    }

    public function homeManagePetugas() {
        return view('admin.mengeola_akun.petugas.home_petugas', [
            'dataPetugas' => Petugas::all()
        ]);
    }

    public function createManagePetugas() {
        return view('admin.mengeola_akun.petugas.create_petugas');
    }

    public function saveManagePetugas(Request $request) {
        // dd($request->all());
        $validasi = $request->validate([
            'nama_petugas' => 'required',
            'alamat_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $validasi['password'] = bcrypt($request->input('password'));

        Petugas::create($validasi);
        return redirect()->route('homeManagePetugas')->with('success', 'Akun Petugas Berhasil Dibuat');
    }

    public function detailPetugasMasjid($id) {
        $data = Petugas::find($id);
        // dd(decrypt($data->password));
        return view('admin.mengeola_akun.petugas.detail_petugas', compact('data'));
    }

    public function updatePetugasMasjid(Request $req, $id) {
        $validasi = $req->validate([
            'nama_petugas' => 'required',
            'alamat_petugas' => 'required',
            'username' => 'required',
            'status_petugas' => 'required',
        ]);

        $data = Petugas::where('id', $id)->update($validasi);

        return redirect()->route('homeManagePetugas')->with('success', 'Akun Petugas Berhasil Diubah');
    }

    public function homeMengeolaWargaPJ() {
        $dataWargaPJ = User::where('status_warga', 'like', 'PJ')->where('verifikasi_pj', 'like', 'Menunggu')->get();
        $akun = User::where('status_warga', 'like', 'PJ')->get();
        return view('admin.mengeola_akun.verifikasi_warga_pj.home_verifikasi_warga_pj', [
            'dWargaPJ' => $dataWargaPJ,
            'dAkun' => $akun
        ]);
    }

    public function verifikasiWargaPJ(Request $req, User $user) {
        User::find($user->id)->update([
            'verifikasi_pj' => 'Iya'
        ]);
    }

    public function successVerifikasiWargaPJ() {
        return redirect()->route('homeMengeolaWargaPJ')->with('success', 'Warga berhasil diverifikasi');
    }

    public function homeMengeolaPesananRuanganMasjid() {
        return view('admin.mengeola_ruangan.home_pesanan_ruangan');
    }

    public function detailPesananRuanganMasjid() {
        return view('admin.mengeola_ruangan.detail_pesanan_ruangan');
    }

    public function homeRuanganSewa() {
        return view('admin.ruangan.home_ruangan', [
            'dataRuangan' => Ruangan::all()
        ]);
    }

    public function simpanRuanganSewa(Request $request) {
        // dd($request->all());
        $gambarPath = [];
        $validasi = [
            'nama_ruangan' => 'required',
            'harga_ruangan' => 'required',
            'deskripsi_ruangan' => 'required',
            'gambar_ruangan.*' => 'required|mimes:jpg,bmp,png|max:5080'
        ];
        $request->validate($validasi);
        $data = $request->only(['nama_ruangan', 'harga_ruangan', 'deskripsi_ruangan']);
        foreach ($request->file('gambar_ruangan') as $gambar) {
            $gambarPath[] = $gambar->store('gambar-ruangan-masjid');
        }
        $data['gambar_ruangan'] = json_encode($gambarPath);
        $save = Ruangan::create($data);
        return response()->json($save);
    }
    public function suksesSaveRuangan() {
        return redirect()->route('homeRuanganSewa')->with('success', 'Berhasil Menambahkan Ruangan Masjid');
    }
    public function detailDanEditRuanganSewa(Ruangan $ruangan) {
        
        return view('admin.ruangan.detail_edit_ruangan', compact('ruangan'));
    }

    public function updateRuanganSewa(Request $request, Ruangan $ruangan) {
        // Validasi input
        // dd($request->all());
        $validasi = [
            'nama_ruangan' => 'required|min:3',
            'harga_ruangan' => 'required',
            'deskripsi_ruangan' => 'required',
            'gambar_ruangan.*' => 'mimes:jpg,bmp,png,jpeg|max:5080'
        ];
        $validate = $request->validate($validasi);
        $validate['deskripsi_ruangan'] = $request->input('deskripsi_ruangan');
        $oldImages = $request->input('oldImage', []);
        $newImages = [];
    
        if ($request->hasFile('gambar_ruangan')) {
            foreach ($request->file('gambar_ruangan') as $index => $file) {
                if ($file) {
                    $newImagePath = $file->store('gambar-ruangan-masjid');
                    $newImages[] = $newImagePath;
                    if (isset($oldImages[$index]) && $oldImages[$index]) {
                        Storage::delete($oldImages[$index]);
                    }
                }
            }
        }
        $allImages = array_merge($oldImages, $newImages);
        $validate['gambar_ruangan'] = json_encode($allImages);
        Ruangan::where('id', $ruangan->id)->update($validate);
        return redirect()->route('homeRuanganSewa');
    }    

    public function deleteRuanganSewa(Ruangan $ruangan) {
        Storage::delete($ruangan->gambar_ruangan);
        Ruangan::destroy($ruangan->id);
        return redirect()->route('homeRuanganSewa');
    }

    public function verifikasiPesananRuangan() {
        return view('admin.mengeola_ruangan.home_pesanan_ruangan', [
            'dataPR' => PesanRuangan::whereNot('status_pemesanan', 'like', 'Sudah Verifikasi')->
            whereNot('status_pemesanan', 'like', 'Batal')->latest()->get()
        ]);
    }

    public function detailPemesananRuangan($id) {
        $pesananRuangan = [];
        $dataRuangan = Ruangan::all();
        $getPemesan = PesanRuangan::find($id);
        return view('admin.mengeola_ruangan.detail_pesanan_ruangan', compact('getPemesan', 'dataRuangan'));
    }

    public function updateVerifikasiPesananRuangan(PesanRuangan $pesanan, Request $req) {
        $totalHarga = null;
        $ubahData = null;
        if ($req->input('hasil') === 'Aprove') {
            $ubahData['status_pemesanan'] = 'Sudah Verifikasi';
        } else {
            $ubahData['status_pemesanan'] = 'Batal';
        }
        foreach (json_decode($pesanan->data_ruangan) as $key => $value) {
            $totalHarga += $value->total_harga;
        }
        $update = PesanRuangan::where('id', $pesanan->id)->update($ubahData);
        if ($req->input('hasil') === 'Aprove') {
            Transaksi::create([
                'id_user' => Auth::user()->id,
                'id_pesan_ruangan' => $pesanan->id,
                'kode_transaksi' => rand(),
                'item_details' => $pesanan->data_ruangan,
                'total_harga' => $totalHarga
            ]);
            return redirect()->route('verifikasiPesananRuangan')->with('success', 'Pesanan Berhasil Di Aprove');
        } else {
            return redirect()->route('verifikasiPesananRuangan')->with('success', 'Pesanan Dibatalkan');
        }
    }

    public function verifikasiTransaksiUser() {
        return view('admin.verifikasi_transaksi.home_verifikasi_transaksi', [
            'dataTRAll' => Transaksi::where('status_pembayaran', 'like', 'Proses')->latest()->get(),
            'dataTRAllGagal' => Transaksi::where('status_pembayaran', 'like', 'Gagal')->latest()->get()
        ]);
    }

    public function prosesAprovelTransaksi(Transaksi $transaksi) {
        $itemDetails = json_decode($transaksi->item_details, true);
        if ($transaksi->id_boking_event != null) {
            $getTiketEvent = TiketEvent::where('id_event', $transaksi->id_boking_event)->get()->keyBy('id');
            foreach ($itemDetails as $itemDetail) {
                if (isset($getTiketEvent[$itemDetail['id']])) {
                    $tiket = $getTiketEvent[$itemDetail['id']];
                    if ($tiket->kuota_tiket != null) {
                        $tiket->kuota_tiket -= $itemDetail['quantity'];
                        $tiket->save();
                    }
                }
            }
        } else if ($transaksi->id_fund_raising != null) {
            $getTiketEvent = TiketFundRaising::where('id_fund_raising', $transaksi->id_fund_raising)->get()->keyBy('id');
            foreach ($itemDetails as $itemDetail) {
                if (isset($getTiketEvent[$itemDetail['id']])) {
                    $tiket = $getTiketEvent[$itemDetail['id']];
                    if ($tiket->kuota_tiket != null) {
                        $tiket->kuota_tiket -= $itemDetail['quantity'];
                        $tiket->save();
                    }
                }
            }
        }
        $transaksi->update([
            'status_pembayaran' => 'Sudah Bayar'
        ]);
        return redirect()->route('admin.verifikasiTransaksiUser');
    }

    public function prosesNeraca(Request $req) {
        // dd($req->all());
        $definisiFungsi = new FunctionPublicController();

        $validasi = $req->validate([
            'rekening_tujuan' => 'required|numeric',
            'keterangan_aktivitas' => 'required|string',
            'nominal' => 'required',
            'jenis_aktivitas_admin' => 'required',
            'gambar_bukti' => 'required|mimes:jpg,bmp,png|max:5080',
        ]);
    
        $gambarBuktiPath = $req->file('gambar_bukti') ? $req->file('gambar_bukti')->store('bukti_aktivitas') : null;
        $intValue = (int) str_replace('.', '', $req->input('nominal'));
    
        $jenisTransaksi = $req->input('jenis_transaksi');
        $jenisAktivitasAdmin = $req->input('jenis_aktivitas_admin');
        $id = $jenisTransaksi === 'event' ? $req->input('id_event') : $req->input('id_fund_raising');
        
        if ($jenisTransaksi === 'event') {
            $entity = Event::find($id);
            list($entityData, $entityTransaction, $totalHarga) = $definisiFungsi->getDataTransactionEvent($entity->nama_event);
            $cekKetersedian = Neraca::where('id_boking_event', $id)->latest()->first();
        } else if ($jenisTransaksi === 'fund_raising') {
            $entity = FundRaising::find($id);
            list($entityData, $entityTransaction, $totalHarga) = $definisiFungsi->getDataTransactionFR($entity->nama_kegiatan);
            $cekKetersedian = Neraca::where('id_fund_raising', $id)->latest()->first();
        } else {
            return redirect()->back()->with('error', 'Jenis transaksi tidak valid');
        }
    
        $saldoSebelumnya = $cekKetersedian ? $cekKetersedian->saldo_sesudahnya : $totalHarga;
        $saldoSesudahnya = $jenisAktivitasAdmin === 'Pengeluaran' ? ($saldoSebelumnya - $intValue) : ($saldoSebelumnya + $intValue);
    
        $neracaData = [
            'rekening_tujuan' => $validasi['rekening_tujuan'],
            'keterangan_aktivitas' => $validasi['keterangan_aktivitas'],
            'nominal' => $intValue,
            'saldo_sebelumnya' => $saldoSebelumnya,
            'jenis_aktivitas_admin' => $validasi['jenis_aktivitas_admin'],
            'saldo_sesudahnya' => $saldoSesudahnya,
            'gambar_bukti' => $gambarBuktiPath,
        ];
    
        if ($jenisTransaksi === 'event') {
            $neracaData['id_boking_event'] = $id;
            Neraca::create($neracaData);
            return redirect()->route('homeTransaksiEvent')->with('success', 'Aktifitas anda pada transaksi event berhasil dilakukan');
        } else if ($jenisTransaksi === 'fund_raising') {
            $neracaData['id_fund_raising'] = $id;
            Neraca::create($neracaData);
            return redirect()->route('homeTransaksiFR')->with('success', 'Aktifitas anda pada transaksi penggalangan dana berhasil dilakukan');
        }
    }

    public function detailNeraca($nama) {
        $getEvent = Event::where('nama_event', 'like', $nama)->first();
        $getNeraca = Neraca::where('id_boking_event', $getEvent->id)->get();
        return view('admin.transaksi.event.laporan_neraca', compact('getNeraca'));
    }
}
