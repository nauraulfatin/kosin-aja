<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('penghuni_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('bulan');

            $table->integer('tahun');

            $table->double('jumlah_tagihan');

            $table->enum('status', [
                'lunas',
                'belum_bayar'
            ])->default('belum_bayar');

            $table->date('tanggal_bayar')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
