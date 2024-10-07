<?php

use App\Http\Controllers\AdminFungsiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginHakAksesController;
use App\Http\Controllers\PetugasFungsiController;
use App\Http\Controllers\UserFungsiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPageController::class, 'landingPage'])->name('landingPage');
Route::get('/detail-landing-page/event/{title}', [LandingPageController::class, 'detailLandingPage'])->name('detailLandingPage');
Route::get('/detail-landing-page/donasi/{title}', [LandingPageController::class, 'detailDonasiLandingPage'])->name('detailDonasiLandingPage');
Route::get('/test-again', [LandingPageController::class, 'tester'])->name('tester');
Route::get('/login-khusus', [LoginHakAksesController::class, 'loginPetugasAdmin'])->name('loginPetugasAdmin');

// Fungsi Admin
Route::get('/admin-sangat-harus-login-ygy', [LoginHakAksesController::class, 'loginAdmin'])->name('loginAdmin');
Route::post('/admin-sangat-harus-login-ygy-proses-login', [LoginHakAksesController::class, 'prosesLoginAdmin'])->name('prosesLoginAdmin');
Route::get('/admin-sangat-harus-login-ygy-proses-logout', [LoginHakAksesController::class, 'prosesLogoutAdmin'])->name('prosesLogoutAdmin');

Route::get('/admin/laporan-keuangan', [AdminFungsiController::class, 'homeLaporanKeuangan'])->name('admin.homeLaporanKeuangan')->middleware('auth:web_admin');
Route::get('/admin/laporan-keuangan/detail', [AdminFungsiController::class, 'detailLaporanKeuangan'])->name('detailLaporanKeuangan')->middleware('auth:web_admin');

Route::get('/admin/list-transaksi/event/home', [AdminFungsiController::class, 'homeTransaksiEvent'])->name('homeTransaksiEvent')->middleware('auth:web_admin');
Route::get('/admin/list-transaksi/event/{nama}', [AdminFungsiController::class, 'detailTransaksiEvent'])->name('detailTransaksiEvent')->middleware('auth:web_admin');
Route::get('/admin/list-transaksi/event/{nama}/list-transaksi', [AdminFungsiController::class, 'laporanTransaksiEvent'])->name('laporanTransaksiEvent')->middleware('auth:web_admin');
Route::get('/admin/list-transaksi/event/{nama}/list-peserta', [AdminFungsiController::class, 'laporanPesertaEvent'])->name('laporanPesertaEvent')->middleware('auth:web_admin');
Route::post('/admin/list-transaksi/event/storeAktivitas', [AdminFungsiController::class, 'prosesNeraca'])->name('prosesNeraca')->middleware('auth:web_admin');
Route::get('/admin/list-transaksi/event/laporanNeraca/{nama}', [AdminFungsiController::class, 'detailNeraca'])->name('admin.detailNeraca')->middleware('auth:web_admin');

Route::get('/admin/list-transaksi/fund-raising/home', [AdminFungsiController::class, 'homeTransaksiFR'])->name('homeTransaksiFR')->middleware('auth:web_admin');
Route::get('/admin/list-transaksi/fund-raising/{nama}', [AdminFungsiController::class, 'detailTransaksiFR'])->name('detailTransaksiFR')->middleware('auth:web_admin');
Route::get('/admin/list-transaksi/fund-raising/{nama}/list-peserta', [AdminFungsiController::class, 'laporanPesertaFR'])->name('laporanPesertaFR')->middleware('auth:web_admin');

Route::get('/admin/list-transaksi/pesan-ruangan/home', [AdminFungsiController::class, 'laporanTransaksiPesanRuangan'])->name('transaksiPR')->middleware('auth:web_admin');

Route::get('/admin/manage-acount/petugas', [AdminFungsiController::class, 'homeManagePetugas'])->name('homeManagePetugas')->middleware('auth:web_admin');
Route::get('/admin/manage-acount/petugas/create', [AdminFungsiController::class, 'createManagePetugas'])->name('createManagePetugas')->middleware('auth:web_admin');
Route::post('/admin/manage-acount/petugas/create/save', [AdminFungsiController::class, 'saveManagePetugas'])->name('saveManagePetugas')->middleware('auth:web_admin');
Route::get('/admin/manage-acount/petugas/detail/{id}', [AdminFungsiController::class, 'detailPetugasMasjid'])->name('detailPetugasMasjid')->middleware('auth:web_admin');
Route::put('/admin/manage-acount/petugas/update/{id}', [AdminFungsiController::class, 'updatePetugasMasjid'])->name('updatePetugasMasjid')->middleware('auth:web_admin');

