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
        Schema::create('neracas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->foreign('id_admin')->references('id')->on('admins')->onDelete('cascade');

            $table->unsignedBigInteger('id_pesan_ruangan')->nullable();
            $table->foreign('id_pesan_ruangan')->references('id')->on('pesan_ruangans')->onDelete('cascade');

            $table->unsignedBigInteger('id_boking_event')->nullable();
            $table->foreign('id_boking_event')->references('id')->on('events')->onDelete('cascade');

            $table->unsignedBigInteger('id_fund_raising')->nullable();
            $table->foreign('id_fund_raising')->references('id')->on('fund_raisings')->onDelete('cascade');

            $table->integer('rekening_tujuan')->nullable();
            $table->integer('keterangan_aktivitas')->nullable();
            $table->integer('nominal')->after('keterangan_aktivitas')->nullable();
            $table->integer('saldo_sebelumnya')->nullable();
            $table->enum('jenis_aktivitas_admin', ['Pengeluaran', 'Pemasukan', 'Nihil'])->default('Nihil');
            $table->integer('saldo_sesudahnya')->nullable();
            $table->text('gambar_bukti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neracas');
    }
};
