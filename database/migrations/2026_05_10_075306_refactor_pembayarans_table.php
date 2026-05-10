<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {

            // hapus kolom lama
            $table->dropColumn([
                'bulan',
                'tahun',
                'jumlah_tagihan'
            ]);

            // kolom baru
            $table->double('total_bayar')
                  ->after('penghuni_id');

        });
    }

    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {

            $table->string('bulan');
            $table->integer('tahun');
            $table->double('jumlah_tagihan');

            $table->dropColumn('total_bayar');

        });
    }
};