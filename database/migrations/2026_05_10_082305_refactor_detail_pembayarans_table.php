<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_pembayarans', function (Blueprint $table) {

            // hapus kolom lama
            $table->dropColumn([
                'bulan',
                'tahun',
                'nominal'
            ]);

            // relasi tagihan
            $table->foreignId('tagihan_id')
                  ->after('pembayaran_id')
                  ->constrained()
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('detail_pembayarans', function (Blueprint $table) {

            $table->string('bulan');

            $table->integer('tahun');

            $table->double('nominal');

            $table->dropForeign(['tagihan_id']);

            $table->dropColumn('tagihan_id');

        });
    }
};