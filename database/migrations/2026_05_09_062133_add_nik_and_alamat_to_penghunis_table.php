<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penghunis', function (Blueprint $table) {

            $table->string('nik')->nullable()->after('password');

            $table->text('alamat')->nullable()->after('nik');

        });
    }

    public function down(): void
    {
        Schema::table('penghunis', function (Blueprint $table) {

            $table->dropColumn('nik');

            $table->dropColumn('alamat');

        });
    }
};