Route::get('/admin/manage-acount/warga-pj/verifikasi', [AdminFungsiController::class, 'homeMengeolaWargaPJ'])->name('homeMengeolaWargaPJ')->middleware('auth:web_admin');
Route::put('/admin/manage-acount/warga-pj/verifikasi/update/{user}', [AdminFungsiController::class, 'verifikasiWargaPJ'])->name('verifikasiWargaPJ')->middleware('auth:web_admin');
Route::get('/admin/manage-acount/warga-pj/verifikasi/update/success', [AdminFungsiController::class, 'successVerifikasiWargaPJ'])->name('successVerifikasiWargaPJ')->middleware('auth:web_admin');

Route::get('/admin/ruangan-disewa/home', [AdminFungsiController::class, 'homeRuanganSewa'])->name('homeRuanganSewa')->middleware('auth:web_admin');
Route::post('/admin/ruangan-disewa/store', [AdminFungsiController::class, 'simpanRuanganSewa'])->name('simpanRuanganSewa')->middleware('auth:web_admin');
Route::get('/admin/ruangan-disewa/detail-dan-edit-ruangan/{ruangan}', [AdminFungsiController::class, 'detailDanEditRuanganSewa'])->name('detailRuanganSewa')->middleware('auth:web_admin');
Route::put('/admin/ruangan-disewa/update-data-ruangan/{ruangan}', [AdminFungsiController::class, 'updateRuanganSewa'])->name('updateRuanganSewa')->middleware('auth:web_admin');
Route::delete('/admin/ruangan-disewa/hapus-data-ruangan/{ruangan}', [AdminFungsiController::class, 'deleteRuanganSewa'])->name('deleteRuanganSewa')->middleware('auth:web_admin');

Route::get('/admin/verifikasi-pesanan/home-verifikasi', [AdminFungsiController::class, 'verifikasiPesananRuangan'])->name('verifikasiPesananRuangan')->middleware('auth:web_admin');
Route::get('/admin/verifikasi-pesanan/detail-pesanan/{id}', [AdminFungsiController::class, 'detailPemesananRuangan'])->name('detailPemesananRuangan')->middleware('auth:web_admin');
Route::put('/admin/verifikasi-pesanan/update-verifikasi-pesanan/{pesanan}', [AdminFungsiController::class, 'updateVerifikasiPesananRuangan'])->name('updateVerifikasiPesananRuangan')->middleware('auth:web_admin');

Route::get('/admin/verifikasi-transaksi/home-verifikasi-transaksi', [AdminFungsiController::class, 'verifikasiTransaksiUser'])->name('admin.verifikasiTransaksiUser')->middleware('auth:web_admin');
Route::put('/admin/verifikasi-transaksi/update-status/{transaksi}', [AdminFungsiController::class, 'prosesAprovelTransaksi'])->name('prosesAprovelTransaksi')->middleware('auth:web_admin');
// Tutup Fungsi Admin


// Fungsi User
Route::get('/login-user', [LoginHakAksesController::class, 'loginUser'])->name('loginUser')->middleware('guest');
Route::post('/proses-login-user', [LoginHakAksesController::class, 'prosesLogin'])->name('prosesLogin');
Route::get('/register-user', [LoginHakAksesController::class, 'registerUser'])->name('registerUser')->middleware('guest');
Route::post('/proses-register-user', [LoginHakAksesController::class, 'prosesRegister'])->name('prosesRegister')->middleware('guest');
Route::get('/proses-logout-user', [LoginHakAksesController::class, 'prosesLogout'])->name('prosesLogout')->middleware('auth');

Route::get('/user/home', [UserFungsiController::class, 'homeUser'])->name('homeUser')->middleware('auth');

Route::get('/user/event/home', [UserFungsiController::class, 'homeListEvent'])->name('homeListEvent')->middleware('auth');
Route::get('/user/event/home/detail-event/{nama}', [UserFungsiController::class, 'detailEvent'])->name('detailEvent')->middleware('auth');
Route::post('/user/event/proses-boking-event', [UserFungsiController::class, 'prosesBokingEvent'])->name('prosesBokingEvent')->middleware('auth');

Route::get('/user/fund-raising/home', [UserFungsiController::class, 'homeFundRaising'])->name('homeFundRaising')->middleware('auth');
Route::get('/user/fund-raising/detail/{namaFR}', [UserFungsiController::class, 'detailFundRaising'])->name('detailFundRaising')->middleware('auth');
Route::post('/user/fund-raising/proses-pembayaran', [UserFungsiController::class, 'prosesBookingFundRaising'])->name('prosesBookingFundRaising')->middleware('auth');

