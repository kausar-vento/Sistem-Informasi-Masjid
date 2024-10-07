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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->after('id');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('id_pesan_ruangan')->after('id_user')->nullable();
            $table->foreign('id_pesan_ruangan')->references('id')->on('pesan_ruangans')->onDelete('cascade');

            $table->unsignedBigInteger('id_boking_event')->after('id_pesan_ruangan')->nullable();
            $table->foreign('id_boking_event')->references('id')->on('events')->onDelete('cascade');

            $table->unsignedBigInteger('id_fund_raising')->after('id_boking_event')->nullable();
            $table->foreign('id_fund_raising')->references('id')->on('fund_raisings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            //
        });
    }
};
