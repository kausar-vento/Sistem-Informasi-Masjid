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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('nomor_telp');
            $table->string('password');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->enum('status_warga', ['PJ', 'Non']);
            $table->enum('verifikasi_pj', ['Iya', 'Menunggu', 'Non PJ'])->default('Non PJ');
            $table->enum('is_jamaah', ['Iya', 'Tidak'])->default('Tidak');
            $table->string('bukti_status_warga')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
