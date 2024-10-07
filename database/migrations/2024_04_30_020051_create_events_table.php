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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->text('detail_event');
            $table->date('tanggal_event');
            $table->time('jam_mulai');
            $table->time('jam_selesai')->nullable();
            $table->enum('peserta_event', ['Umum', 'Pria', 'Wanita'])->default('Umum');
            $table->enum('lokasi_event', ['Masjid', 'Luar Masjid'])->default('Masjid');
            $table->unsignedBigInteger('id_ruangan')->nullable();
            $table->foreign('id_ruangan')->references('id')->on('ruangans')->onDelete('cascade');
            $table->text('lokasi_luar_masjid')->nullable();
            $table->string('tamu_acara')->nullable();
            $table->text('thumbnail');
            $table->enum('status_event', ['Publish', 'Unpublish'])->default('Publish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
