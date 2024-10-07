<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FundRaising;
use App\Models\PesanRuangan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FunctionPublicController extends Controller
{
    public function paymentMidtrans($idTransaksi) {
        $getId = Transaksi::find($idTransaksi);
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
                'order_id' => $getId->kode_transaksi,
                'gross_amount' => $getId->total_harga,
            ),
            'item_details' => json_decode($getId->item_details, true),
            'customer_details' => array(
                'first_name' => $getId->user->nama_lengkap,
                'email' => $getId->user->email,
                'phone' => $getId->user->nomor_telp,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return [$getId, $snapToken];
    }
    public function getNextId($tentukan) {
        $getPR = PesanRuangan::all();
        $getFR = FundRaising::all();
        $getEV = Event::all();
        if ($tentukan === 'Transaksi') {
            if ($getPR) {
                $lastId = PesanRuangan::selectRaw('MAX(id) as last_id')->first()->last_id;
                return (int) $lastId + 1;
            } else{
                return 1;
            }
        } else if ($tentukan === 'Donasi') {
            if ($getFR) {
                $lastId = FundRaising::selectRaw('MAX(id) as last_id')->first()->last_id;
                return (int) $lastId + 1;
            } else{
                return 1;
            }
        } else {
            if ($getEV) {
                $lastIdTr = Event::selectRaw('MAX(id) as last_id')->first()->last_id;
                return (int) $lastIdTr + 1;
            } else{
                return 1;
            }
        }
    }

    public function getDataTransactionEvent($nama) {
        $getEvent = Event::where('nama_event', 'like', $nama)->first();
        $getTransaksiEvent = Transaksi::whereNotNull('id_boking_event')->where('id_boking_event', $getEvent->id)->
        where('status_pembayaran', 'like', 'Sudah Bayar')->get();
        $getTotalTransaksiEvent = $getTransaksiEvent->sum('total_harga');
        return [$getEvent, $getTransaksiEvent, $getTotalTransaksiEvent];
    }

    public function getDataTransactionFR($nama) {
        $getFR = FundRaising::where('nama_kegiatan', 'like', $nama)->first();
        $getTransaksiFR = Transaksi::whereNotNull('id_fund_raising')->where('id_fund_raising', $getFR->id)->get();
        $getTotalTransaksiFR = $getTransaksiFR->sum('total_harga');
        return [$getFR, $getTransaksiFR, $getTotalTransaksiFR];
    }
}


