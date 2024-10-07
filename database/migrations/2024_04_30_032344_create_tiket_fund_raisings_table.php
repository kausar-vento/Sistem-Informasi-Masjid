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
        Schema::create('tiket_fund_raisings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_fund_raising');
            $table->foreign('id_fund_raising')->references('id')->on('fund_raisings')->onDelete('cascade');
            $table->string('nama_tiket');
            $table->integer('kuota_tiket')->nullable();
            $table->integer('harga_tiket')->nullable();
            $table->text('deskripsi_tiket')->nullable();
            $table->date('waktu_tanggal_mulai')->nullable();
            $table->date('waktu_tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_fund_raisings');
    }
};
