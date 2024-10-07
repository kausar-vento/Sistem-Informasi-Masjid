<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->nullable();
            $table->text('item_details')->nullable();
            $table->integer('total_harga')->nullable();
            $table->integer('infaq_masjid')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('bukti_transaksi')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->enum('status_pembayaran', ['Sudah Bayar', 'Menunggu', 'Proses', 'Gagal'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
