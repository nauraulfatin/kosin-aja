<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('kamars', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nomor_kamar');
        $table->integer('harga');
        $table->string('status')->default('kosong');
        $table->text('fasilitas')->nullable();
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('kamars');
}
};
