<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pembayarans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pembayaran_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('bulan');

            $table->integer('tahun');

            $table->double('nominal');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pembayarans');
    }
};