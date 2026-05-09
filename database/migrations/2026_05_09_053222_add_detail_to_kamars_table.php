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
    Schema::table('kamars', function (Blueprint $table) {
        $table->string('tipe_kamar')->nullable()->after('nomor_kamar');
        $table->integer('kapasitas')->default(1)->after('tipe_kamar');
        $table->integer('lantai')->nullable()->after('kapasitas');
        $table->string('ukuran')->nullable()->after('lantai');
        $table->text('deskripsi')->nullable()->after('keterangan');
        $table->json('metode_pembayaran')->nullable()->after('harga');
    });
}

public function down(): void
{
    Schema::table('kamars', function (Blueprint $table) {
        $table->dropColumn(['tipe_kamar', 'kapasitas', 'lantai', 'ukuran', 'deskripsi', 'metode_pembayaran']);
    });
}
};