Route::get('/user/pesan-ruangan/home/new', [UserFungsiController::class, 'testPesanRuanganNew'])->name('testPesanRuanganNew')->middleware('auth');
Route::get('/user/pesan-ruangan/detail', [UserFungsiController::class, 'detailPesanRuangan'])->name('detailPesanRuangan')->middleware('auth');
Route::post('/user/pesan-ruangan/detail/store', [UserFungsiController::class, 'savePesananNew'])->name('savePesananNew')->middleware('auth');
Route::get('/user/pesan-ruangan/detail/konfirmasi', [UserFungsiController::class, 'konfirmasiPesananRuanganNew'])->name('konfirmasiPesananRuanganNew')->middleware('auth');
Route::put('/user/pesan-ruangan/detail/konfirmasi/setuju/{pr}', [UserFungsiController::class, 'prosesKonfirmasiPesananRuanganNew'])->name('prosesKonfirmasiPesananRuanganNew')->middleware('auth');
Route::delete('/user/pesan-ruangan/batalakan-pesanan-ruangan/{dr}', [UserFungsiController::class, 'prosesPembatalanPesananRuangan'])->name('prosesPembatalanPesananRuangan')->middleware('auth');

Route::get('/user/history-transaksi', [UserFungsiController::class, 'historyTransaksi'])->name('historyTransaksi')->middleware('auth');
Route::get('/user/history-transaksi/detail-transaksi/{kode}', [UserFungsiController::class, 'cekDetailTransaksi'])->name('cekDetailTransaksi')->middleware('auth');

Route::get('/user/pembayaran/keranjang', [UserFungsiController::class, 'keranjang'])->name('keranjang')->middleware('auth');
Route::get('/user/pembayaran/event/detail-pemesanan/{id}', [UserFungsiController::class, 'pembayaranEvent'])->name('pembayaranEvent')->middleware('auth');
Route::post('/user/pembayaran/proses/konfirmasi-pembayaran', [UserFungsiController::class, 'prosesPembayaranEvent'])->name('prosesPembayaranEvent')->middleware('auth');
// Route::get('/user/pembayaran/konfirmasi-pembayaran/{id_transaksi}/{snapToken}', [UserFungsiController::class, 'konfirmasiPembayaran'])->name('konfirmasiPembayaran')->middleware('auth');
Route::get('/user/pembayaran/konfirmasi-pembayaran/{id_transaksi}', [UserFungsiController::class, 'konfirmasiPembayaranManual'])->name('konfirmasiPembayaranManual')->middleware('auth');
Route::put('/user/pembayaran/update-pembayaran/{tr}', [UserFungsiController::class, 'prosesPembayaranManual'])->name('prosesPembayaranManual')->middleware('auth');
// Route::post('/user/pembayaran/update-pembayaran/{id_transaksi}', [UserFungsiController::class, 'updateStatusPembayaran'])->name('updateStatusPembayaran')->middleware('auth');
Route::get('/user/pembayaran/sukses-pembayaran/{idTrans}', [UserFungsiController::class, 'suksesPembayaran'])->name('suksesPembayaran');

Route::get('/user/transaksi/pesanan-ruangan/home', [UserFungsiController::class, 'listPesananRuangan'])->name('listPesananRuangan')->middleware('auth');
Route::get('/user/transaksi/pesanan-ruangan/detail/{pr}', [UserFungsiController::class, 'detailPesananRuangan'])->name('detailPesananRuangan')->middleware('auth');
// Route::post('/user/transaksi/pesanan-ruangan/test-pembayaran', [UserFungsiController::class, 'testPembayaran'])->name('testPembayaran')->middleware('auth');
// Route::get('/user/transaksi/pesanan-ruangan/test-pembayaran/success', [UserFungsiController::class, 'afterPayment'])->name('afterPayment')->middleware('auth');


// Tutup Fungsi User


// Fungsi Petugas
Route::get('/login-petugas', [LoginHakAksesController::class, 'loginPetugas'])->name('loginPetugas');
Route::post('/petugas-proses-login', [LoginHakAksesController::class, 'prosesLoginPetugas'])->name('prosesLoginPetugas');
Route::get('/petugas-proses-logout', [LoginHakAksesController::class, 'prosesLogoutPetugas'])->name('petugas.prosesLogoutPetugas');

