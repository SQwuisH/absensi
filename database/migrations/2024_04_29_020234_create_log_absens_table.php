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
        Schema::create('log_absens', function (Blueprint $table) {
            $table->increments('id_log_absen');
            $table->date('date');

            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('siswas');

            $table->string('keterangan');
            $table->enum('status', ['sakit', 'izin']);
            $table->string('bukti');
            $table->time('jam_pulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_absens');
    }
};
