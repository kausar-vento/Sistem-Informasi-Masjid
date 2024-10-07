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
        Schema::create('fund_raisings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->text('detail_donasi');
            $table->text('rincian_dana');
            $table->text('thumbnail_donasi');
            $table->enum('status_donasi', ['Publish', 'Unpublish'])->default('Publish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_raisings');
    }
};
