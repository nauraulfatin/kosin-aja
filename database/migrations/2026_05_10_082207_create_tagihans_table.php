<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('penghuni_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('bulan');

            $table->integer('tahun');

            $table->double('nominal');

            $table->enum('status', [

                'belum_bayar',

                'menunggu_verifikasi',

                'lunas'

            ])->default('belum_bayar');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};