<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('informasi_kos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nama_kos');
        $table->text('deskripsi')->nullable();
        $table->text('alamat');
        $table->string('kota')->nullable();
        $table->string('no_telepon')->nullable();
        $table->integer('harga_mulai')->nullable();
        $table->string('foto_utama')->nullable();
        $table->json('foto_galeri')->nullable();
        $table->json('fasilitas')->nullable();
        $table->string('tipe_kos')->default('campur'); // putra / putri / campur
        $table->string('status')->default('aktif'); // aktif / nonaktif
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('informasi_kos');
}
};
