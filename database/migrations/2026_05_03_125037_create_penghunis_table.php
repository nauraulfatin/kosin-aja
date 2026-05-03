<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('penghunis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
        $table->string('nama');
        $table->string('email')->unique();
        $table->string('no_hp')->nullable();
        $table->string('password');
        $table->date('tanggal_masuk')->nullable();
        $table->string('status')->default('aktif');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('penghunis');
}
};
