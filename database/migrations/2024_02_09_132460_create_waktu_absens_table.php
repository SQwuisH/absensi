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
        Schema::create('waktu_absens', function (Blueprint $table) {
            $table->increments('id_waktu_absen');
            $table->time('mulai_absen');
            $table->time('batas_absen');
            $table->time('mulai_pulang');
            $table->time('batas_pulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_absens');
    }
};
