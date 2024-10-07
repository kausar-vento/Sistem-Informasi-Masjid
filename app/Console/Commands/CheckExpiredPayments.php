<?php

namespace App\Console\Commands;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CheckExpiredPayments extends Command
{
    // Nama dan deskripsi command
    protected $signature = 'payments:check-expired';
    protected $description = 'Check and update expired payments';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Mendapatkan waktu saat ini
        $now = Carbon::now();

        // Mendapatkan semua order yang status pembayarannya belum 'gagal' dan waktu kedaluwarsa sudah lewat
        $expiredOrders = Transaksi::where('status_pembayaran', '!==', 'Gagal')->get();

        foreach ($expiredOrders as $order) {
            // Mengupdate status pembayaran menjadi 'gagal'
            $order->status_pembayaran = 'Gagal';
            $order->save();
            $this->info("Order ID {$order->id} status updated to 'gagal'");
        }
        $this->info('Expired payments check completed.');
    }
}
