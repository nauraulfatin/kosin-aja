<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {

            // upload bukti transfer
            $table->string('bukti_pembayaran')
                  ->nullable()
                  ->after('jumlah_tagihan');

            // metode pembayaran
            $table->string('metode_pembayaran')
                  ->nullable()
                  ->after('bukti_pembayaran');

            // catatan admin
            $table->text('catatan')
                  ->nullable()
                  ->after('metode_pembayaran');

            // status pembayaran
            $table->enum('status', [
                'belum_bayar',
                'menunggu_verifikasi',
                'lunas',
                'ditolak'
            ])->default('belum_bayar')->change();

        });
    }

    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {

            $table->dropColumn([
                'bukti_pembayaran',
                'metode_pembayaran',
                'catatan',
            ]);

        });
    }
};