Route::get('/petugas/event/mengeola/home', [PetugasFungsiController::class, 'homeEventPetugas'])->name('petugas.homeEventPetugas')->middleware('auth:web_petugas');
Route::get('/petugas/event/mengeola/create', [PetugasFungsiController::class, 'homeCreateEventPetugas'])->name('petugas.homeCreateEventPetugas')->middleware('auth:web_petugas');
Route::post('/petugas/event/mengeola/store', [PetugasFungsiController::class, 'storeEvent'])->name('petugas.storeEvent')->middleware('auth:web_petugas');
Route::put('/petugas/event/mengeola/update/{event}', [PetugasFungsiController::class, 'updateEventPetugas'])->name('petugas.updateEventPetugas')->middleware('auth:web_petugas');
Route::post('/petugas/event/mengeola/update/status-event/', [PetugasFungsiController::class, 'updateStatusEvent'])->name('petugas.updateStatusEvent')->middleware('auth:web_petugas');
Route::get('/petugas/event/mengeola/tiket-event/{event}', [PetugasFungsiController::class, 'homeTiketEvent'])->name('petugas.homeTiketEvent')->middleware('auth:web_petugas');
Route::get('/petugas/event/mengeola/tiket-event/create/{event}', [PetugasFungsiController::class, 'createTiketEvent'])->name('petugas.createTiketEvent')->middleware('auth:web_petugas');
Route::post('/petugas/event/mengeola/tiket-event/store', [PetugasFungsiController::class, 'storeTiketEvent'])->name('petugas.storeTiketEvent')->middleware('auth:web_petugas');
Route::get('/petugas/event/mengeola/detail/{event}', [PetugasFungsiController::class, 'editEventPetugas'])->name('petugas.editEventPetugas')->middleware('auth:web_petugas');
Route::put('/petugas/event/mengeola/tiket-event/update', [PetugasFungsiController::class, 'updateTiketEvent'])->name('petugas.updateTiketEvent')->middleware('auth:web_petugas');

Route::get('/petugas/event/notifikasi/home', [PetugasFungsiController::class, 'homeListEventHadir'])->name('homeListEventHadir')->middleware('auth:web_petugas');
Route::get('/petugas/event/notifikasi/detail', [PetugasFungsiController::class, 'homeDetailUserEvent'])->name('homeDetailUserEvent')->middleware('auth:web_petugas');

Route::get('/petugas/fund-raising/home', [PetugasFungsiController::class, 'homeFundRaisingPetugas'])->name('petugas.homeFundR')->middleware('auth:web_petugas');
Route::get('/petugas/fund-raising/create', [PetugasFungsiController::class, 'createFundRaisingPetugas'])->name('petugas.createFundR')->middleware('auth:web_petugas');
Route::post('/petugas/fund-raising/store', [PetugasFungsiController::class, 'storeFundRaising'])->name('petugas.storeFundRaising')->middleware('auth:web_petugas');
Route::get('/petugas/fund-raising/{idFR}', [PetugasFungsiController::class, 'editFundRaising'])->name('petugas.editFundRaising')->middleware('auth:web_petugas');
Route::put('/petugas/fund-raising/update/{idFR}', [PetugasFungsiController::class, 'updateFundRaising'])->name('petugas.updateFundRaising')->middleware('auth:web_petugas');
Route::post('/petugas/fund-raising/update/status-fr/', [PetugasFungsiController::class, 'updtaeStatusFR'])->name('petugas.updtaeStatusFR')->middleware('auth:web_petugas');
Route::get('/petugas/fund-raising/mengeola-tiket/fund-raising/{fr}', [PetugasFungsiController::class, 'tiketFundRaising'])->name('petugas.tiketFundRaising')->middleware('auth:web_petugas');
Route::get('/petugas/fund-raising/mengeola-tiket/fund-raising/{fr}/create-ticket', [PetugasFungsiController::class, 'createTiketFundRaising'])->name('petugas.createTiketFundRaising')->middleware('auth:web_petugas');
Route::post('/petugas/fund-raising/mengeola-tiket/fund-raising/store', [PetugasFungsiController::class, 'storeTiketFR'])->name('petugas.storeTiketFR')->middleware('auth:web_petugas');
Route::put('/petugas/fund-raising/mengeola-tiket/fund-raising/update', [PetugasFungsiController::class, 'updateTiketFR'])->name('petugas.updateTiketFR')->middleware('auth:web_petugas');
Route::delete('/petugas/fund-raising/mengeola-tiket/fund-raising/destroy/{id}', [PetugasFungsiController::class, 'hapusTiketFR'])->name('petugas.hapusTiketFR')->middleware('auth:web_petugas');

Route::get('/petugas/mengeola-jamaah/home-list-jamaah', [PetugasFungsiController::class, 'homeListJamaah'])->name('homeListJamaah')->middleware('auth:web_petugas');
Route::get('/petugas/mengeola-jamaah/detail-jamaah', [PetugasFungsiController::class, 'detailJamaah'])->name('detailJamaah')->middleware('auth:web_petugas');
// Tutup Fungsi Petugas